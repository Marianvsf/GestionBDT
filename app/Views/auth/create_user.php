<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8 mt-[70px]">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Crear Usuario</h2>

        <?php if(isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-md text-red-700 mb-4 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-3 rounded-md text-emerald-700 mb-4 text-sm">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-gray-700">Usuario</label>
                <input type="text" name="username" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="role" class="w-full p-2 border rounded" required>
                    <option value="">Selecciona un rol</option>
                    <option value="Gerente">Gerente</option>
                    <option value="Analista">Analista</option>
                    <option value="Soporte">Soporte</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-[#010b50] text-white px-4 py-2 rounded hover:bg-blue-900">Crear</button>
                <a href="?route=dashboard" class="text-sm text-gray-600 hover:text-gray-800">Volver</a>
            </div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
