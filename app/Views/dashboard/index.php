<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-4 sm:px-6 lg:px-12 py-6 sm:py-8">
<?php if (empty($tickets)): ?>
    <div class="bg-white rounded-lg mt-16 mx-auto shadow max-w-[1080px] p-8 sm:p-10">
        <div class="flex flex-col items-center text-center gap-4">
            <div class="h-16 w-16 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl">
                ✅
            </div>
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">¡Bienvenido!</h3>
            <p class="text-gray-600 max-w-xl">
                Aún no has reportado incidencias. Crea tu primer ticket para comenzar el seguimiento.
            </p>
            <a href="?route=create_ticket" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40">
                Crear incidencia
            </a>
        </div>
    </div>
<?php else: ?>
<div class="flex items-center justify-between mt-6 sm:mt-10 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Tablero de Control</h2>
</div>
<div class="overflow-x-auto bg-white rounded-lg shadow max-w-[1440px]">
    <table class="w-full min-w-[900px] text-left border-collapse text-xs sm:text-sm max-w-[1440px]">
        <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                <th class="py-3 px-6">ID</th>
                <th class="py-3 px-6">Título</th>
                <th class="py-3 px-6">Categoría (IA)</th>
                <th class="py-3 px-6">Prioridad</th>
                <th class="py-3 px-6">Asignado</th>
                <th class="py-3 px-6">Estado</th>
                <th class="py-3 px-6">Acción</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <?php foreach ($tickets as $ticket): ?>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6"><?= $ticket['id'] ?></td>
                <td class="py-3 px-6 font-bold">
                    <a class="text-blue-700 hover:underline" href="?route=ticket_detail&id=<?= $ticket['id'] ?>">
                        <?= htmlspecialchars($ticket['title']) ?>
                    </a>
                </td>
                <td class="py-3 px-6"><span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs"><?= $ticket['category'] ?></span></td>
                <td class="py-3 px-6"><?= $ticket['priority'] ?></td>
                <td class="py-3 px-6">
                    <?php if (!empty($ticket['assigned_username'])): ?>
                        <span class="bg-slate-100 text-slate-700 py-1 px-3 rounded-full text-xs">
                            <?= htmlspecialchars($ticket['assigned_username']) ?>
                            <?php if (isset($_SESSION['user_id']) && isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($_SESSION['user_id'])): ?>
                                (Tú)
                            <?php endif; ?>
                        </span>
                    <?php else: ?>
                        <span class="text-xs text-gray-400">Sin asignar</span>
                    <?php endif; ?>
                </td>
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
                        <div class="flex flex-col md:flex-row items-center justify-center gap-2 flex-wrap w-full">
                            <form method="POST" action="?route=dashboard" class="flex items-center justify-center gap-2 flex-wrap w-full md:w-auto">
                            <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                            <select name="status" class="border rounded px-2 py-1 text-xs w-full sm:w-auto">
                                <option value="Pendiente" <?= $ticket['status'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="En proceso" <?= $ticket['status'] === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                                <option value="Ejecutada" <?= $ticket['status'] === 'Ejecutada' ? 'selected' : '' ?>>Ejecutada</option>
                            </select>
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                <select name="assigned_to" class="border rounded px-2 py-1 text-xs w-full sm:w-auto">
                                    <option value="">Sin asignar</option>
                                    <?php foreach ($supportUsers as $supportUser): ?>
                                        <option value="<?= $supportUser['id'] ?>" <?= (isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($supportUser['id'])) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($supportUser['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                                <button type="submit" class="text-xs bg-[#010b50] text-white px-2 py-1 rounded w-full sm:w-auto">Actualizar</button>
                            </form>
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                <form method="POST" action="?route=delete_ticket" class="inline-flex justify-center w-full md:w-auto" onsubmit="return confirm('¿Eliminar este ticket?');">
                                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                    <button type="submit" class="text-xs bg-red-600 text-white px-2 py-1 rounded w-full sm:w-auto">Eliminar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <span class="text-xs text-gray-400">Solo admin/soporte</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>