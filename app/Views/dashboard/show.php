<?php require __DIR__ . '/../layout/header.php'; ?>
<?php
    $formatCaracas = function ($value) {
        if (empty($value)) { return 'N/D'; }
        try {
            $dt = new DateTime($value, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('America/Caracas'));
            return $dt->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return htmlspecialchars($value);
        }
    };
?>
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
                    <?= $formatCaracas($ticket['created_at'] ?? null) ?>
                </p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-sm text-gray-500 mb-2">Descripción</p>
            <div class="bg-gray-50 border rounded p-4 text-gray-700 whitespace-pre-line">
                <?= htmlspecialchars($ticket['description']) ?>
            </div>
        </div>

        <div class="mt-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Comentarios de Soporte</h3>
                <span class="text-xs text-gray-400"><?= count($comments ?? []) ?> comentario(s)</span>
            </div>

            <?php if (!empty($comments)): ?>
                <div class="space-y-3">
                    <?php foreach ($comments as $comment): ?>
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-semibold text-slate-700">
                                    <?= htmlspecialchars($comment['username'] ?? 'Soporte') ?>
                                </p>
                                <span class="text-xs text-slate-400">
                                    <?= $formatCaracas($comment['created_at'] ?? null) ?>
                                </span>
                            </div>
                            <p class="text-sm text-slate-700 whitespace-pre-line">
                                <?= htmlspecialchars($comment['comment'] ?? '') ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="bg-slate-50 border border-dashed border-slate-200 rounded-lg p-4 text-sm text-slate-500">
                    Aún no hay comentarios de soporte.
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Soporte' || $_SESSION['role'] === 'Gerente')): ?>
                <form method="POST" action="?route=add_comment" class="mt-5">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Agregar comentario</label>
                    <textarea name="comment" rows="3" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="Escribe una actualización para el equipo..." required></textarea>
                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="text-xs font-semibold bg-[#010b50] text-white px-4 py-2 rounded-md shadow-sm hover:bg-[#0b1f7a]">Publicar comentario</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
