<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BDT - Gestión de Proyectos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-[#010b50] text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Banco Digital de los Trabajadores</h1>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div>
                    <a href="?route=dashboard" class="px-3">Mis Tickets</a>
                    <a href="?route=create_ticket" class="px-3">Nuevo Reporte</a>
                    <a href="?route=logout" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Salir</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mx-auto mt-8 p-4">