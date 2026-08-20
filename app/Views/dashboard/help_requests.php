<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.05);
    }
    
    .glass-row {
        transition: background-color 0.2s ease;
    }
    .glass-row:hover {
        background-color: rgba(248, 250, 252, 0.8);
    }
    
    /* Scrollbar sutil para mensajes largos en escritorio */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(241, 245, 249, 0.5);
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(203, 213, 225, 0.8);
        border-radius: 4px;
    }
</style>

<?php
    $formatCaracas = function ($value) {
        if (empty($value)) { return 'N/D'; }
        try {
            $dt = new DateTime($value);
            $dt->setTimezone(new DateTimeZone('America/Caracas'));
            // Formato más legible y moderno
            return $dt->format('d M, Y - h:i A');
        } catch (Exception $e) {
            return htmlspecialchars($value);
        }
    };
?>

<div class="container mx-auto px-4 lg:px-8 py-8 w-full max-w-7xl relative overflow-hidden min-h-[calc(100vh-100px)]">

    <?php if (empty($requests)): ?>
        <div class="mt-20 mx-auto max-w-2xl text-center">
            <div class="glass-panel p-10 sm:p-16 rounded-[2rem] flex flex-col items-center gap-6 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
                
                <div class="h-20 w-20 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-inner border border-indigo-100 relative z-10">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold text-slate-800 tracking-tight mb-3">Bandeja Vacía</h3>
                    <p class="text-slate-500 max-w-md mx-auto text-lg leading-relaxed">
                        Aún no hay peticiones o mensajes del centro de ayuda. Todo está al día.
                    </p>
                </div>
                <a href="?route=dashboard" class="relative z-10 mt-2 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-slate-900/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver al tablero
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 mt-4 md:mt-0">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm border border-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <div>
                    <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Solicitudes de Ayuda</h2>
                    <p class="text-base text-slate-500 mt-1">Revisa los mensajes y requerimientos enviados por los usuarios.</p>
                </div>
            </div>
            <a href="?route=dashboard" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al tablero
            </a>
        </div>

        <div class="md:hidden space-y-4">
            <?php foreach ($requests as $request): ?>
                <article class="glass-panel rounded-2xl p-5">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <span class="inline-block px-2.5 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-indigo-100 mb-2">
                                ID: #<?= str_pad($request['id'], 4, '0', STR_PAD_LEFT) ?>
                            </span>
                            <h3 class="font-bold text-slate-900 leading-tight">
                                <?= htmlspecialchars($request['subject'] ?? 'Sin Asunto') ?>
                            </h3>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium whitespace-nowrap ml-2 text-right">
                            <?= $formatCaracas($request['created_at'] ?? null) ?>
                        </span>
                    </div>

                    <div class="bg-slate-50/80 rounded-xl p-3 border border-slate-100 mb-4 space-y-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="text-xs font-semibold text-slate-700"><?= htmlspecialchars($request['name'] ?? 'N/D') ?></span>
                            <?php if(!empty($request['username'])): ?>
                                <span class="text-[10px] bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded ml-auto">@<?= htmlspecialchars($request['username']) ?></span>
                            <?php else: ?>
                                <span class="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded ml-auto">Público</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:<?= htmlspecialchars($request['email'] ?? '') ?>" class="text-xs text-blue-600 truncate"><?= htmlspecialchars($request['email'] ?? 'N/D') ?></a>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <a href="tel:<?= htmlspecialchars($request['phone'] ?? '') ?>" class="text-xs text-blue-600"><?= htmlspecialchars($request['phone'] ?? 'N/D') ?></a>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 block">Mensaje</span>
                        <p class="text-base text-slate-700 leading-relaxed bg-white p-3 rounded-xl border border-slate-100">
                            <?= nl2br(htmlspecialchars($request['message'] ?? '')) ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="hidden md:block glass-panel rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/80 border-b border-slate-200/80">
                        <tr>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider w-24">Ticket ID</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Remitente</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider">Asunto</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider max-w-xs">Mensaje</th>
                            <th class="py-4 px-5 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Recibido</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100/80 bg-white/40">
                        <?php foreach ($requests as $request): ?>
                            <tr class="glass-row group">
                                <td class="py-4 px-5 align-top">
                                    <span class="font-mono font-semibold text-slate-700">#<?= str_pad($request['id'], 4, '0', STR_PAD_LEFT) ?></span>
                                </td>

                                <td class="py-4 px-5 align-top">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-slate-800"><?= htmlspecialchars($request['name'] ?? 'N/D') ?></span>
                                            <?php if(!empty($request['username'])): ?>
                                                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded border border-slate-200 uppercase tracking-wider">@<?= htmlspecialchars($request['username']) ?></span>
                                            <?php else: ?>
                                                <span class="text-[10px] font-bold bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded border border-emerald-100 uppercase tracking-wider">Público</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex items-center gap-3 text-xs text-slate-500">
                                            <a href="mailto:<?= htmlspecialchars($request['email'] ?? '') ?>" class="hover:text-blue-600 transition-colors flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <?= htmlspecialchars($request['email'] ?? 'N/D') ?>
                                            </a>
                                            <a href="tel:<?= htmlspecialchars($request['phone'] ?? '') ?>" class="hover:text-blue-600 transition-colors flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                <?= htmlspecialchars($request['phone'] ?? 'N/D') ?>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-5 align-top">
                                    <span class="font-semibold text-slate-800 whitespace-normal line-clamp-2 max-w-[200px]">
                                        <?= htmlspecialchars($request['subject'] ?? 'N/D') ?>
                                    </span>
                                </td>

                                <td class="py-4 px-5 align-top max-w-xs">
                                    <div class="text-sm text-slate-600 bg-white/60 p-2.5 rounded-lg border border-slate-100 whitespace-normal max-h-24 overflow-y-auto custom-scrollbar shadow-inner">
                                        <?= nl2br(htmlspecialchars($request['message'] ?? '')) ?>
                                    </div>
                                </td>

                                <td class="py-4 px-5 align-top text-right">
                                    <span class="text-[13px] text-slate-500 font-medium">
                                        <?= $formatCaracas($request['created_at'] ?? null) ?>
                                    </span>
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