<?php
namespace App\Controllers;
use App\Models\Ticket;

class TicketController {
    public function index() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        
        $tickets = Ticket::getAll();
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
}