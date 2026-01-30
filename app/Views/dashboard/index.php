<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8">
<div class="flex jfiustify-between m-[70px] mx-auto items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tablero de Control</h2>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                <th class="py-3 px-6">ID</th>
                <th class="py-3 px-6">Título</th>
                <th class="py-3 px-6">Categoría (IA)</th>
                <th class="py-3 px-6">Prioridad</th>
                <th class="py-3 px-6">Estado</th>
                <th class="py-3 px-6">Acción</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php foreach ($tickets as $ticket): ?>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6"><?= $ticket['id'] ?></td>
                <td class="py-3 px-6 font-bold"><?= htmlspecialchars($ticket['title']) ?></td>
                <td class="py-3 px-6"><span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs"><?= $ticket['category'] ?></span></td>
                <td class="py-3 px-6"><?= $ticket['priority'] ?></td>
                <td class="py-3 px-6">
                    <?php
                        $statusClass = 'bg-yellow-200 text-yellow-800';
                        if ($ticket['status'] === 'En proceso') { $statusClass = 'bg-blue-200 text-blue-800'; }
                        if ($ticket['status'] === 'Ejecutada') { $statusClass = 'bg-green-200 text-green-800'; }
                    ?>
                    <span class="<?= $statusClass ?> py-1 px-3 rounded-full text-xs">
                        <?= $ticket['status'] ?>
                    </span>
                </td>
                <td class="py-3 px-6">
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                        <form method="POST" action="?route=dashboard" class="flex items-center gap-2">
                            <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                            <select name="status" class="border rounded px-2 py-1 text-xs">
                                <option value="Pendiente" <?= $ticket['status'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="En proceso" <?= $ticket['status'] === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                                <option value="Ejecutada" <?= $ticket['status'] === 'Ejecutada' ? 'selected' : '' ?>>Ejecutada</option>
                            </select>
                            <button type="submit" class="text-xs bg-[#010b50] text-white px-2 py-1 rounded">Actualizar</button>
                        </form>
                    <?php else: ?>
                        <span class="text-xs text-gray-400">Solo admin/soporte</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>