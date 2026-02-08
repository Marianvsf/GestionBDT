<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class HelpRequest {
	public static function create($userId, $name, $email, $phone, $subject, $message) {
		$pdo = Database::connect();
		$stmt = $pdo->prepare(
			"INSERT INTO help_requests (user_id, name, email, phone, subject, message)
			 VALUES (:user_id, :name, :email, :phone, :subject, :message)"
		);
		return $stmt->execute([
			':user_id' => $userId,
			':name' => $name,
			':email' => $email,
			':phone' => $phone,
			':subject' => $subject,
			':message' => $message
		]);
	}

	public static function getAll() {
		$pdo = Database::connect();
		$stmt = $pdo->query(
			"SELECT help_requests.*, users.username
			 FROM help_requests
			 LEFT JOIN users ON help_requests.user_id = users.id
			 ORDER BY help_requests.created_at DESC"
		);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
