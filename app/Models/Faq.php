<?php
namespace App\Models;

/**
 * Base de conocimiento del asistente de preguntas frecuentes.
 * Cada entrada define:
 *   - audiencia: 'todos' (visible siempre) o 'interno' (requiere sesión)
 *   - roles:     (opcional) roles que pueden ver la respuesta cuando hay sesión
 *   - palabras:  términos que disparan la coincidencia
 */
class Faq {

	const UMBRAL_COINCIDENCIA = 2;

	/** Palabras sin valor discriminante: no puntúan al comparar preguntas. */
	const PALABRAS_VACIAS = [
		'como', 'cual', 'cuales', 'cuando', 'donde', 'quien', 'para', 'por', 'con', 'sin',
		'los', 'las', 'del', 'una', 'uno', 'unos', 'unas', 'que', 'este', 'esta', 'esto',
		'son', 'sus', 'puedo', 'quiero', 'necesito', 'hacer', 'hago', 'tengo', 'debo',
		'sistema', 'favor', 'buenas', 'hola'
	];

	private static function base() {
		return [
			[
				'id' => 'acceso',
				'audiencia' => 'todos',
				'pregunta' => '¿Cómo ingreso al sistema?',
				'respuesta' => "Abre la URL del sistema e ingresa tu Usuario Corporativo y Contraseña, luego presiona \"Acceder al Sistema\".\nEn la primera ejecución el usuario inicial es admin con clave 123456 (rol Gerente). Se recomienda cambiarla tras el primer acceso.",
				'palabras' => ['ingresar', 'ingreso', 'entrar', 'acceder', 'acceso', 'login', 'iniciar sesion', 'usuario inicial', 'admin', 'credenciales']
			],
			[
				'id' => 'clave-olvidada',
				'audiencia' => 'todos',
				'pregunta' => '¿Olvidé mi contraseña, qué hago?',
				'respuesta' => "Usa la opción \"¿Olvidaste tu contraseña?\" en la pantalla de acceso e indica tu correo; recibirás las instrucciones de recuperación.\nSi no llega el correo, escribe al Centro de Ayuda para que un Gerente restablezca tu cuenta.",
				'enlace' => ['texto' => 'Recuperar contraseña', 'ruta' => '?route=forgot_password'],
				'palabras' => ['olvide', 'olvido', 'recuperar', 'restablecer', 'contrasena', 'password', 'clave', 'no puedo entrar', 'bloqueado']
			],
			[
				'id' => 'crear-ticket',
				'audiencia' => 'interno',
				'pregunta' => '¿Cómo registro una incidencia?',
				'respuesta' => "Presiona \"Nuevo Ticket\" en la barra superior, completa el título, la descripción y el departamento, y guarda.\nMientras más detalle incluyas en la descripción, mejor será la categoría y la prioridad que asigne el sistema.",
				'enlace' => ['texto' => 'Crear ticket', 'ruta' => '?route=create_ticket'],
				'palabras' => ['crear ticket', 'nuevo ticket', 'ticket nuevo', 'crear', 'creo', 'registrar', 'registro', 'reportar', 'incidencia', 'levantar caso', 'abrir ticket']
			],
			[
				'id' => 'clasificacion',
				'audiencia' => 'todos',
				'pregunta' => '¿Cómo se asignan la categoría y la prioridad?',
				'respuesta' => "El sistema analiza la descripción y busca palabras clave para clasificar el ticket:\n• Infraestructura / Alta — wifi, red, vpn, servidor, conexión caída.\n• Seguridad / Media — acceso, contraseña, cuenta, virus, permisos.\n• Hardware / Media — impresora, monitor, teclado, laptop, no enciende.\n• Software / Baja — correo, Office, licencia, actualización, error de sistema.\nSi no hay coincidencias, el ticket queda como General / Baja.",
				'palabras' => ['categoria', 'clasificacion', 'clasifica', 'prioridad', 'infraestructura', 'hardware', 'software', 'seguridad', 'automatico', 'inteligente']
			],
			[
				'id' => 'estados',
				'audiencia' => 'todos',
				'pregunta' => '¿Qué significa cada estado de un ticket?',
				'respuesta' => "Un ticket recorre tres estados:\n• Pendiente — registrado y a la espera de atención.\n• En proceso — un agente está trabajando en la solución.\n• Ejecutada — la incidencia fue resuelta y el caso cerrado.\nSolo los roles Gerente y Soporte pueden cambiar el estado.",
				'palabras' => ['estado', 'estatus', 'pendiente', 'en proceso', 'ejecutada', 'cerrado', 'resuelto', 'seguimiento']
			],
			[
				'id' => 'asignar',
				'audiencia' => 'interno',
				'roles' => ['Gerente', 'Soporte'],
				'pregunta' => '¿Cómo asigno o reasigno un ticket?',
				'respuesta' => "Entra al detalle del ticket desde el tablero y usa el selector de asignación. La reasignación a Soporte solo la puede realizar el rol Gerente.\nAl reasignar, actualiza el estado a \"En proceso\" y deja un comentario con el contexto del caso.",
				'enlace' => ['texto' => 'Ir al tablero', 'ruta' => '?route=dashboard'],
				'palabras' => ['asignar', 'asigno', 'asignacion', 'asignado', 'reasignar', 'responsable', 'agente', 'delegar']
			],
			[
				'id' => 'escalamiento',
				'audiencia' => 'interno',
				'pregunta' => '¿Cuándo debo escalar una incidencia?',
				'respuesta' => "Si tras 30 minutos (o el SLA del servicio) no hay avances en Primer Nivel, escala a Nivel 2.\nAl escalar comparte el ID del ticket, los síntomas, los pasos ya realizados, los logs y las capturas de pantalla.",
				'enlace' => ['texto' => 'Manual de escalamiento', 'ruta' => '?route=help_docs'],
				'palabras' => ['escalar', 'escalamiento', 'nivel 2', 'sla', 'supervisor', 'manual']
			],
			[
				'id' => 'comentarios',
				'audiencia' => 'interno',
				'pregunta' => '¿Cómo agrego comentarios a un ticket?',
				'respuesta' => "Abre el detalle del ticket y escribe en la bitácora de comentarios. Documenta cada acción realizada, por mínima que sea: es el historial que verá el siguiente nivel de atención.\nLos comentarios están disponibles para los roles Gerente y Soporte.",
				'palabras' => ['comentario', 'comentarios', 'bitacora', 'historial', 'nota', 'observacion']
			],
			[
				'id' => 'reportes',
				'audiencia' => 'interno',
				'roles' => ['Gerente', 'Soporte'],
				'pregunta' => '¿Cómo genero un reporte de tickets?',
				'respuesta' => "Entra en \"Generar Reportes\" desde el menú, aplica los filtros que necesites (fechas, estado, prioridad, categoría) y descarga el archivo CSV.\nEl archivo incluye ID, título, descripción, departamento, categoría, prioridad, estado, responsable, creador y fechas.",
				'enlace' => ['texto' => 'Generar reporte', 'ruta' => '?route=ticket_report'],
				'palabras' => ['reporte', 'reportes', 'csv', 'exportar', 'descargar', 'excel', 'informe']
			],
			[
				'id' => 'estadisticas',
				'audiencia' => 'interno',
				'roles' => ['Gerente', 'Soporte'],
				'pregunta' => '¿Dónde veo las estadísticas de incidencias?',
				'respuesta' => "En el menú operativo encontrarás \"Estadísticas\": totales por estado, prioridad y categoría, además del crecimiento mensual comparado con el mes anterior.",
				'enlace' => ['texto' => 'Ver estadísticas', 'ruta' => '?route=ticket_stats'],
				'palabras' => ['estadistica', 'estadisticas', 'grafico', 'metrica', 'indicador', 'crecimiento']
			],
			[
				'id' => 'usuarios',
				'audiencia' => 'interno',
				'roles' => ['Gerente'],
				'pregunta' => '¿Cómo creo o elimino usuarios?',
				'respuesta' => "Solo el rol Gerente administra cuentas. Usa \"Crear Usuario\" para registrar una nueva cuenta con su rol y departamento, y \"Listar Usuarios\" para editarlas o eliminarlas.",
				'enlace' => ['texto' => 'Crear usuario', 'ruta' => '?route=create_user'],
				'palabras' => ['crear usuario', 'nuevo usuario', 'usuario', 'usuarios', 'cuenta nueva', 'eliminar usuario', 'eliminar cuenta', 'administrar usuarios']
			],
			[
				'id' => 'roles',
				'audiencia' => 'todos',
				'pregunta' => '¿Qué puede hacer cada rol?',
				'respuesta' => "• Gerente — acceso total: tickets, asignación, eliminación, usuarios, reportes y estadísticas.\n• Soporte — gestiona tickets, cambia estados, comenta, genera reportes y estadísticas.\n• Analista — crea incidencias y consulta únicamente las propias.\n• Público — solo puede enviar solicitudes al Centro de Ayuda.",
				'palabras' => ['rol', 'roles', 'permiso', 'permisos', 'gerente', 'soporte', 'analista', 'privilegios']
			],
			[
				'id' => 'eliminar-ticket',
				'audiencia' => 'interno',
				'roles' => ['Gerente'],
				'pregunta' => '¿Se puede eliminar un ticket?',
				'respuesta' => "Sí, pero únicamente el rol Gerente puede hacerlo desde el detalle del ticket. La eliminación es permanente: antes de borrar, exporta un reporte CSV si necesitas conservar el registro.",
				'palabras' => ['eliminar ticket', 'borrar ticket', 'eliminar incidencia', 'quitar ticket', 'anular ticket']
			],
			[
				'id' => 'centro-ayuda',
				'audiencia' => 'todos',
				'pregunta' => '¿Cómo contacto con una persona de soporte?',
				'respuesta' => "Envía tu caso desde el Centro de Ayuda: completa nombre, correo, asunto y descripción, y un agente te contactará.\nCanales alternos: correo soporte@bdt.com o línea directa (0212) 555-0101. La mesa de ayuda responde en menos de 24 horas hábiles.",
				'enlace' => ['texto' => 'Ir al Centro de Ayuda', 'ruta' => '?route=help'],
				'palabras' => ['contacto', 'contactar', 'hablar', 'humano', 'persona', 'telefono', 'correo', 'ayuda', 'horario']
			],
			[
				'id' => 'sesion',
				'audiencia' => 'todos',
				'pregunta' => '¿Por qué se cierra mi sesión?',
				'respuesta' => "La sesión se mantiene del lado del servidor entre recargas y navegaciones. Si se cierra sola, suele deberse a inactividad prolongada, a cookies bloqueadas en el navegador o a un cierre de sesión desde otra pestaña.\nVuelve a ingresar con tus credenciales: los tickets guardados no se pierden.",
				'palabras' => ['sesion', 'se cierra', 'expira', 'desconecta', 'cookies', 'inactividad']
			],
			[
				'id' => 'requisitos',
				'audiencia' => 'todos',
				'pregunta' => '¿Qué necesito para usar el sistema?',
				'respuesta' => "Un navegador actualizado (Chrome, Edge o Firefox) y acceso a la URL del sistema. No necesitas instalar nada en tu equipo.",
				'palabras' => ['requisito', 'requisitos', 'navegador', 'instalar', 'chrome', 'edge', 'firefox', 'compatibilidad']
			],
		];
	}

	/** Normaliza texto: minúsculas, sin acentos y sin signos. */
	public static function normalizar($texto) {
		$texto = mb_strtolower(trim((string)$texto), 'UTF-8');
		$acentos = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ü'=>'u','ñ'=>'n','à'=>'a','è'=>'e','ì'=>'i','ò'=>'o','ù'=>'u'];
		$texto = strtr($texto, $acentos);
		$texto = preg_replace('/[^a-z0-9\s]/u', ' ', $texto);
		return trim(preg_replace('/\s+/', ' ', $texto));
	}

	/** Preguntas visibles según la sesión activa. */
	public static function disponibles($logueado = false, $rol = '') {
		return array_values(array_filter(self::base(), function ($faq) use ($logueado, $rol) {
			$audiencia = $faq['audiencia'] ?? 'todos';
			if ($audiencia === 'interno' && !$logueado) return false;
			if (!empty($faq['roles']) && !in_array($rol, $faq['roles'], true)) return false;
			return true;
		}));
	}

	/**
	 * Busca la mejor respuesta para una consulta.
	 * Devuelve ['faq' => array|null, 'puntaje' => int, 'sugerencias' => array].
	 */
	public static function responder($consulta, $logueado = false, $rol = '') {
		$texto = self::normalizar($consulta);
		$disponibles = self::disponibles($logueado, $rol);

		if ($texto === '') {
			return ['faq' => null, 'puntaje' => 0, 'sugerencias' => array_slice($disponibles, 0, 3)];
		}

		$tokens = array_filter(explode(' ', $texto), function ($t) {
			return mb_strlen($t) > 2 && !in_array($t, self::PALABRAS_VACIAS, true);
		});
		$puntajes = [];

		foreach ($disponibles as $i => $faq) {
			$puntaje = 0;

			// Palabras clave: 3 puntos por frase completa, 2 por término suelto.
			foreach ($faq['palabras'] as $palabra) {
				$clave = self::normalizar($palabra);
				if ($clave === '') continue;
				if (strpos($texto, $clave) !== false) {
					$puntaje += (strpos($clave, ' ') !== false) ? 3 : 2;
				}
			}

			// Coincidencia con las palabras de la pregunta: 1 punto cada una.
			$palabrasPregunta = explode(' ', self::normalizar($faq['pregunta']));
			foreach ($tokens as $token) {
				if (in_array($token, $palabrasPregunta, true)) $puntaje += 1;
			}

			if ($puntaje > 0) $puntajes[$i] = $puntaje;
		}

		if (empty($puntajes)) {
			return ['faq' => null, 'puntaje' => 0, 'sugerencias' => array_slice($disponibles, 0, 3)];
		}

		arsort($puntajes);
		$indices = array_keys($puntajes);
		$mejor = $indices[0];
		$mejorPuntaje = $puntajes[$mejor];

		if ($mejorPuntaje < self::UMBRAL_COINCIDENCIA) {
			$sugerencias = [];
			foreach (array_slice($indices, 0, 3) as $i) { $sugerencias[] = $disponibles[$i]; }
			return ['faq' => null, 'puntaje' => $mejorPuntaje, 'sugerencias' => $sugerencias];
		}

		// Alternativas cercanas (excluye la respuesta entregada).
		$sugerencias = [];
		foreach (array_slice($indices, 1, 2) as $i) { $sugerencias[] = $disponibles[$i]; }

		return ['faq' => $disponibles[$mejor], 'puntaje' => $mejorPuntaje, 'sugerencias' => $sugerencias];
	}
}
