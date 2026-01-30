<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class User {
    public static function login($username, $password) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function create($username, $password, $role) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([
            ':username' => $username,
            ':password' => $hashed,
            ':role' => $role
        ]);
    }
}