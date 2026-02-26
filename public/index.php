<?php
// 1. Forzar que se muestren errores si algo falla
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Mensaje de prueba inmediato
echo "<h1>El servidor PHP está VIVO</h1>";
echo "Puerto detectado: " . getenv('PORT') . "<br>";
echo "Extensión Postgres: " . (extension_loaded('pdo_pgsql') ? 'CARGADA' : 'FALTA');

// 3. Detener todo aquí para que no cargue la base de datos
exit;