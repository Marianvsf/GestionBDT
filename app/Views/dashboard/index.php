<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.05);
    }
    
    .input-modern {
        background-color: #f8fafc;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    
    .input-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Mejora de la tabla en móvil para que parezcan tarjetas */
    @media (max-width: 768px) {
        .mobile-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            box-shadow: 0 2px 10px -2px rgba(0,0,0,0.02);
        }
        .mobile-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .mobile-row:last-child {
            border-bottom: none;
        }
    }
</style>

<div class="container mx-auto px-4 lg:px-8 py-8 w-full max-w-7xl overflow-hidden min-h-screen">
    
    <?php if (empty($tickets) && empty($hasActiveFilters)): ?>
        <div class="mt-20 mx-auto max-w-2xl text-center">
            <div class="glass-panel p-10 sm:p-16 rounded-[2rem] flex flex-col items-center gap-6 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                
                <div class="h-20 w-20 rounded-3xl bg-gradient-to-br from-emerald-100 to-teal-50 text-emerald-600 flex items-center justify-center shadow-inner relative z-10">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-slate-800 tracking-tight mb-3">Todo al día</h3>
                    <p class="text-slate-500 max-w-md mx-auto text-lg leading-relaxed">
                        Aún no tienes incidencias reportadas. Crea tu primer ticket para dar inicio a la gestión operativa.
                    </p>
                </div>
                <a href="?route=create_ticket" class="relative z-10 mt-2 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-slate-900/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Registrar nueva incidencia
                </a>
            </div>
        </div>

    <?php elseif (empty($tickets) && !empty($hasActiveFilters)): ?>
        <div class="mt-20 mx-auto max-w-2xl text-center">
            <div class="glass-panel p-10 sm:p-12 rounded-[2rem] flex flex-col items-center gap-5">
                <div class="h-16 w-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Sin resultados</h3>
                <p class="text-slate-500 max-w-md text-base">
                    No encontramos tickets que coincidan con los filtros actuales. Prueba ajustando la búsqueda.
                </p>
                <a href="?route=dashboard" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-slate-300">
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
                    return $dt->format('d M, Y - h:i A'); // Formato más limpio y legible
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
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tablero Operativo</h2>
                <p class="text-sm text-slate-500 mt-1">Monitorea y gestiona el flujo de incidencias técnicas.</p>
            </div>
            <a href="?route=create_ticket" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition hover:bg-slate-800 hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Ticket
            </a>
        </div>

        <div class="glass-panel p-5 rounded-2xl mb-8">
            <form method="GET" action="" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 items-end">
                <input type="hidden" name="route" value="dashboard">

                <div class="lg:col-span-4 relative">
                    <label for="filter-q" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Búsqueda</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input id="filter-q" type="text" name="q" value="<?= htmlspecialchars($filters['q'] ?? '') ?>" placeholder="ID o palabra clave..." class="input-modern block w-full rounded-xl py-2.5 pl-10 pr-3 text-sm text-slate-700 placeholder-slate-400">
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label for="filter-status" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Estado</label>
                    <select id="filter-status" name="status" class="input-modern block w-full rounded-xl py-2.5 px-3 text-sm text-slate-700 cursor-pointer">
                        <option value="">Todos</option>
                        <option value="Pendiente" <?= (($filters['status'] ?? '') === 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                        <option value="En proceso" <?= (($filters['status'] ?? '') === 'En proceso') ? 'selected' : '' ?>>En proceso</option>
                        <option value="Ejecutada" <?= (($filters['status'] ?? '') === 'Ejecutada') ? 'selected' : '' ?>>Ejecutada</option>
                    </select>
                </div>

                <div class="lg:col-span-2">
                    <label for="filter-priority" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Prioridad</label>
                    <select id="filter-priority" name="priority" class="input-modern block w-full rounded-xl py-2.5 px-3 text-sm text-slate-700 cursor-pointer">
                        <option value="">Todas</option>
                        <option value="Baja" <?= (($filters['priority'] ?? '') === 'Baja') ? 'selected' : '' ?>>Baja</option>
                        <option value="Media" <?= (($filters['priority'] ?? '') === 'Media') ? 'selected' : '' ?>>Media</option>
                        <option value="Alta" <?= (($filters['priority'] ?? '') === 'Alta') ? 'selected' : '' ?>>Alta</option>
                    </select>
                </div>

                <div class="lg:col-span-2">
                    <label for="filter-category" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Categoría</label>
                    <select id="filter-category" name="category" class="input-modern block w-full rounded-xl py-2.5 px-3 text-sm text-slate-700 cursor-pointer">
                        <option value="">Todas</option>
                        <?php foreach (($categoryOptions ?? []) as $categoryOption): ?>
                            <option value="<?= htmlspecialchars($categoryOption) ?>" <?= (($filters['category'] ?? '') === $categoryOption) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoryOption) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="lg:col-span-2 flex gap-2 h-[42px]">
                    <button type="submit" class="flex-1 inline-flex justify-center items-center rounded-xl bg-indigo-600 text-white text-sm font-semibold transition-all hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500/50">
                        Filtrar
                    </button>
                    <?php if(!empty($filterQuery)): ?>
                    <a href="?route=dashboard" class="inline-flex justify-center items-center rounded-xl bg-white border border-slate-200 text-slate-600 text-sm p-2.5 transition-colors hover:bg-slate-50 hover:text-slate-900" title="Limpiar filtros">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/80 border-b border-slate-200 hidden md:table-header-group">
                        <tr>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Ticket</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Detalle</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Estado</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Asignación</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actualizado</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 divide-y divide-slate-100 block md:table-row-group bg-slate-50 md:bg-white p-4 md:p-0">
                        <?php foreach ($tickets as $ticket): ?>
                            <tr class="mobile-card md:bg-white md:border-0 md:rounded-none md:shadow-none md:p-0 md:mb-0 block md:table-row transition-colors hover:bg-slate-50/60 group">
                                
                                <td class="px-5 py-4 mobile-row md:table-cell align-top">
                                    <span class="font-bold text-slate-500 md:hidden text-xs uppercase">ID:</span>
                                    <div class="flex flex-col items-end md:items-start">
                                        <span class="font-mono font-semibold text-slate-900">#<?= str_pad($ticket['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                        <span class="mt-1 bg-slate-100 text-slate-600 py-0.5 px-2 rounded-md text-[11px] font-medium tracking-wide">
                                            <?= $ticket['category'] ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-5 py-4 mobile-row md:table-cell align-top w-full md:w-auto">
                                    <div class="flex flex-col gap-1 w-full text-right md:text-left">
                                        <a class="text-slate-900 font-bold hover:text-indigo-600 transition-colors truncate max-w-[280px] lg:max-w-sm text-base" href="?route=ticket_detail&id=<?= $ticket['id'] ?>">
                                            <?= htmlspecialchars($ticket['title']) ?>
                                        </a>
                                        <div class="flex items-center justify-end md:justify-start gap-1.5 mt-1">
                                            <?php 
                                                $prioColors = [
                                                    'Baja' => 'bg-emerald-500',
                                                    'Media' => 'bg-amber-500',
                                                    'Alta' => 'bg-rose-500'
                                                ];
                                                $dotColor = $prioColors[$ticket['priority']] ?? 'bg-slate-400';
                                            ?>
                                            <span class="w-2 h-2 rounded-full <?= $dotColor ?>"></span>
                                            <span class="text-xs text-slate-500 font-medium">Prioridad <?= strtolower($ticket['priority']) ?></span>
                                        </div>
                                    </div>
                                </td>

                                <?php $statusFormId = 'status-form-' . $ticket['id']; ?>
                                <td class="px-5 py-4 mobile-row md:table-cell md:text-center align-top">
                                    <span class="font-bold text-slate-500 md:hidden text-xs uppercase">Estado:</span>
                                    <div class="flex flex-col justify-center items-end md:items-center w-full">
                                        <?php
                                            $statusStyles = [
                                                'Pendiente' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                                'En proceso' => 'bg-blue-50 text-blue-700 border-blue-200/60',
                                                'Ejecutada' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60'
                                            ];
                                            $sClass = $statusStyles[$ticket['status']] ?? 'bg-slate-50 text-slate-700 border-slate-200';
                                        ?>
                                        
                                        <?php if(isset($_SESSION['role']) && in_array($_SESSION['role'], ['Gerente', 'Soporte'])): ?>
                                            <form id="<?= $statusFormId ?>" method="POST" action="<?= $dashboardAction ?>" class="w-full md:w-auto">
                                                <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                                <select name="status" onchange="this.form.submit()" class="<?= $sClass ?> border text-xs font-bold rounded-lg px-2.5 py-1.5 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 cursor-pointer appearance-none text-center">
                                                    <option value="Pendiente" <?= $ticket['status'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                                    <option value="En proceso" <?= $ticket['status'] === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                                                    <option value="Ejecutada" <?= $ticket['status'] === 'Ejecutada' ? 'selected' : '' ?>>Ejecutada</option>
                                                </select>
                                            </form>
                                        <?php else: ?>
                                            <span class="<?= $sClass ?> border text-xs font-bold rounded-lg px-2.5 py-1">
                                                <?= $ticket['status'] ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td class="px-5 py-4 mobile-row md:table-cell md:text-center align-top">
                                    <span class="font-bold text-slate-500 md:hidden text-xs uppercase">Asignado a:</span>
                                    <div class="flex flex-col items-end md:items-center">
                                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                            <select name="assigned_to" form="<?= $statusFormId ?>" onchange="this.form.submit()" class="input-modern border-slate-200 text-xs font-medium rounded-lg px-2.5 py-1.5 max-w-[140px] truncate">
                                                <option value="">Sin asignar</option>
                                                <?php foreach ($supportUsers as $supportUser): ?>
                                                    <option value="<?= $supportUser['id'] ?>" <?= (isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($supportUser['id'])) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($supportUser['username']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <?php if (!empty($ticket['assigned_username'])): ?>
                                                <div class="flex items-center gap-2">
                                                    <div class="h-6 w-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-[10px] font-bold uppercase">
                                                        <?= substr(htmlspecialchars($ticket['assigned_username']), 0, 2) ?>
                                                    </div>
                                                    <span class="text-xs font-medium text-slate-700">
                                                        <?= htmlspecialchars($ticket['assigned_username']) ?>
                                                        <?= (isset($_SESSION['user_id']) && isset($ticket['assigned_to']) && intval($ticket['assigned_to']) === intval($_SESSION['user_id'])) ? '(Tú)' : '' ?>
                                                    </span>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-xs font-medium text-slate-400 border border-dashed border-slate-300 rounded-lg px-2 py-1">Sin asignar</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td class="px-5 py-4 mobile-row md:table-cell align-top text-right">
                                    <span class="font-bold text-slate-500 md:hidden text-xs uppercase text-left w-full">Actualizado:</span>
                                    <span class="text-[13px] text-slate-500 font-medium">
                                        <?= $formatCaracas($ticket['updated_at'] ?? null) ?>
                                    </span>
                                </td>

                                <td class="px-5 py-4 mobile-row md:table-cell align-top border-b-0">
                                    <div class="flex justify-end md:justify-center items-center gap-2">
                                        <a href="?route=ticket_detail&id=<?= $ticket['id'] ?>" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Ver detalles">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>

                                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                            <form method="POST" action="?route=delete_ticket" class="inline-flex" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ticket de forma permanente?');">
                                                <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Eliminar ticket">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>