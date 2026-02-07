<?php
// Zona horaria por defecto (Venezuela)
date_default_timezone_set('America/Caracas');

// Iniciar sesión SIEMPRE al principio
session_start();

// Autoload manual (para no usar Composer)
require_once __DIR__ . '/../app/Config/Database.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Models/Ticket.php';
require_once __DIR__ . '/../app/Models/HelpRequest.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/TicketController.php';
require_once __DIR__ . '/../app/Controllers/HelpController.php';

use App\Controllers\AuthController;
use App\Controllers\TicketController;
use App\Controllers\HelpController;

// Enrutamiento simple
$route = $_GET['route'] ?? 'home';

$auth = new AuthController();
$ticket = new TicketController();
$help = new HelpController();

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
    case 'users':
        $auth->users();
        break;
    case 'help':
        $help->create();
        break;
    case 'delete_user':
        $auth->deleteUser();
        break;
    case 'ticket_detail':
        $ticket->show();
        break;
    case 'add_comment':
        $ticket->addComment();
        break;
    case 'delete_ticket':
        $ticket->delete();
        break;
    default:
        $auth->login();
        break;
}