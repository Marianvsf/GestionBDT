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
                                    <form method="POST" action="?route=delete_user" onsubmit="return confirm('¿Eliminar este usuario?')">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <button class="text-xs bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Eliminar</button>
                                    </form>
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