<?php
namespace App\Controllers;
use App\Models\Ticket;
use App\Models\User;

class TicketController {
    private const DEPARTMENTS = [
        'Recursos Humanos',
        'Operaciones',
        'Gestión de Riesgos',
        'Finanzas y Contabilidad',
        'Tecnología de la Información (TI)',
        'Auditoría Interna',
        'Cumplimiento',
        'Marketing y Comunicaciones',
        'Atención al Cliente',
        'Banca Minorista',
        'Banca Corporativa',
        'Banca de Inversión',
        'Tesorería',
        'Análisis de Crédito',
        'Cobranzas',
        'Departamento Legal',
    ];

    public function index() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

        $filterStatus = trim((string)($_GET['status'] ?? ''));
        $filterPriority = trim((string)($_GET['priority'] ?? ''));
        $filterCategory = trim((string)($_GET['category'] ?? ''));
        $filterSearch = trim((string)($_GET['q'] ?? ''));

        $allowedStatus = ['Pendiente', 'En proceso', 'Ejecutada'];
        $allowedPriority = ['Baja', 'Media', 'Alta'];

        if ($filterStatus !== '' && !in_array($filterStatus, $allowedStatus, true)) {
            $filterStatus = '';
        }
        if ($filterPriority !== '' && !in_array($filterPriority, $allowedPriority, true)) {
            $filterPriority = '';
        }

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
            $redirectParams = ['route' => 'dashboard'];
            if ($filterStatus !== '') { $redirectParams['status'] = $filterStatus; }
            if ($filterPriority !== '') { $redirectParams['priority'] = $filterPriority; }
            if ($filterCategory !== '') { $redirectParams['category'] = $filterCategory; }
            if ($filterSearch !== '') { $redirectParams['q'] = $filterSearch; }

            header('Location: index.php?' . http_build_query($redirectParams));
            exit;
        }

        $role = $_SESSION['role'] ?? '';
        if ($role === 'Analista') {
            $baseTickets = Ticket::getByUserId($_SESSION['user_id']);
        } else {
            $baseTickets = Ticket::getAll();
        }

        $categoryOptions = [];
        foreach ($baseTickets as $t) {
            $category = trim((string)($t['category'] ?? ''));
            if ($category !== '') {
                $categoryOptions[$category] = true;
            }
        }
        $categoryOptions = array_keys($categoryOptions);
        sort($categoryOptions, SORT_NATURAL | SORT_FLAG_CASE);

        $tickets = array_values(array_filter($baseTickets, function ($ticket) use ($filterStatus, $filterPriority, $filterCategory, $filterSearch) {
            if ($filterStatus !== '' && (($ticket['status'] ?? '') !== $filterStatus)) {
                return false;
            }
            if ($filterPriority !== '' && (($ticket['priority'] ?? '') !== $filterPriority)) {
                return false;
            }
            if ($filterCategory !== '' && (($ticket['category'] ?? '') !== $filterCategory)) {
                return false;
            }
            if ($filterSearch !== '') {
                $title = strtolower((string)($ticket['title'] ?? ''));
                $id = (string)($ticket['id'] ?? '');
                $query = strtolower($filterSearch);
                if (strpos($title, $query) === false && strpos($id, $query) === false) {
                    return false;
                }
            }
            return true;
        }));

        $hasActiveFilters = ($filterStatus !== '' || $filterPriority !== '' || $filterCategory !== '' || $filterSearch !== '');
        $filters = [
            'status' => $filterStatus,
            'priority' => $filterPriority,
            'category' => $filterCategory,
            'q' => $filterSearch,
        ];

        $supportUsers = User::getSupportUsers();
        require __DIR__ . '/../Views/dashboard/index.php';
    }

    public function create() {
    if (!isset($_SESSION['user_id'])) { 
        header('Location: index.php'); 
        exit; 
    }

    $departments = self::DEPARTMENTS;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $department = trim((string)($_POST['department'] ?? ''));
        if (!in_array($department, $departments, true)) {
            $department = 'No especificado';
        }

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
        Ticket::create($_SESSION['user_id'], $_POST['title'], $desc, $department, $category, $priority);
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
            fputcsv($out, ['ID','Title','Description','Department','Category','Priority','Status','Assigned To','Creator','Created At','Updated At'], ',', '"', '\\');
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r['id'] ?? '',
                    $r['title'] ?? '',
                    $r['description'] ?? '',
                    $r['department'] ?? '',
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

        $today = new \DateTimeImmutable('today');
        $defaultToDate = $today->format('Y-m-d');
        $defaultFromDate = $today->modify('-29 days')->format('Y-m-d');

        $fromDate = trim((string)($_GET['from_date'] ?? $defaultFromDate));
        $toDate = trim((string)($_GET['to_date'] ?? $defaultToDate));

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fromDate)) {
            $fromDate = $defaultFromDate;
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $toDate)) {
            $toDate = $defaultToDate;
        }

        if ($fromDate > $toDate) {
            $tmp = $fromDate;
            $fromDate = $toDate;
            $toDate = $tmp;
        }

        $pdo = \App\Config\Database::connect();
        $driver = $pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);

        if ($driver === 'sqlite') {
            $rangeWhere = ' WHERE DATE(created_at) >= :from AND DATE(created_at) <= :to';
            $timeseriesWhere = ' WHERE DATE(created_at) >= :from AND DATE(created_at) <= :to';
        } else {
            $rangeWhere = ' WHERE created_at::date >= :from AND created_at::date <= :to';
            $timeseriesWhere = ' WHERE created_at::date >= :from AND created_at::date <= :to';
        }

        $rangeParams = [
            ':from' => $fromDate,
            ':to' => $toDate,
        ];

        // Total
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM tickets' . $rangeWhere);
        $stmt->execute($rangeParams);
        $total = intval($stmt->fetchColumn());

        // By category
        $stmt = $pdo->prepare("SELECT COALESCE(category,'(Sin categoría)') AS category, COUNT(*) AS cnt FROM tickets" . $rangeWhere . ' GROUP BY category ORDER BY cnt DESC');
        $stmt->execute($rangeParams);
        $byCategory = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // By status
        $stmt = $pdo->prepare("SELECT COALESCE(status,'Pendiente') AS status, COUNT(*) AS cnt FROM tickets" . $rangeWhere . ' GROUP BY status');
        $stmt->execute($rangeParams);
        $byStatus = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // By priority
        $stmt = $pdo->prepare("SELECT COALESCE(priority,'Baja') AS priority, COUNT(*) AS cnt FROM tickets" . $rangeWhere . ' GROUP BY priority');
        $stmt->execute($rangeParams);
        $byPriority = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Timeseries within the selected range (DB-driver aware: SQLite vs PostgreSQL)
        if ($driver === 'sqlite') {
            $stmt = $pdo->prepare("SELECT DATE(created_at) AS d, COUNT(*) AS cnt FROM tickets" . $timeseriesWhere . ' GROUP BY DATE(created_at) ORDER BY d ASC');
        } else {
            // PostgreSQL: use date cast for date-only filtering.
            $stmt = $pdo->prepare("SELECT (created_at::date) AS d, COUNT(*) AS cnt FROM tickets" . $timeseriesWhere . ' GROUP BY (created_at::date) ORDER BY d ASC');
        }
        $stmt->execute($rangeParams);
        $timeseries = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // Comparativa mensual (mes corriente vs mes anterior) basada en la fecha "to"
        try {
            $ref = new \DateTimeImmutable($toDate);
        } catch (Exception $e) {
            $ref = new \DateTimeImmutable('today');
        }

        $currStart = $ref->modify('first day of this month')->format('Y-m-d');
        $currEnd = $ref->modify('last day of this month')->format('Y-m-d');
        $prevRef = $ref->modify('-1 month');
        $prevStart = $prevRef->modify('first day of this month')->format('Y-m-d');
        $prevEnd = $prevRef->modify('last day of this month')->format('Y-m-d');

        // Helper to build driver-aware between clause
        if ($driver === 'sqlite') {
            $cmWhere = ' WHERE DATE(created_at) BETWEEN :cm_from AND :cm_to';
            $pmWhere = ' WHERE DATE(created_at) BETWEEN :pm_from AND :pm_to';
        } else {
            $cmWhere = ' WHERE created_at::date BETWEEN :cm_from AND :cm_to';
            $pmWhere = ' WHERE created_at::date BETWEEN :pm_from AND :pm_to';
        }

        // Totals for current and previous month
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM tickets' . $cmWhere);
        $stmt->execute([':cm_from' => $currStart, ':cm_to' => $currEnd]);
        $currTotal = intval($stmt->fetchColumn());

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM tickets' . $pmWhere);
        $stmt->execute([':pm_from' => $prevStart, ':pm_to' => $prevEnd]);
        $prevTotal = intval($stmt->fetchColumn());

        $computePct = function($curr, $prev) {
            if ($prev == 0) return ($curr > 0) ? 100.0 : 0.0;
            return round((($curr - $prev) / max(1, $prev)) * 100.0, 1);
        };

        $monthlyGrowth = [
            'total' => [
                'current' => $currTotal,
                'previous' => $prevTotal,
                'pct' => $computePct($currTotal, $prevTotal)
            ],
            'byCategory' => []
        ];

        // By category for current and previous month
        $stmt = $pdo->prepare("SELECT COALESCE(category,'(Sin categoría)') AS category, COUNT(*) AS cnt FROM tickets" . $cmWhere . ' GROUP BY category');
        $stmt->execute([':cm_from' => $currStart, ':cm_to' => $currEnd]);
        $currCats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT COALESCE(category,'(Sin categoría)') AS category, COUNT(*) AS cnt FROM tickets" . $pmWhere . ' GROUP BY category');
        $stmt->execute([':pm_from' => $prevStart, ':pm_to' => $prevEnd]);
        $prevCats = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $prevMap = [];
        foreach ($prevCats as $pc) {
            $prevMap[$pc['category']] = intval($pc['cnt']);
        }

        foreach ($currCats as $cc) {
            $cat = $cc['category'];
            $cval = intval($cc['cnt']);
            $pval = $prevMap[$cat] ?? 0;
            $monthlyGrowth['byCategory'][] = [
                'category' => $cat,
                'current' => $cval,
                'previous' => $pval,
                'pct' => $computePct($cval, $pval)
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'total' => $total,
            'byCategory' => $byCategory,
            'byStatus' => $byStatus,
            'byPriority' => $byPriority,
            'timeseries' => $timeseries,
            'monthlyGrowth' => $monthlyGrowth
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