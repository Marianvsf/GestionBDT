<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .login-stage {
        position: relative;
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 42%, #f7f8fc 100%);
    }
    .login-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(to right, rgba(148, 163, 184, 0.12) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
        background-size: 64px 64px;
        pointer-events: none;
    }
    .hero-gradient {
        position: absolute;
        top: 2rem;
        right: -12rem;
        width: 52rem;
        height: 52rem;
        border-radius: 9999px;
        background: radial-gradient(circle at 35% 30%, rgba(147, 197, 253, 0.75), rgba(191, 219, 254, 0.42) 35%, rgba(244, 114, 182, 0.45) 58%, rgba(251, 191, 36, 0.4) 74%, rgba(255, 255, 255, 0) 100%);
        filter: blur(3px);
        pointer-events: none;
    }
    .hero-glass {
        border: 1px solid rgba(255, 255, 255, 0.68);
        background: linear-gradient(148deg, rgba(255, 255, 255, 0.84), rgba(255, 255, 255, 0.58));
        backdrop-filter: blur(10px);
    }
    .feature-card {
        border: 1px solid rgba(203, 213, 225, 0.6);
        background: linear-gradient(160deg, rgba(241, 245, 249, 0.92), rgba(248, 250, 252, 0.98));
        box-shadow: 0 20px 45px -30px rgba(30, 41, 59, 0.35);
    }
    .demo-panel {
        border: 1px solid rgba(191, 219, 254, 0.8);
        background: linear-gradient(130deg, rgba(191, 219, 254, 0.66), rgba(196, 181, 253, 0.6), rgba(249, 168, 212, 0.56), rgba(253, 230, 138, 0.52));
        box-shadow: 0 28px 50px -35px rgba(30, 41, 59, 0.5);
    }
    @media (max-width: 1024px) {
        .hero-gradient {
            right: -20rem;
            top: 5rem;
            width: 48rem;
            height: 48rem;
        }
    }
</style>

<div class="login-stage min-h-screen overflow-hidden pb-16">
    <div class="login-grid" aria-hidden="true"></div>
    <div class="hero-gradient" aria-hidden="true"></div>

    <section class="relative z-10 mx-auto w-full max-w-7xl px-4 pt-40 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-white/65 bg-white/55 p-5 shadow-xl shadow-slate-300/40 backdrop-blur-md md:p-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-7 lg:pt-5">
                    <div class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/80 px-3 py-1 text-xs font-semibold text-indigo-700">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                        Plataforma operativa BDT v1.0.4
                    </div>
                    <h1 class="mt-5 max-w-2xl text-4xl font-black leading-tight text-slate-900 sm:text-5xl">
                        Gestion inteligente para <span class="bg-gradient-to-r from-indigo-700 via-blue-600 to-fuchsia-500 bg-clip-text text-transparent">incidencias criticas</span> y continuidad operativa.
                    </h1>
                    <p class="mt-5 max-w-xl text-base leading-relaxed text-slate-700 sm:text-lg">
                        Reporta fallas, prioriza tickets y acelera la resolucion con un flujo disenado para equipos de soporte bancario en tiempo real.
                    </p>
                    <div class="mt-8 grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="hero-glass rounded-2xl p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priorizacion automatica</p>
                            <p class="mt-1 text-sm text-slate-700">Clasifica la severidad segun impacto y area afectada.</p>
                        </div>
                        <div class="hero-glass rounded-2xl p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Trazabilidad completa</p>
                            <p class="mt-1 text-sm text-slate-700">Sigue cada cambio con historial consolidado y seguro.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="hero-glass mx-auto w-full max-w-md rounded-3xl p-6 shadow-2xl shadow-indigo-900/15 sm:p-7">
                        <div class="text-center">
                            <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#010b50] shadow-lg shadow-blue-900/20">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-extrabold text-gray-900">Acceso Seguro</h2>
                            <p class="mt-2 text-sm text-gray-500">Usa tus credenciales corporativas para ingresar.</p>
                        </div>

                        <?php if(isset($error)): ?>
                            <div class="mt-5 flex items-center rounded-lg border border-red-200 bg-red-50 p-3">
                                <svg class="mr-2 h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <p class="text-sm font-medium text-red-700\"><?= $error ?></p>
                            </div>
                        <?php endif; ?>

                        <form class="mt-6 space-y-5" method="POST" action="?route=login">
                            <div>
                                <label for="username" class="mb-1.5 block text-sm font-medium text-gray-700">Usuario Corporativo</label>
                                <div class="group relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input id="username" name="username" type="text" required class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 pl-10 text-sm placeholder-slate-400 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="ej: j.perez" autocapitalize="off" spellcheck="false">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Contrasena</label>
                                <div class="group relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" required class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 pl-10 pr-10 text-sm placeholder-slate-400 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="********">
                                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-400 hover:text-[#010b50]" aria-label="Mostrar u ocultar contrasena">
                                        <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg id="eye-off-icon" class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <label for="remember-me" class="inline-flex cursor-pointer items-center gap-2 text-slate-700">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-[#010b50] focus:ring-[#010b50]">
                                    Recordar sesion
                                </label>
                                <a href="#" class="font-semibold text-[#010b50] hover:text-blue-800">Recuperar clave</a>
                            </div>

                            <button type="submit" class="group relative flex w-full justify-center rounded-xl border border-transparent bg-[#010b50] px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:-translate-y-0.5 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:ring-offset-2">
                                Acceder al Sistema
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-blue-300 transition-colors group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-16 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <h3 class="text-center text-4xl font-black text-slate-900">Como funciona</h3>
        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-fuchsia-100 text-indigo-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">1. Reporta</h4>
                <p class="mt-2 text-sm text-slate-600">Registra incidencias y alertas en segundos para activar el flujo de soporte.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="6" rx="1"/><rect x="3" y="14" width="6" height="6" rx="1"/><rect x="11" y="14" width="10" height="6" rx="1"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">2. Prioriza</h4>
                <p class="mt-2 text-sm text-slate-600">Organiza casos por impacto, area y urgencia con trazabilidad de cambios.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-100 to-fuchsia-100 text-cyan-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 7h7l-5.5 4.2L18 21l-6-4-6 4 1.5-7.8L2 9h7z"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">3. Resuelve</h4>
                <p class="mt-2 text-sm text-slate-600">Monitorea el progreso de principio a fin y reduce tiempos de resolucion.</p>
            </article>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <h3 class="text-center text-4xl font-black text-slate-900">Caracteristicas Clave</h3>
        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Monitoreo en Tiempo Real</h4>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Supervisa incidencias, reasignaciones y avances operativos con paneles dinamicos.</p>
            </article>
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Alertas Automatizadas</h4>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Recibe notificaciones por umbrales de riesgo, SLA comprometido y escalamiento.</p>
            </article>
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-slate-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Reportes Detallados</h4>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Genera vistas gerenciales para seguimiento de productividad y calidad de atencion.</p>
            </article>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white/85 px-6 py-10 text-center shadow-sm">
            <h3 class="text-4xl font-black text-slate-900">Empresas que confian en nosotros</h3>
            <div class="mt-8 grid grid-cols-2 gap-6 text-center text-3xl font-bold text-slate-500 sm:grid-cols-4">
                <span>Santander</span>
                <span>BBVA</span>
                <span>Scotiabank</span>
                <span>BancoEstado</span>
            </div>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 w-full max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <h3 class="text-center text-4xl font-black text-slate-900">Solicita una Demo</h3>
        <div class="mx-auto mt-8 w-full max-w-xl rounded-3xl p-6 demo-panel">
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <input type="text" class="rounded-xl border border-white/70 bg-white/90 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="Nombre" aria-label="Nombre">
                <input type="email" class="rounded-xl border border-white/70 bg-white/90 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="Correo corporativo" aria-label="Correo corporativo">
                <input type="text" class="sm:col-span-2 rounded-xl border border-white/70 bg-white/90 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="Empresa" aria-label="Empresa">
                <button type="button" class="sm:col-span-2 rounded-xl bg-[#010b50] px-4 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-[#0b1f7a]">Enviar Solicitud</button>
            </form>
        </div>
    </section>
</div>

<script>
    const usernameInput = document.getElementById('username');

    if (usernameInput) {
        usernameInput.addEventListener('input', () => {
            usernameInput.value = usernameInput.value.toLowerCase();
        });
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');
        if (!passwordInput || !eyeIcon || !eyeOffIcon) {
            return;
        }
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }
    }
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>