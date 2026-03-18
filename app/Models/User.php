<?php
namespace App\Models;
use App\Config\Database;
use PDO;

class User {
    public static function login($username, $password) {
        $normalized = self::normalizeUsername($username);
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE LOWER(username) = :username");
        $stmt->execute([':username' => $normalized]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function create($username, $password, $role, $department) {
        $normalized = self::normalizeUsername($username);
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role, department) VALUES (:username, :password, :role, :department)");
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([
            ':username' => $normalized,
            ':password' => $hashed,
            ':role' => $role,
            ':department' => $department
        ]);
    }

    public static function getAll() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, username, role, department FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT id, username, role, department FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $username, $role, $department, $password = null) {
        $normalized = self::normalizeUsername($username);
        $pdo = Database::connect();
        if ($password === null) {
            $stmt = $pdo->prepare("UPDATE users SET username = :username, role = :role, department = :department WHERE id = :id");
            return $stmt->execute([
                ':username' => $normalized,
                ':role' => $role,
                ':department' => $department,
                ':id' => $id
            ]);
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role, department = :department WHERE id = :id");
        return $stmt->execute([
            ':username' => $normalized,
            ':password' => $hashed,
            ':role' => $role,
            ':department' => $department,
            ':id' => $id
        ]);
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

    private static function normalizeUsername($username) {
        $normalized = trim((string) $username);
        return function_exists('mb_strtolower') ? mb_strtolower($normalized, 'UTF-8') : strtolower($normalized);
    }
}