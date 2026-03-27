<?php require __DIR__ . '/../layout/header.php'; ?>
<style>
    
    .feature-card {
        border: 1px solid rgba(203, 213, 225, 0.6);
        background: linear-gradient(160deg, rgba(241, 245, 249, 0.92), rgba(248, 250, 252, 0.98));
        box-shadow: 0 20px 45px -30px rgba(30, 41, 59, 0.35);
    }
</style>

<div class="container mx-auto px-12 pb-12 mt-[70px]">
<div class="feature-card p-12 rounded-lg max-w-3xl mx-auto">
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Reportar Incidencia</h2>
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700">Asunto</label>
            <input type="text" name="title" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Departamento</label>
            <select name="department" class="w-full p-2 border rounded bg-white" required>
                <option value="" disabled selected>Selecciona un departamento</option>
                <?php foreach (($departments ?? []) as $department): ?>
                    <option value="<?= htmlspecialchars($department) ?>"><?= htmlspecialchars($department) ?></option>
                <?php endforeach; ?>
            </select>
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
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>