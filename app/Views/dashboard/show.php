<?php require __DIR__ . '/../layout/header.php'; ?>
<?php
    $formatCaracas = function ($value) {
        if (empty($value)) { return 'N/D'; }
        try {
            $dt = new DateTime($value);
            $dt->setTimezone(new DateTimeZone('America/Caracas'));
            // Formato más legible para el usuario
            return $dt->format('d/m/Y - h:i A');
        } catch (Exception $e) {
            return htmlspecialchars($value);
        }
    };

    // Lógica visual para el Estado
    $statusClass = 'bg-slate-100 text-slate-700 border-slate-200'; // Default
    if ($ticket['status'] === 'Pendiente') { $statusClass = 'bg-amber-100 text-amber-700 border-amber-200'; }
    if ($ticket['status'] === 'En proceso') { $statusClass = 'bg-blue-100 text-blue-700 border-blue-200'; }
    if ($ticket['status'] === 'Ejecutada' || $ticket['status'] === 'Resuelta') { $statusClass = 'bg-emerald-100 text-emerald-700 border-emerald-200'; }

    // Lógica visual para la Prioridad (Asumiendo Baja, Media, Alta)
    $priorityClass = 'text-slate-600 bg-slate-50'; // Default
    $priority = strtolower($ticket['priority'] ?? '');
    if (str_contains($priority, 'alta') || str_contains($priority, 'crítica')) { $priorityClass = 'text-red-700 bg-red-50 border border-red-100'; }
    if (str_contains($priority, 'media')) { $priorityClass = 'text-amber-700 bg-amber-50 border border-amber-100'; }
    if (str_contains($priority, 'baja')) { $priorityClass = 'text-emerald-700 bg-emerald-50 border border-emerald-100'; }
?>

<div class="container mx-auto px-4 py-8 lg:px-12 max-w-7xl relative z-10">
    
    <!-- Encabezado y Acciones -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="?route=dashboard" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-500 hover:text-[#010b50] hover:bg-slate-50 transition-colors shadow-sm" title="Volver al tablero">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <span class="text-sm font-bold text-slate-400 uppercase tracking-wider">Ticket #<?= htmlspecialchars($ticket['id']) ?></span>
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                <?= htmlspecialchars($ticket['title']) ?>
            </h2>
        </div>
        
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold border <?= $statusClass ?> shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full mr-2 currentColor bg-current"></span>
                <?= htmlspecialchars($ticket['status']) ?>
            </span>
            
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                <form method="POST" action="?route=delete_ticket" onsubmit="return confirm('Esta acción es irreversible. ¿Deseas eliminar este ticket de forma permanente?');" class="inline">
                    <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                    <button type="submit" class="inline-flex items-center gap-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:text-red-700 px-3 py-1.5 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Eliminar
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Columna Principal (Descripción y Comentarios) -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Descripción de la Incidencia -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    Descripción del Reporte
                </h3>
                <div class="prose prose-sm prose-slate max-w-none bg-slate-50 border border-slate-100 rounded-xl p-5 text-slate-700 whitespace-pre-line leading-relaxed">
                    <?= htmlspecialchars($ticket['description']) ?>
                </div>
            </div>

            <!-- Sección de Comentarios (Bitácora) -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        Bitácora de Soporte
                    </h3>
                    <span class="inline-flex items-center justify-center bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-1 rounded-full">
                        <?= count($comments ?? []) ?>
                    </span>
                </div>

                <div class="space-y-6">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <?php 
                                // Extraer inicial para el avatar
                                $username = htmlspecialchars($comment['username'] ?? 'Soporte');
                                $initial = strtoupper(substr($username, 0, 1));
                            ?>
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-blue-200 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold shadow-sm">
                                        <?= $initial ?>
                                    </div>
                                </div>
                                <div class="flex-grow bg-white border border-slate-100 rounded-2xl rounded-tl-none p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] transition-shadow group-hover:shadow-md">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2 gap-1">
                                        <p class="text-sm font-bold text-slate-800">
                                            <?= $username ?>
                                        </p>
                                        <span class="text-[11px] font-medium text-slate-400 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <?= $formatCaracas($comment['created_at'] ?? null) ?>
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-600 whitespace-pre-line leading-relaxed">
                                        <?= htmlspecialchars($comment['comment'] ?? '') ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            <h3 class="mt-2 text-sm font-semibold text-slate-900">Sin actualizaciones</h3>
                            <p class="mt-1 text-sm text-slate-500">Aún no hay comentarios o resoluciones para este ticket.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Soporte' || $_SESSION['role'] === 'Gerente')): ?>
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <form method="POST" action="?route=add_comment" class="relative">
                            <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                            <label class="sr-only" for="comment">Agregar comentario</label>
                            <textarea id="comment" name="comment" rows="3" class="block w-full resize-none rounded-xl border border-slate-300 bg-white p-4 text-sm text-slate-900 placeholder-slate-400 transition-shadow focus:border-[#010b50] focus:outline-none focus:ring-1 focus:ring-[#010b50]" placeholder="Escribe una actualización para el equipo..." required></textarea>
                            
                            <div class="absolute bottom-3 right-3 flex items-center justify-between">
                                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-[#010b50] px-4 py-2 text-xs font-bold text-white shadow-md transition-all hover:-translate-y-0.5 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:ring-offset-2">
                                    <span>Publicar</span>
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Columna Secundaria (Metadatos del Ticket) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-slate-200/80 shadow-sm p-6 overflow-hidden relative">
                <!-- Adorno visual -->
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-slate-50 rounded-full border border-slate-100 pointer-events-none"></div>
                
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-5 border-b border-slate-100 pb-3 relative z-10">
                    Información Operativa
                </h3>
                
                <dl class="space-y-5 relative z-10">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide flex items-center gap-1.5 mb-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Departamento
                        </dt>
                        <dd class="text-sm font-bold text-slate-800"><?= htmlspecialchars($ticket['department'] ?? 'No especificado') ?></dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide flex items-center gap-1.5 mb-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            Categoría (IA)
                        </dt>
                        <dd>
                            <span class="inline-flex bg-indigo-50 border border-indigo-100 text-indigo-700 py-1 px-2.5 rounded-lg text-xs font-semibold">
                                <?= htmlspecialchars($ticket['category']) ?>
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide flex items-center gap-1.5 mb-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                            Nivel de Prioridad
                        </dt>
                        <dd>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold <?= $priorityClass ?>">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                <?= htmlspecialchars($ticket['priority']) ?>
                            </span>
                        </dd>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide flex items-center gap-1.5 mb-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Reportado por
                        </dt>
                        <dd class="text-sm font-bold text-slate-800">
                            <?= htmlspecialchars($ticket['creator_username'] ?? 'N/D') ?>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wide flex items-center gap-1.5 mb-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                            Fecha de Apertura
                        </dt>
                        <dd class="text-sm font-medium text-slate-600">
                            <?= $formatCaracas($ticket['created_at'] ?? null) ?>
                        </dd>
                    </div>
                </dl>
            </div>
            
            <!-- Tarjeta de ayuda rápida opcional -->
            <div class="bg-gradient-to-br from-[#010b50] to-blue-900 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <h4 class="text-sm font-bold mb-2 relative z-10">¿Dudas con este ticket?</h4>
                <p class="text-xs text-blue-200 mb-4 relative z-10">Revisa el manual operativo o contacta a un supervisor nivel 2.</p>
                <a href="?route=help_docs" class="inline-flex text-xs font-semibold bg-white/20 hover:bg-white/30 transition-colors px-3 py-1.5 rounded-lg relative z-10">
                    Ver manual de escalamiento →
                </a>
            </div>
            
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>