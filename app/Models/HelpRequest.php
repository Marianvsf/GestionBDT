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
}
