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
                <div class="relative">
                    <input id="password" type="password" name="password" class="w-full p-2 pr-10 border rounded">
                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none" aria-label="Mostrar u ocultar contrasena">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg id="eye-slash-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                            <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                            <line x1="2" y1="2" x2="22" y2="22" />
                        </svg>
                    </button>
                </div>
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

<?php require __DIR__ . '/../layout/footer.php'; ?>
