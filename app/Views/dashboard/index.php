<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tablero de Control</h2>
    <a href="?route=create_ticket" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">+ Nueva Incidencia</a>
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
                    <span class="<?= $ticket['status'] == 'Pendiente' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' ?> py-1 px-3 rounded-full text-xs">
                        <?= $ticket['status'] ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>