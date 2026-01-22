<?php
namespace App\Config;
use PDO;
use PDOException;

class Database {
    public static function connect() {
        // Ruta absoluta al archivo SQLite para evitar errores en despliegue
        $dbPath = __DIR__ . '/../../database/bdt.sqlite';
        $pdo = null;

        try {
            $pdo = new PDO("sqlite:" . $dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Crear tablas si no existen (Migración automática)
            $pdo->exec("CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                role TEXT NOT NULL
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS tickets (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                title TEXT NOT NULL,
                description TEXT NOT NULL,
                category TEXT,
                priority TEXT,
                status TEXT DEFAULT 'Pendiente',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            // Seed (Usuario por defecto): admin / 123456
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
            $stmt->execute();
            if ($stmt->fetchColumn() == 0) {
                $pass = password_hash('123456', PASSWORD_DEFAULT);
                $pdo->exec("INSERT INTO users (username, password, role) VALUES ('admin', '$pass', 'Gerente')");
            }

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
        return $pdo;
    }
}