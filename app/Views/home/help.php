<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="w-full bg-slate-50">
    <div class="max-w-6xl mx-auto px-6 py-10 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-12 w-12 rounded-2xl bg-[#010b50] text-white flex items-center justify-center shadow-lg shadow-blue-900/20">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.83L3 20l1.29-3.44A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Centro de Ayuda</h1>
                        <p class="text-sm text-slate-500">Cuéntanos tu inconveniente y te contactaremos.</p>
                    </div>
                </div>

                <?php if(isset($error)): ?>
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="?route=help" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1" for="name">Nombre completo *</label>
                            <input id="name" name="name" type="text" required value="<?= htmlspecialchars($form['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30 focus:border-transparent" placeholder="Ej: María Pérez" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1" for="email">Correo *</label>
                            <input id="email" name="email" type="email" required value="<?= htmlspecialchars($form['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30 focus:border-transparent" placeholder="nombre@correo.com" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1" for="phone">Teléfono</label>
                            <input id="phone" name="phone" type="text" value="<?= htmlspecialchars($form['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30 focus:border-transparent" placeholder="0412-1234567" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1" for="subject">Asunto *</label>
                            <input id="subject" name="subject" type="text" required value="<?= htmlspecialchars($form['subject'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30 focus:border-transparent" placeholder="Ej: Problema con acceso" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="message">Descripción *</label>
                        <textarea id="message" name="message" rows="5" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#010b50]/30 focus:border-transparent" placeholder="Describe el detalle de tu solicitud."><?= htmlspecialchars($form['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#010b50] px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-900/20 transition hover:bg-[#0b1f7a] focus:outline-none focus:ring-2 focus:ring-[#010b50]/40">
                        Enviar solicitud
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl bg-gradient-to-br from-[#010b50] via-[#1e3a8a] to-[#312e81] p-8 text-white shadow-xl">
                    <h2 class="text-2xl font-semibold mb-3">Canales de soporte</h2>
                    <p class="text-sm text-blue-100">Nuestro equipo atiende solicitudes en horario laboral. Si es urgente, usa los canales destacados.</p>
                    <div class="mt-6 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l3.6 7.59a1 1 0 00.9.56h7a1 1 0 00.9-.56L21 5H5" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Mesa de ayuda</p>
                                <p class="text-xs text-blue-200">Respuestas en menos de 24h</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Correo interno</p>
                                <p class="text-xs text-blue-200">soporte@bdt.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.68l1.3 3.9a1 1 0 01-.27 1.09l-2.2 2.2a16 16 0 006.16 6.16l2.2-2.2a1 1 0 011.09-.27l3.9 1.3a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.82 21 3 14.18 3 5V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Línea directa</p>
                                <p class="text-xs text-blue-200">(0212) 555-0101</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h3 class="text-lg font-semibold text-slate-900">¿Qué ocurre después?</h3>
                    <ul class="mt-3 space-y-2 text-sm text-slate-600">
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></span>
                            Revisamos tu solicitud y asignamos un especialista.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></span>
                            Te contactamos por correo o teléfono con la solución.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></span>
                            Cerramos el caso cuando confirmes la resolución.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
