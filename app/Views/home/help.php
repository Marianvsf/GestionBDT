<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .help-stage {
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 55%, #f8fafc 100%);
    }
    .help-sweep {
        position: absolute;
        top: -10rem;
        right: -16rem;
        width: 58rem;
        height: 58rem;
        border-radius: 9999px;
        background: conic-gradient(from 235deg, rgba(56, 189, 248, 0.32), rgba(79, 70, 229, 0.54), rgba(244, 114, 182, 0.54), rgba(251, 146, 60, 0.48), rgba(56, 189, 248, 0.32));
        filter: blur(2px);
        opacity: 0.9;
        transform: rotate(-14deg);
        animation: help-sweep-rotate 24s linear infinite;
    }
    .help-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(to right, rgba(148, 163, 184, 0.14) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(148, 163, 184, 0.14) 1px, transparent 1px);
        background-size: 72px 72px;
        mask-image: radial-gradient(circle at 20% 35%, rgba(0, 0, 0, 0.65), transparent 72%);
    }
    @keyframes help-sweep-rotate {
        0% { transform: rotate(-14deg) translateX(0); }
        50% { transform: rotate(-9deg) translateX(-2.5rem); }
        100% { transform: rotate(-14deg) translateX(0); }
    }
    @media (prefers-reduced-motion: reduce) {
        .help-sweep { animation: none; }
    }
</style>

<div class="help-stage relative w-full overflow-hidden">
    <div class="help-sweep pointer-events-none" aria-hidden="true"></div>
    <div class="help-grid pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10">
    <div class="max-w-6xl mx-auto px-6 py-10 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div class="rounded-3xl border border-white/80 bg-white/88 p-8 shadow-xl shadow-indigo-900/10 backdrop-blur lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-12 w-12 rounded-2xl bg-[#010b50] text-white flex items-center justify-center shadow-lg shadow-blue-900/20">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.83L3 20l1.29-3.44A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Centro de Ayuda</h1>
                        <p class="text-sm text-slate-600">Cuéntanos tu inconveniente y te contactaremos.</p>
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
                            <label class="mb-1 block text-sm font-medium text-gray-700" for="name">Nombre completo *</label>
                            <input id="name" name="name" type="text" required value="<?= htmlspecialchars($form['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="Ej: María Pérez" />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700" for="email">Correo *</label>
                            <input id="email" name="email" type="email" required value="<?= htmlspecialchars($form['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="nombre@correo.com" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700" for="phone">Teléfono</label>
                            <input id="phone" name="phone" type="number" inputmode="numeric" pattern="[0-9]*" title="Solo se permiten números" value="<?= htmlspecialchars($form['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="0412-1234567" />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700" for="subject">Asunto *</label>
                            <input id="subject" name="subject" type="text" required value="<?= htmlspecialchars($form['subject'] ?? '', ENT_QUOTES, 'UTF-8') ?>" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="Ej: Problema con acceso" />
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700" for="message">Descripción *</label>
                        <textarea id="message" name="message" rows="5" required class="w-full rounded-2xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30" placeholder="Describe el detalle de tu solicitud."><?= htmlspecialchars($form['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
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
                <div class="rounded-3xl bg-gradient-to-br from-indigo-700 via-sky-600 to-pink-500 p-8 text-white shadow-xl shadow-indigo-900/20">
                    <h2 class="text-2xl font-semibold mb-3">Canales de soporte</h2>
                    <p class="text-sm text-indigo-50/90">Nuestro equipo atiende solicitudes en horario laboral. Si es urgente, usa los canales destacados.</p>
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
                                <p class="text-xs text-indigo-100/90">Respuestas en menos de 24h</p>
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
                                <p class="text-xs text-indigo-100/90">soporte@bdt.com</p>
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
                                <p class="text-xs text-indigo-100/90">(0212) 555-0101</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-white/80 bg-white/88 p-6 shadow-lg shadow-indigo-900/5 backdrop-blur">
                    <h3 class="text-lg font-semibold text-slate-900">¿Qué ocurre después?</h3>
                    <ul class="mt-3 space-y-2 text-sm text-slate-700">
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
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
