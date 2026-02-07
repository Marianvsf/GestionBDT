<?php
namespace App\Controllers;
use App\Models\Ticket;
use App\Models\User;

class TicketController {
    public function index() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = $_SESSION['role'] ?? '';
            if ($role !== 'Gerente' && $role !== 'Soporte') { header('Location: index.php?route=dashboard'); exit; }

            $ticketId = intval($_POST['ticket_id'] ?? 0);
            $status = $_POST['status'] ?? '';
            $allowed = ['Pendiente', 'En proceso', 'Ejecutada'];

            $supportUsers = User::getSupportUsers();
            $supportIds = array_map('intval', array_column($supportUsers, 'id'));

            if ($ticketId > 0 && $role === 'Gerente' && array_key_exists('assigned_to', $_POST)) {
                $assignedRaw = trim((string)($_POST['assigned_to'] ?? ''));
                if ($assignedRaw === '') {
                    Ticket::assignTo($ticketId, null);
                } else {
                    $assignedTo = intval($assignedRaw);
                    if (in_array($assignedTo, $supportIds, true)) {
                        Ticket::assignTo($ticketId, $assignedTo);
                    }
                }
            }

            if ($ticketId > 0 && in_array($status, $allowed, true)) {
                Ticket::updateStatus($ticketId, $status);
            }
            header('Location: index.php?route=dashboard');
            exit;
        }

        $role = $_SESSION['role'] ?? '';
        if ($role === 'Analista') {
            $tickets = Ticket::getByUserId($_SESSION['user_id']);
        } else {
            $tickets = Ticket::getAll();
        }
        $supportUsers = User::getSupportUsers();
        require __DIR__ . '/../Views/dashboard/index.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $desc = $_POST['description'];
            
            // --- RF-03: Simulación de IA para Clasificación ---
            $category = 'General';
            $priority = 'Baja';
            
            if (strpos(strtolower($desc), 'wifi') !== false || strpos(strtolower($desc), 'red') !== false) {
                $category = 'Infraestructura';
                $priority = 'Alta';
            } elseif (strpos(strtolower($desc), 'login') !== false || strpos(strtolower($desc), 'acceso') !== false) {
                $category = 'Seguridad';
                $priority = 'Media';
            }
            // --------------------------------------------------

            Ticket::create($_SESSION['user_id'], $_POST['title'], $desc, $category, $priority);
            header('Location: index.php?route=dashboard');
        } else {
            require __DIR__ . '/../Views/dashboard/create.php';
        }
    }

    public function show() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        $ticketId = intval($_GET['id'] ?? 0);
        if ($ticketId <= 0) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $ticket = Ticket::getById($ticketId);
        if (!$ticket) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $role = $_SESSION['role'] ?? '';
        if ($role === 'Analista' && intval($ticket['user_id']) !== intval($_SESSION['user_id'])) {
            header('Location: index.php?route=dashboard');
            exit;
        }

        $comments = Ticket::getComments($ticketId);
        require __DIR__ . '/../Views/dashboard/show.php';
    }

    public function addComment() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        $role = $_SESSION['role'] ?? '';
        if ($role !== 'Soporte' && $role !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = intval($_POST['ticket_id'] ?? 0);
            $comment = trim((string)($_POST['comment'] ?? ''));
            if ($ticketId > 0 && $comment !== '') {
                $ticket = Ticket::getById($ticketId);
                if ($ticket) {
                    Ticket::addComment($ticketId, intval($_SESSION['user_id']), $comment);
                }
            }
            header('Location: index.php?route=ticket_detail&id=' . $ticketId);
            exit;
        }

        header('Location: index.php?route=dashboard');
        exit;
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = intval($_POST['ticket_id'] ?? 0);
            if ($ticketId > 0) {
                Ticket::deleteById($ticketId);
            }
        }

        header('Location: index.php?route=dashboard');
        exit;
    }
}