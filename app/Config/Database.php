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
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS ticket_comments (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ticket_id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                comment TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS help_requests (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT,
                subject TEXT NOT NULL,
                message TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )");

            $columns = $pdo->query("PRAGMA table_info(tickets)")->fetchAll(PDO::FETCH_COLUMN, 1);
            if (!in_array('assigned_to', $columns, true)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN assigned_to INTEGER");
            }
            if (!in_array('updated_at', $columns, true)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN updated_at DATETIME");
                $pdo->exec("UPDATE tickets SET updated_at = created_at WHERE updated_at IS NULL");
            }

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