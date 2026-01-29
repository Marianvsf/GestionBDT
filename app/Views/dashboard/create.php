<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8 mt-[70px]">
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Reportar Incidencia</h2>
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700">Asunto</label>
            <input type="text" name="title" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Descripción Detallada</label>
            <textarea name="description" rows="4" class="w-full p-2 border rounded" placeholder="Describe el problema. Ej: No puedo acceder al wifi..." required></textarea>
            <p class="text-xs text-gray-500 mt-1">La IA clasificará esto automáticamente.</p>
        </div>
        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded">Enviar Reporte</button>
    </form>
</div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>