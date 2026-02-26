<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8 mt-[70px]">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Usuarios</h2>
            <a href="?route=create_user" class="text-sm text-indigo-700 hover:underline">Crear usuario</a>
        </div>

        <?php if(isset($flashError)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-3 rounded-md text-red-700 mb-4 text-sm">
                <?= htmlspecialchars($flashError) ?>
            </div>
        <?php endif; ?>

        <?php if(isset($flashSuccess)): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-3 rounded-md text-emerald-700 mb-4 text-sm">
                <?= htmlspecialchars($flashSuccess) ?>
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Usuario</th>
                        <th class="py-3 px-6">Rol</th>
                        <th class="py-3 px-6">Acción</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($users as $user): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6"><?= $user['id'] ?></td>
                            <td class="py-3 px-6 font-semibold"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="py-3 px-6"><?= htmlspecialchars($user['role']) ?></td>
                            <td class="py-3 px-6">
                                <?php if (intval($user['id']) === intval($_SESSION['user_id'])): ?>
                                    <span class="text-xs text-gray-400">Tu usuario</span>
                                <?php else: ?>
                                    <div class="flex items-center gap-3">
                                        <a href="?route=edit_user&id=<?= $user['id'] ?>" class="text-sm text-indigo-700 hover:underline">Editar</a>
                                        <form method="POST" action="?route=delete_user" onsubmit="return confirm('¿Eliminar este usuario?')">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="group relative justify-center">
                                                <svg class="h-5 w-5 text-red-500 hover:text-red-700 transition-colors cursor-pointer" fill="currentColor" viewBox="0 0 640 640">
                                                <path d="M262.2 48C248.9 48 236.9 56.3 232.2 68.8L216 112L120 112C106.7 112 96 122.7 96 136C96 149.3 106.7 160 120 160L520 160C533.3 160 544 149.3 544 136C544 122.7 533.3 112 520 112L424 112L407.8 68.8C403.1 56.3 391.2 48 377.8 48L262.2 48zM128 208L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 208L464 208L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 208L128 208zM288 280C288 266.7 277.3 256 264 256C250.7 256 240 266.7 240 280L240 456C240 469.3 250.7 480 264 480C277.3 480 288 469.3 288 456L288 280zM400 280C400 266.7 389.3 256 376 256C362.7 256 352 266.7 352 280L352 456C352 469.3 362.7 480 376 480C389.3 480 400 469.3 400 456L400 280z"/></svg>
                                                <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-red-700 px-2 py-1 text-xs font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                    Eliminar ticket
                                                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-red-700"></span>
                                            </span>
                                            </span>
                                        </button>
                                    </form>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>