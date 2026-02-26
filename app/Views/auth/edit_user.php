<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8 mt-[70px]">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Editar Usuario</h2>

        <?php if(isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-md text-red-700 mb-4 text-sm">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
            <div>
                <label class="block text-gray-700">Usuario</label>
                <input type="text" name="username" class="w-full p-2 border rounded" required value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div>
                <label class="block text-gray-700">Contraseña <span class="text-sm text-gray-600">(dejar en blanco para mantener)</span></label>
                <input id="password" type="password" name="password" class="w-full p-2 border rounded">
                <label class="mt-2 inline-flex items-center gap-2 text-sm text-gray-600">
                    <input id="toggle-password" type="checkbox" class="rounded">
                    Mostrar contrasena
                </label>
            </div>
            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="role" class="w-full p-2 border rounded" required>
                    <option value="">Selecciona un rol</option>
                    <option value="Gerente" <?= ($user['role'] === 'Gerente') ? 'selected' : '' ?>>Gerente</option>
                    <option value="Analista" <?= ($user['role'] === 'Analista') ? 'selected' : '' ?>>Analista</option>
                    <option value="Soporte" <?= ($user['role'] === 'Soporte') ? 'selected' : '' ?>>Soporte</option>
                </select>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-[#010b50] text-white px-4 py-2 rounded hover:bg-blue-900">Guardar</button>
                <a href="?route=users" class="text-sm text-gray-600 hover:text-gray-800">Volver</a>
            </div>
        </form>
    </div>
</div>
<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');

    togglePassword.addEventListener('change', () => {
        passwordInput.type = togglePassword.checked ? 'text' : 'password';
    });
</script>
<?php require __DIR__ . '/../layout/footer.php'; ?>
