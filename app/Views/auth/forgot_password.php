<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Recuperar contraseña</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Introduce tu correo corporativo para recibir instrucciones.</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="rounded-md bg-red-50 p-4">
                <p class="text-sm font-medium text-red-700"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="rounded-md bg-emerald-50 p-4">
                <p class="text-sm font-medium text-emerald-700"><?= htmlspecialchars($success) ?></p>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="?route=forgot_password" method="POST">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Correo corporativo</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-[#010b50] focus:border-[#010b50] focus:z-10 sm:text-sm" placeholder="tu.nombre@empresa.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#010b50] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#010b50]">
                    Enviar instrucciones (simulado)
                </button>
            </div>
        </form>

        <div class="text-center">
            <a href="?route=login" class="text-sm font-medium text-[#010b50] hover:text-blue-800">Volver al inicio de sesión</a>
        </div>
        <p class="mt-4 text-xs text-gray-500 text-center">Nota: Esta es una simulación; no se envía correo real.</p>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
