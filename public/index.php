<?php
// Forzar visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Prueba de vida del servidor</h1>";
echo "PHP está funcionando correctamente.<br>";

// Verificar si las extensiones de Postgres están activas
echo "PDO Postgres: " . (extension_loaded('pdo_pgsql') ? 'INSTALADA' : 'FALTA') . "<br>";

exit;