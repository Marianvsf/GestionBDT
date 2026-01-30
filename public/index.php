<?php
// Iniciar sesión SIEMPRE al principio
session_start();

// Autoload manual (para no usar Composer)
require_once __DIR__ . '/../app/Config/Database.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Models/Ticket.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/TicketController.php';

use App\Controllers\AuthController;
use App\Controllers\TicketController;

// Enrutamiento simple
$route = $_GET['route'] ?? 'home';

$auth = new AuthController();
$ticket = new TicketController();

switch ($route) {
    case 'home':
        $auth->login();
        break;
    case 'login':
        $auth->login();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'create_user':
        $auth->createUser();
        break;
    case 'dashboard':
        $ticket->index();
        break;
    case 'create_ticket':
        $ticket->create();
        break;
    default:
        $auth->login();
        break;
}