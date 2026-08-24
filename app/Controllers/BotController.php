<?php
namespace App\Controllers;
use App\Models\Faq;

class BotController {

	/** Datos de sesión relevantes para filtrar las respuestas. */
	private function contexto() {
		return [
			'logueado' => isset($_SESSION['user_id']),
			'rol' => $_SESSION['role'] ?? ''
		];
	}

	/** POST ?route=bot_ask — devuelve la respuesta en formato JSON. */
	public function ask() {
		header('Content-Type: application/json; charset=utf-8');

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			header('HTTP/1.1 405 Method Not Allowed');
			echo json_encode(['error' => 'Método no permitido'], JSON_UNESCAPED_UNICODE);
			return;
		}

		$ctx = $this->contexto();
		$consulta = trim((string)($_POST['q'] ?? ''));

		if (mb_strlen($consulta) > 300) {
			$consulta = mb_substr($consulta, 0, 300);
		}

		if ($consulta === '') {
			echo json_encode([
				'encontrado' => false,
				'respuesta' => 'Escribe tu pregunta y buscaré la respuesta en la base de conocimiento.',
				'sugerencias' => $this->formatearSugerencias(Faq::disponibles($ctx['logueado'], $ctx['rol']), 3)
			], JSON_UNESCAPED_UNICODE);
			return;
		}

		$resultado = Faq::responder($consulta, $ctx['logueado'], $ctx['rol']);

		if ($resultado['faq'] === null) {
			echo json_encode([
				'encontrado' => false,
				'respuesta' => "No encontré una respuesta para eso. Puedo ayudarte con estos temas, o puedes enviar tu caso al Centro de Ayuda para que un agente te atienda.",
				'enlace' => ['texto' => 'Ir al Centro de Ayuda', 'ruta' => '?route=help'],
				'sugerencias' => $this->formatearSugerencias($resultado['sugerencias'], 3)
			], JSON_UNESCAPED_UNICODE);
			return;
		}

		$faq = $resultado['faq'];
		echo json_encode([
			'encontrado' => true,
			'id' => $faq['id'],
			'pregunta' => $faq['pregunta'],
			'respuesta' => $faq['respuesta'],
			'enlace' => $faq['enlace'] ?? null,
			'sugerencias' => $this->formatearSugerencias($resultado['sugerencias'], 2)
		], JSON_UNESCAPED_UNICODE);
	}

	/** Reduce las FAQ a id + pregunta; $limite = 0 devuelve todas. */
	private function formatearSugerencias($faqs, $limite = 3) {
		if ($limite > 0) {
			$faqs = array_slice($faqs, 0, $limite);
		}
		return array_map(function ($faq) {
			return ['id' => $faq['id'], 'pregunta' => $faq['pregunta']];
		}, $faqs);
	}
}
