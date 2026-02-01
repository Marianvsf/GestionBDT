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

    public static function getAll() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, username, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSupportUsers() {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT id, username FROM users WHERE role = 'Soporte' ORDER BY username ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteById($id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}