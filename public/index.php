<?php
echo "<h1>Prueba de vida</h1>";
echo "PHP Version: " . phpversion();
echo "<br>Extensión PDO Postgres: " . (extension_loaded('pdo_pgsql') ? 'Instalada' : 'NO INSTALADA');
exit;