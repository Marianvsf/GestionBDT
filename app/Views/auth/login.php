<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-900">Acceso BDT</h2>
    <?php if(isset($error)): ?>
        <p class="text-red-500 mb-4 text-center"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="?route=login">
        <div class="mb-4">
            <label class="block text-gray-700">Usuario</label>
            <input type="text" name="username" class="w-full p-2 border rounded mt-1" placeholder="admin" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700">Contraseña</label>
            <input type="password" name="password" class="w-full p-2 border rounded mt-1" placeholder="123456" required>
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white p-2 rounded hover:bg-blue-800 transition">Ingresar</button>
    </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>