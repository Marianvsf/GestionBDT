<?php
namespace App\Controllers;
use App\Models\HelpRequest;

class HelpController {
	public function create() {
		$success = null;
		$error = null;
		$form = [
			'name' => '',
			'email' => '',
			'phone' => '',
			'subject' => '',
			'message' => ''
		];

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = trim($_POST['name'] ?? '');
			$email = trim($_POST['email'] ?? '');
			$phone = trim($_POST['phone'] ?? '');
			$subject = trim($_POST['subject'] ?? '');
			$message = trim($_POST['message'] ?? '');

			$form = [
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'subject' => $subject,
				'message' => $message
			];

			if ($name === '' || $email === '' || $subject === '' || $message === '') {
				$error = 'Completa los campos obligatorios.';
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error = 'Ingresa un correo válido.';
			} else {
				$userId = $_SESSION['user_id'] ?? null;
				$saved = HelpRequest::create($userId, $name, $email, $phone, $subject, $message);
				if ($saved) {
					$success = 'Tu solicitud fue enviada correctamente. Un agente te contactará pronto.';
					$form = [
						'name' => '',
						'email' => '',
						'phone' => '',
						'subject' => '',
						'message' => ''
					];
				} else {
					$error = 'No se pudo registrar tu solicitud. Intenta nuevamente.';
				}
			}
		}

		require __DIR__ . '/../Views/home/help.php';
	}
}
