<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-16 sm:px-16 sm:max-w1-8xl lg:px-12 py-6 sm:py-8">
<?php if (empty($tickets) && empty($hasActiveFilters)): ?>
    <div class="bg-white rounded-lg mt-16 mx-auto shadow w-full max-w-[1080px] p-8 sm:p-10">
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
<?php elseif (empty($tickets) && !empty($hasActiveFilters)): ?>
    <div class="bg-white rounded-lg mt-16 mx-auto shadow w-full max-w-[1080px] p-8 sm:p-10">
        <div class="flex flex-col items-center text-center gap-3">
            <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">No se encontraron tickets</h3>
            <p class="text-gray-600 max-w-xl">
                Intenta ajustar los filtros para ver otros resultados.
            </p>
            <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-300/40">
                Limpiar filtros
            </a>
        </div>
    </div>
<?php else: ?>
<?php
    $formatCaracas = function ($value) {
        if (empty($value)) { return 'N/D'; }
        try {
            $dt = new DateTime($value);
            $dt->setTimezone(new DateTimeZone('America/Caracas'));
            return $dt->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return htmlspecialchars($value);
        }
    };

    $filterQuery = http_build_query(array_filter([
        'status' => $filters['status'] ?? '',
        'priority' => $filters['priority'] ?? '',
        'category' => $filters['category'] ?? '',
        'q' => $filters['q'] ?? ''
    ], function ($v) {
        return $v !== '';
    }));

    $dashboardAction = '?route=dashboard' . ($filterQuery !== '' ? '&' . $filterQuery : '');
?>
<div class="flex items-center justify-between mt-6 sm:mt-10 mb-6">
    <h2 class="text-xl mx-auto sm:text-2xl font-bold text-gray-800">Tablero de Control</h2>
</div>

<div class="bg-white mx-auto w-full sm:shadow sm:rounded-lg p-4 mb-4">
    <form method="GET" action="" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 items-end">
        <input type="hidden" name="route" value="dashboard">

        <div>
            <label for="filter-q" class="block text-xs font-semibold text-slate-600 mb-1">Buscar</label>
            <input id="filter-q" type="text" name="q" value="<?= htmlspecialchars($filters['q'] ?? '') ?>" placeholder="ID o título" class="w-full border border-slate-200 rounded-md px-3 py-2 text-sm">
        </div>

        <div>
            <label for="filter-status" class="block text-xs font-semibold text-slate-600 mb-1">Estado</label>
            <select id="filter-status" name="status" class="w-full border border-slate-200 rounded-md px-3 py-2 text-sm bg-white">
                <option value="">Todos</option>
                <option value="Pendiente" <?= (($filters['status'] ?? '') === 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                <option value="En proceso" <?= (($filters['status'] ?? '') === 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                <option value="Ejecutada" <?= (($filters['status'] ?? '') === 'Ejecutada') ? 'selected' : '' ?>>Ejecutada</option>
            </select>
        </div>

        <div>
            <label for="filter-priority" class="block text-xs font-semibold text-slate-600 mb-1">Prioridad</label>
            <select id="filter-priority" name="priority" class="w-full border border-slate-200 rounded-md px-3 py-2 text-sm bg-white">
                <option value="">Todas</option>
                <option value="Baja" <?= (($filters['priority'] ?? '') === 'Baja') ? 'selected' : '' ?>>Baja</option>
                <option value="Media" <?= (($filters['priority'] ?? '') === 'Media') ? 'selected' : '' ?>>Media</option>
                <option value="Alta" <?= (($filters['priority'] ?? '') === 'Alta') ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <div>
            <label for="filter-category" class="block text-xs font-semibold text-slate-600 mb-1">Categoría</label>
            <select id="filter-category" name="category" class="w-full border border-slate-200 rounded-md px-3 py-2 text-sm bg-white">
                <option value="">Todas</option>
                <?php foreach (($categoryOptions ?? []) as $categoryOption): ?>
                    <option value="<?= htmlspecialchars($categoryOption) ?>" <?= (($filters['category'] ?? '') === $categoryOption) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoryOption) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="inline-flex justify-center items-center rounded-md bg-indigo-600 text-white text-sm font-semibold px-4 py-2 hover:bg-indigo-700 transition w-full">
                Filtrar
            </button>
            <a href="?route=dashboard" class="inline-flex justify-center items-center rounded-md bg-slate-200 text-slate-700 text-sm font-semibold px-4 py-2 hover:bg-slate-300 transition w-full">
                Limpiar
            </a>
        </div>
    </form>
</div>

<div class="bg-transparent mx-auto sm:bg-white w-full sm:shadow sm:rounded-lg sm:overflow-hidden">
    <table class="w-full text-left border-collapse text-sm">
        <thead class="hidden md:table-header-group">
            <tr class="bg-gray-200 text-gray-700 uppercase text-xs leading-normal">
                <th class="py-3 px-6">ID</th>
                <th class="py-3 px-6">Título</th>
                <th class="py-3 px-6">Categoría</th>
                <th class="py-3 px-6">Prioridad</th>
                <th class="py-3 px-6">Asignado</th>
                <th class="py-3 px-6">Estado</th>
                <th class="py-3 px-6">Actualizado</th>
                <th class="py-3 px-6">Acción</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 font-light block md:table-row-group">
            <?php foreach ($tickets as $ticket): ?>
                <tr class="bg-white border border-gray-200 rounded-lg mb-4 block md:table-row md:border-b md:mb-0 hover:bg-gray-50 shadow-sm md:shadow-none md:rounded-none">
                    
                    <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                        <span class="font-bold text-gray-700 md:hidden">ID:</span>
                        <span class="font-medium"><?= $ticket['id'] ?></span>
                    </td>

                    <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                        <span class="font-bold text-gray-700 md:hidden">Título:</span>
                        <a class="text-blue-700 hover:underline font-bold break-words text-right md:text-left max-w-[200px] md:max-w-none truncate md:whitespace-normal" href="?route=ticket_detail&id=<?= $ticket['id'] ?>">
                            <?= htmlspecialchars($ticket['title']) ?>
                        </a>
                    </td>

                    <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                        <span class="font-bold text-gray-700 md:hidden">Categoría:</span>
                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs">
                            <?= $ticket['category'] ?>
                        </span>
                    </td>

                    <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                        <span class="font-bold text-gray-700 md:hidden">Prioridad:</span>
                        <span><?= $ticket['priority'] ?></span>
                    </td>

                    <?php $statusFormId = 'status-form-' . $ticket['id']; ?>
                    <td class="px-4 py-3 border-b md:border-0 flex flex-col md:table-cell gap-2">
                        <span class="font-bold text-gray-700 md:hidden mb-1">Asignado a:</span>
                        <div class="flex flex-col gap-2 w-full md:w-auto">
                            <?php if (!empty($ticket['assigned_username'])): ?>
                                <span class="bg-slate-100 text-slate-700 py-1 px-3 rounded-full text-xs w-fit">
                                    <?= htmlspecialchars($ticket['assigned_username']) ?>
                                    <?php if (isset($_SESSION['user_id']) && isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($_SESSION['user_id'])): ?>
                                        (Tú)
                                    <?php endif; ?>
                                </span>
                            <?php else: ?>
                                <span class="text-xs text-gray-400">Sin asignar</span>
                            <?php endif; ?>
                            
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                <select name="assigned_to" form="<?= $statusFormId ?>" class="border border-slate-200 rounded-md px-2 py-1 text-xs bg-white w-full">
                                    <option value="">Sin asignar</option>
                                    <?php foreach ($supportUsers as $supportUser): ?>
                                        <option value="<?= $supportUser['id'] ?>" <?= (isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($supportUser['id'])) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($supportUser['username']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </td>

                    <td class="px-4 py-3 border-b md:border-0 flex flex-col md:table-cell gap-2">
                        <span class="font-bold text-gray-700 md:hidden mb-1">Estado:</span>
                        <?php
                            $statusClass = 'bg-yellow-200 text-yellow-800';
                            if ($ticket['status'] === 'En proceso') { $statusClass = 'bg-blue-200 text-blue-800'; }
                            if ($ticket['status'] === 'Ejecutada') { $statusClass = 'bg-green-200 text-green-800'; }
                        ?>
                        <div class="flex flex-col gap-2">
                            <span class="<?= $statusClass ?> py-1 px-3 rounded-full text-xs w-fit">
                                <?= $ticket['status'] ?>
                            </span>
                            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                                <form id="<?= $statusFormId ?>" method="POST" action="<?= $dashboardAction ?>" class="w-full">
                                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                    <select name="status" class="border border-slate-200 rounded-md px-2 py-1 text-xs bg-white w-full">
                                        <option value="Pendiente" <?= $ticket['status'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="En proceso" <?= $ticket['status'] === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                                        <option value="Ejecutada" <?= $ticket['status'] === 'Ejecutada' ? 'selected' : '' ?>>Ejecutada</option>
                                    </select>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>

                    <td class="px-4 py-3 border-b md:border-0 flex justify-between items-center md:table-cell">
                        <span class="font-bold text-gray-700 md:hidden">Actualizado:</span>
                        <span class="text-xs text-slate-500">
                            <?= $formatCaracas($ticket['updated_at'] ?? null) ?>
                        </span>
                    </td>

                    <td class="px-4 py-3 flex flex-col md:table-cell gsap-2">
                         <span class="font-bold text-gray-700 md:hidden mb-1">Acciones:</span>
                        <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                            <div class="flex flex-row md:flex-row gap-2 w-full">
                                <button type="submit" form="<?= $statusFormId ?>" class="group relative">
                                    <svg 
                                        class="h-6 w-6 text-green-500 hover:text-green-700 transition-colors cursor-pointer" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke="currentColor" 
                                        stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="pointer-events-none absolute -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-slate-800 px-2 py-1 text-xs font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                        Guardar cambios
                                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-slate-800"></span>
                                </span>
                                </button>
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                    <form method="POST" action="?route=delete_ticket" class="flex-1" onsubmit="return confirm('¿Eliminar este ticket?');">
                                        <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                        <button type="submit" class="group relative">
                                            <svg class="h-5 w-5 text-red-500 hover:text-red-700 transition-colors cursor-pointer" fill="currentColor" viewBox="0 0 640 640">
                                                <path d="M262.2 48C248.9 48 236.9 56.3 232.2 68.8L216 112L120 112C106.7 112 96 122.7 96 136C96 149.3 106.7 160 120 160L520 160C533.3 160 544 149.3 544 136C544 122.7 533.3 112 520 112L424 112L407.8 68.8C403.1 56.3 391.2 48 377.8 48L262.2 48zM128 208L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 208L464 208L464 512C464 520.8 456.8 528 448 528L192 528C183.2 528 176 520.8 176 512L176 208L128 208zM288 280C288 266.7 277.3 256 264 256C250.7 256 240 266.7 240 280L240 456C240 469.3 250.7 480 264 480C277.3 480 288 469.3 288 456L288 280zM400 280C400 266.7 389.3 256 376 256C362.7 256 352 266.7 352 280L352 456C352 469.3 362.7 480 376 480C389.3 480 400 469.3 400 456L400 280z"/></svg>
                                                <span class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap rounded bg-red-700 px-2 py-1 text-xs font-medium text-white opacity-0 transition-opacity group-hover:opacity-100 shadow-lg z-50">
                                                    Eliminar ticket
                                                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 border-4 border-transparent border-t-red-700"></span>
                                            </span>
                                            </span>
                                        </button>
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