<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class Ticket {

    public static function getByUserId($userId) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT tickets.*, users.username AS assigned_username
             FROM tickets
             LEFT JOIN users ON tickets.assigned_to = users.id
             WHERE tickets.user_id = :user_id
             ORDER BY tickets.created_at DESC"
        );
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($userId, $title, $description, $category, $priority) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO tickets (user_id, title, description, category, priority) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $title, $description, $category, $priority]);
    }

    public static function updateStatus($ticketId, $status) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE tickets SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        return $stmt->execute([
            ':status' => $status,
            ':id' => $ticketId
        ]);
    }

    public static function assignTo($ticketId, $assignedTo) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE tickets SET assigned_to = :assigned_to, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        return $stmt->execute([
            ':assigned_to' => $assignedTo,
            ':id' => $ticketId
        ]);
    }

    public static function getAll() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT tickets.*, users.username AS assigned_username FROM tickets LEFT JOIN users ON tickets.assigned_to = users.id ORDER BY tickets.created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($ticketId) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT tickets.*, u.username AS creator_username, ass.username AS assigned_username
             FROM tickets
             LEFT JOIN users u ON tickets.user_id = u.id
             LEFT JOIN users ass ON tickets.assigned_to = ass.id
             WHERE tickets.id = :id"
        );
        $stmt->execute([':id' => $ticketId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteById($ticketId) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM tickets WHERE id = :id");
        return $stmt->execute([':id' => $ticketId]);
    }

    public static function addComment($ticketId, $userId, $comment) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO ticket_comments (ticket_id, user_id, comment) VALUES (:ticket_id, :user_id, :comment)");
        $ok = $stmt->execute([
            ':ticket_id' => $ticketId,
            ':user_id' => $userId,
            ':comment' => $comment
        ]);
        if ($ok) {
            $pdo->prepare("UPDATE tickets SET updated_at = CURRENT_TIMESTAMP WHERE id = :id")
                ->execute([':id' => $ticketId]);
        }
        return $ok;
    }

    public static function getComments($ticketId) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare(
            "SELECT ticket_comments.*, users.username
             FROM ticket_comments
             LEFT JOIN users ON ticket_comments.user_id = users.id
             WHERE ticket_comments.ticket_id = :ticket_id
             ORDER BY ticket_comments.created_at ASC"
        );
        $stmt->execute([':ticket_id' => $ticketId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}