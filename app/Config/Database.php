<?php
namespace App\Config;
use PDO;
use PDOException;

class Database {
    private static ?PDO $connection = null;
    private static bool $envLoaded = false;

    public static function connect() {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        self::loadEnvFile();

        $driver = self::env('DB_CONNECTION', 'sqlite');
        $dsn = '';
        $username = null;
        $password = null;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            if ($driver === 'pgsql' || $driver === 'postgres' || $driver === 'postgresql') {
                [$dsn, $username, $password] = self::buildPgsqlConnection();
            } else {
                $dbPath = self::env('SQLITE_PATH', __DIR__ . '/../../database/bdt.sqlite');
                $dsn = 'sqlite:' . $dbPath;
            }

            self::$connection = new PDO($dsn, $username, $password, $options);

            self::runMigrations(self::$connection, $driver);
            self::seedDefaultAdmin(self::$connection);

        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }

        return self::$connection;
    }

    private static function runMigrations(PDO $pdo, string $driver): void {
        $normalized = strtolower($driver);

        if ($normalized === 'pgsql' || $normalized === 'postgres' || $normalized === 'postgresql') {
            $pdo->exec("CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                username VARCHAR(120) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(80) NOT NULL
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS tickets (
                id SERIAL PRIMARY KEY,
                user_id INTEGER,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                category VARCHAR(120),
                priority VARCHAR(60),
                status VARCHAR(60) DEFAULT 'Pendiente',
                assigned_to INTEGER,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS ticket_comments (
                id SERIAL PRIMARY KEY,
                ticket_id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                comment TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS help_requests (
                id SERIAL PRIMARY KEY,
                user_id INTEGER,
                name VARCHAR(200) NOT NULL,
                email VARCHAR(200) NOT NULL,
                phone VARCHAR(60),
                subject VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

            if (!self::columnExists($pdo, 'tickets', 'assigned_to', $normalized)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN assigned_to INTEGER");
            }
            if (!self::columnExists($pdo, 'tickets', 'updated_at', $normalized)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN updated_at TIMESTAMP");
                $pdo->exec("UPDATE tickets SET updated_at = created_at WHERE updated_at IS NULL");
            }
        } else {
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
                assigned_to INTEGER,
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

            if (!self::columnExists($pdo, 'tickets', 'assigned_to', $normalized)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN assigned_to INTEGER");
            }
            if (!self::columnExists($pdo, 'tickets', 'updated_at', $normalized)) {
                $pdo->exec("ALTER TABLE tickets ADD COLUMN updated_at DATETIME");
                $pdo->exec("UPDATE tickets SET updated_at = created_at WHERE updated_at IS NULL");
            }
        }
    }

    private static function seedDefaultAdmin(PDO $pdo): void {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE LOWER(username) = :username');
        $stmt->execute([':username' => 'admin']);

        if ((int) $stmt->fetchColumn() === 0) {
            $pass = password_hash('123456', PASSWORD_DEFAULT);
            $insert = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (:username, :password, :role)');
            $insert->execute([
                ':username' => 'admin',
                ':password' => $pass,
                ':role' => 'Gerente',
            ]);
        }
    }

    private static function columnExists(PDO $pdo, string $table, string $column, string $driver): bool {
        if ($driver === 'pgsql' || $driver === 'postgres' || $driver === 'postgresql') {
            $query = $pdo->prepare("SELECT 1 FROM information_schema.columns WHERE table_schema = 'public' AND table_name = :table AND column_name = :column LIMIT 1");
            $query->execute([
                ':table' => $table,
                ':column' => $column,
            ]);
            return (bool) $query->fetchColumn();
        }

        $columns = $pdo->query("PRAGMA table_info($table)")->fetchAll(PDO::FETCH_COLUMN, 1);
        return in_array($column, $columns, true);
    }

    private static function buildPgsqlConnection(): array {
        $databaseUrl = self::env('DATABASE_URL', '');

        if (!empty($databaseUrl)) {
            $parts = parse_url($databaseUrl);
            if ($parts !== false) {
                $host = $parts['host'] ?? '127.0.0.1';
                $port = $parts['port'] ?? 5432;
                $dbName = isset($parts['path']) ? ltrim($parts['path'], '/') : 'postgres';
                $user = $parts['user'] ?? '';
                $pass = $parts['pass'] ?? '';
                $dsn = "pgsql:host={$host};port={$port};dbname={$dbName}";
                return [$dsn, $user, $pass];
            }
        }

        $host = self::env('DB_HOST', '127.0.0.1');
        $port = self::env('DB_PORT', '5432');
        $dbName = self::env('DB_DATABASE', 'gestionbdt');
        $user = self::env('DB_USERNAME', 'postgres');
        $pass = self::env('DB_PASSWORD', '');

        $dsn = "pgsql:host={$host};port={$port};dbname={$dbName}";
        return [$dsn, $user, $pass];
    }

    private static function loadEnvFile(): void {
        if (self::$envLoaded) {
            return;
        }

        self::$envLoaded = true;
        $envPath = __DIR__ . '/../../.env';

        if (!file_exists($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!is_array($lines)) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || strpos($line, '=') === false) {
                continue;
            }

            [$key, $value] = array_map('trim', explode('=', $line, 2));
            $value = trim($value, "\"'");

            if ($key !== '' && getenv($key) === false) {
                putenv("{$key}={$value}");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    private static function env(string $key, ?string $default = null): ?string {
        $value = getenv($key);
        if ($value === false || $value === '') {
            return $default;
        }

        return $value;
    }
}