<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class Ticket {
    public static function create($userId, $title, $description, $category, $priority) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO tickets (user_id, title, description, category, priority) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $title, $description, $category, $priority]);
    }

    public static function getAll() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM tickets ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}