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
    if (!isset($_SESSION['user_id'])) { 
        header('Location: index.php'); 
        exit; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $desc = $_POST['description'];
        
        // --- RF-03: Simulación de IA para Clasificación (Optimizado) ---
        $category = 'General';
        $priority = 'Baja';
        $desc_lower = strtolower($desc);

        // 2. Diccionario de palabras clave
        $reglas = [
            'Infraestructura' => [
                'prioridad' => 'Alta',
                'palabras'  => ['wifi', 'red', 'internet', 'router', 'switch', 'vpn', 'servidor', 'cable', 'conexion', 'caido']
            ],
            'Seguridad' => [
                'prioridad' => 'Media',
                'palabras'  => ['login', 'acceso', 'contraseña', 'password', 'clave', 'cuenta', 'virus', 'malware', 'bloqueado', 'permisos']
            ],
            'Hardware' => [
                'prioridad' => 'Media',
                'palabras'  => ['impresora', 'pantalla', 'monitor', 'teclado', 'mouse', 'raton', 'computadora', 'laptop', 'pc', 'disco duro', 'no enciende']
            ],
            'Software' => [
                'prioridad' => 'Baja',
                'palabras'  => ['correo', 'email', 'excel', 'word', 'office', 'programa', 'aplicacion', 'error', 'licencia', 'actualizacion', 'sistema']
            ]
        ];

        foreach ($reglas as $cat_nombre => $datos) {
            foreach ($datos['palabras'] as $palabra) {
                if (strpos($desc_lower, $palabra) !== false) {
                    $category = $cat_nombre;
                    $priority = $datos['prioridad'];
                    break 2; 
                }
            }
        }
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

    public function report() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        $role = $_SESSION['role'] ?? '';
        if ($role !== 'Soporte' && $role !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $from = trim((string)($_POST['from_date'] ?? ''));
            $to = trim((string)($_POST['to_date'] ?? ''));
            $status = trim((string)($_POST['status'] ?? ''));
            $assigned = intval($_POST['assigned_to'] ?? 0);
            $category = trim((string)($_POST['category'] ?? ''));

            $pdo = \App\Config\Database::connect();
            $sql = "SELECT t.*, u.username AS creator_username, ass.username AS assigned_username FROM tickets t LEFT JOIN users u ON t.user_id = u.id LEFT JOIN users ass ON t.assigned_to = ass.id WHERE 1=1";
            $params = [];
            if ($from !== '') {
                $sql .= " AND DATE(t.created_at) >= :from";
                $params[':from'] = $from;
            }
            if ($to !== '') {
                $sql .= " AND DATE(t.created_at) <= :to";
                $params[':to'] = $to;
            }
            if ($status !== '' && $status !== 'all') {
                $sql .= " AND t.status = :status";
                $params[':status'] = $status;
            }
            if ($assigned > 0) {
                $sql .= " AND t.assigned_to = :assigned";
                $params[':assigned'] = $assigned;
            }
            if ($category !== '') {
                $sql .= " AND t.category LIKE :category";
                $params[':category'] = "%" . $category . "%";
            }
            $sql .= " ORDER BY t.created_at DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Emitir CSV
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="tickets_report_' . date('Ymd_His') . '.csv"');
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID','Title','Description','Category','Priority','Status','Assigned To','Creator','Created At','Updated At'], ',', '"', '\\');
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r['id'] ?? '',
                    $r['title'] ?? '',
                    $r['description'] ?? '',
                    $r['category'] ?? '',
                    $r['priority'] ?? '',
                    $r['status'] ?? '',
                    $r['assigned_username'] ?? $r['assigned_username'] ?? '',
                    $r['creator_username'] ?? '',
                    $r['created_at'] ?? '',
                    $r['updated_at'] ?? ''
                ], ',', '"', '\\');
            }
            fclose($out);
            exit;
        }

        $supportUsers = User::getSupportUsers();
        require __DIR__ . '/../Views/dashboard/report.php';
    }

    public function stats() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        $role = $_SESSION['role'] ?? '';
        if ($role !== 'Soporte' && $role !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }
        require __DIR__ . '/../Views/dashboard/stats.php';
    }

    public function statsData() {
        if (!isset($_SESSION['user_id'])) { header('HTTP/1.1 401 Unauthorized'); exit; }
        $role = $_SESSION['role'] ?? '';
        if ($role !== 'Soporte' && $role !== 'Gerente') { header('HTTP/1.1 403 Forbidden'); exit; }

        $pdo = \App\Config\Database::connect();
        // Total
        $total = intval($pdo->query('SELECT COUNT(*) FROM tickets')->fetchColumn());

        // By category
        $stmt = $pdo->query("SELECT COALESCE(category,'(Sin categoría)') AS category, COUNT(*) AS cnt FROM tickets GROUP BY category ORDER BY cnt DESC");
        $byCategory = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // By status
        $stmt = $pdo->query("SELECT COALESCE(status,'Pendiente') AS status, COUNT(*) AS cnt FROM tickets GROUP BY status");
        $byStatus = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // By priority
        $stmt = $pdo->query("SELECT COALESCE(priority,'Baja') AS priority, COUNT(*) AS cnt FROM tickets GROUP BY priority");
        $byPriority = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Timeseries last 30 days (SQLite compatible)
        $stmt = $pdo->prepare("SELECT DATE(created_at) AS d, COUNT(*) AS cnt FROM tickets WHERE DATE(created_at) >= DATE('now', '-29 days') GROUP BY DATE(created_at) ORDER BY d ASC");
        $stmt->execute();
        $timeseries = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'total' => $total,
            'byCategory' => $byCategory,
            'byStatus' => $byStatus,
            'byPriority' => $byPriority,
            'timeseries' => $timeseries
        ]);
        exit;
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