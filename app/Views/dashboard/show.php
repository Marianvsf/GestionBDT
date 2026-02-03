<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-12 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detalle de Incidencia</h2>
        <div class="flex items-center gap-3">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                <form method="POST" action="?route=delete_ticket" onsubmit="return confirm('¿Eliminar este ticket?');">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                    <button type="submit" class="text-xs bg-red-600 text-white px-3 py-2 rounded">Eliminar</button>
                </form>
            <?php endif; ?>
            <a href="?route=dashboard" class="text-sm text-blue-700 hover:underline">Volver al tablero</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">ID</p>
                <p class="text-lg font-semibold text-gray-800"><?= $ticket['id'] ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Título</p>
                <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($ticket['title']) ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Categoría (IA)</p>
                <span class="inline-flex bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs">
                    <?= $ticket['category'] ?>
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Prioridad</p>
                <p class="text-lg font-semibold text-gray-800"><?= $ticket['priority'] ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Estado</p>
                <?php
                    $statusClass = 'bg-yellow-200 text-yellow-800';
                    if ($ticket['status'] === 'En proceso') { $statusClass = 'bg-blue-200 text-blue-800'; }
                    if ($ticket['status'] === 'Ejecutada') { $statusClass = 'bg-green-200 text-green-800'; }
                ?>
                <span class="inline-flex <?= $statusClass ?> py-1 px-3 rounded-full text-xs">
                    <?= $ticket['status'] ?>
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Fecha de creación</p>
                <p class="text-lg font-semibold text-gray-800">
                    <?= isset($ticket['created_at']) ? htmlspecialchars($ticket['created_at']) : 'N/D' ?>
                </p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-sm text-gray-500 mb-2">Descripción</p>
            <div class="bg-gray-50 border rounded p-4 text-gray-700 whitespace-pre-line">
                <?= htmlspecialchars($ticket['description']) ?>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
