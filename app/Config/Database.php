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

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 5, 
    ];

    try {
        [$dsn, $username, $password] = self::buildPgsqlConnection();
        
        // DEBUG: Esto saldrá en logs de Railway
        error_log("Intentando conectar a DSN: $dsn con usuario: $username");

        self::$connection = new PDO($dsn, $username, $password, $options);

        self::runMigrations(self::$connection, 'pgsql');
        self::seedDefaultAdmin(self::$connection);

    } catch (PDOException $e) {
        die("<h1>ERROR DE CONEXIÓN REAL:</h1>" . $e->getMessage());
    }

    return self::$connection;
}

    private static function buildPgsqlConnection(): array {
    // 1. PRIORIDAD: usar las variables individuales que configuraste en Render
    $host   = self::env('DB_HOST');
    $user   = self::env('DB_USER');
    $pass   = self::env('DB_PASSWORD');
    $dbName = self::env('DB_NAME');
    $port   = self::env('DB_PORT', '5432');

    // Si todas las variables individuales existen, las usamos
    if ($host && $user && $pass && $dbName) {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";
        return [$dsn, $user, $pass];
    }

    // 2. SEGUNDA OPCIÓN: Intentar con DATABASE_URL si las individuales no están
    $databaseUrl = self::env('DATABASE_URL');
    if (!empty($databaseUrl)) {
        $parts = parse_url($databaseUrl);
        if ($parts !== false) {
            $host = $parts['host'] ?? '';
            $port = $parts['port'] ?? 5432;
            $dbName = isset($parts['path']) ? ltrim($parts['path'], '/') : '';
            $user = $parts['user'] ?? '';
            $pass = $parts['pass'] ?? '';
            
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";
            return [$dsn, $user, $pass];
        }
    }

    // 3. ÚLTIMA OPCIÓN: Valores por defecto (Local)
    $dsn = "pgsql:host=127.0.0.1;port=5432;dbname=railway";
    return [$dsn, 'postgres', ''];
}

    private static function runMigrations(PDO $pdo, string $driver): void {
        $normalized = strtolower($driver);

        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                username VARCHAR(120) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
            role VARCHAR(80) NOT NULL,
            department VARCHAR(180)
            )");

        $pdo->exec("CREATE TABLE IF NOT EXISTS tickets (
                id SERIAL PRIMARY KEY,
                user_id INTEGER,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
            department VARCHAR(180),
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
            $pdo->exec("ALTER TABLE tickets ADD COLUMN IF NOT EXISTS assigned_to INTEGER");
        }
        if (!self::columnExists($pdo, 'tickets', 'updated_at', $normalized)) {
            $pdo->exec("ALTER TABLE tickets ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP");
            $pdo->exec("UPDATE tickets SET updated_at = created_at WHERE updated_at IS NULL");
        }
        if (!self::columnExists($pdo, 'tickets', 'department', $normalized)) {
            $pdo->exec("ALTER TABLE tickets ADD COLUMN IF NOT EXISTS department VARCHAR(180)");
        }
        if (!self::columnExists($pdo, 'users', 'department', $normalized)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS department VARCHAR(180)");
        }
    }

    private static function seedDefaultAdmin(PDO $pdo): void {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE LOWER(username) = :username');
        $stmt->execute([':username' => 'admin']);

        if ((int) $stmt->fetchColumn() === 0) {
            $pass = password_hash('123456', PASSWORD_DEFAULT);
            $insert = $pdo->prepare('INSERT INTO users (username, password, role, department) VALUES (:username, :password, :role, :department)');
            $insert->execute([
                ':username' => 'admin',
                ':password' => $pass,
                ':role'     => 'Gerente',
                ':department' => 'Operaciones',
            ]);
        }
    }

    private static function columnExists(PDO $pdo, string $table, string $column, string $driver): bool {
        if (in_array($driver, ['pgsql', 'postgres', 'postgresql'])) {
            $query = $pdo->prepare("SELECT 1 FROM information_schema.columns WHERE table_schema = 'public' AND table_name = :table AND column_name = :column LIMIT 1");
            $query->execute([':table' => $table, ':column' => $column]);
            return (bool) $query->fetchColumn();
        }
        return false;
    }

    private static function loadEnvFile(): void {
        if (self::$envLoaded) return;
        self::$envLoaded = true;

        $envPath = __DIR__ . '/../../.env';
        if (!file_exists($envPath)) return;

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (empty(trim($line)) || str_starts_with(trim($line), '#')) continue;
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
        return ($value === false || $value === '') ? $default : $value;
    }
}