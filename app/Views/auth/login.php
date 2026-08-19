<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .login-stage {
        position: relative;
        background: transparent;
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
    <div class="hero-gradient" aria-hidden="true"></div>

    <section class="relative z-10 mx-auto w-full max-w-7xl px-4 pt-20 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-white/65 bg-white/25 p-5 shadow-xl shadow-slate-300/40 backdrop-blur-md md:p-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-7" >
                    <div class="inline-flex items-center gap-2 rounded-full border border-indigo-200 bg-white/80 px-3 py-1 text-xs font-semibold text-indigo-700">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                        Plataforma operativa BDT v1.0.4
                    </div>
                    <h1 class="mt-5 max-w-2xl text-4xl font-black leading-tight text-slate-900 sm:text-5xl">
                        Gestión inteligente para <span class="bg-gradient-to-r from-indigo-700 via-blue-600 to-fuchsia-500 bg-clip-text text-transparent">incidencias críticas</span> y continuidad operativa.
                    </h1>
                    <p class="mt-5 max-w-xl text-base leading-relaxed text-slate-700 sm:text-lg">
                        Reporta fallas, prioriza tickets y acelera la resolución con un flujo diseñado para equipos de soporte bancario en tiempo real.
                    </p>
                    <div class="mt-8 grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="hero-glass rounded-2xl p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priorización automática</p>
                            <p class="mt-1 text-base text-slate-700">Clasifica la severidad según impacto y área afectada.</p>
                        </div>
                        <div class="hero-glass rounded-2xl p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Trazabilidad completa</p>
                            <p class="mt-1 text-base text-slate-700">Sigue cada cambio con historial consolidado y seguro.</p>
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
                            <p class="mt-2 text-base text-gray-500">Usa tus credenciales corporativas para ingresar.</p>
                        </div>

                        <?php if(isset($error)): ?>
                            <div class="mt-5 flex items-center rounded-lg border border-red-200 bg-red-50 p-3" role="alert">
                                <svg class="mr-2 h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <p class="text-base font-medium text-red-700"><?= htmlspecialchars($error) ?></p>
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
                                    <input id="username" name="username" type="text" required autocomplete="username" class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 pl-10 text-sm placeholder-slate-400 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="ej: j.perez" autocapitalize="off" spellcheck="false">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Contraseña</label>
                                <div class="group relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" required autocomplete="current-password" class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 pl-10 pr-10 text-sm placeholder-slate-400 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" placeholder="********">
                                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-400 hover:text-[#010b50]" aria-label="Mostrar u ocultar contraseña">
                                        <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg id="eye-off-icon" class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>
                            <div id="caps-lock-warning" class="hidden mt-2 flex items-center text-xs text-amber-600 font-medium">
                                <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Bloq Mayús está activado
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <label for="remember-me" class="inline-flex cursor-pointer items-center gap-2 text-slate-700">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-[#010b50] focus:ring-[#010b50]">
                                    Recordar sesión
                                </label>
                                <a href="?route=forgot_password" class="font-semibold text-[#010b50] hover:text-blue-800">Recuperar clave</a>
                            </div>
                            <button type="submit" id="login-btn" class="group relative flex w-full justify-center rounded-xl border border-transparent bg-[#010b50] px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:-translate-y-0.5 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:ring-offset-2 disabled:opacity-70 disabled:cursor-not-allowed">
                                <span id="btn-text">Acceder al Sistema</span>
                                <svg id="btn-spinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-16 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <h3 class="text-center text-4xl font-black text-slate-900">Cómo funciona</h3>
        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-fuchsia-100 text-indigo-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">1. Reporta</h4>
                <p class="mt-2 text-base text-slate-600">Registra incidencias y alertas en segundos para activar el flujo de soporte.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="6" rx="1"/><rect x="3" y="14" width="6" height="6" rx="1"/><rect x="11" y="14" width="10" height="6" rx="1"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">2. Prioriza</h4>
                <p class="mt-2 text-base text-slate-600">Organiza casos por impacto, área y urgencia con trazabilidad de cambios.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white/80 p-6 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-100 to-fuchsia-100 text-cyan-700">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 7h7l-5.5 4.2L18 21l-6-4-6 4 1.5-7.8L2 9h7z"/></svg>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">3. Resuelve</h4>
                <p class="mt-2 text-base text-slate-600">Monitorea el progreso de principio a fin y reduce tiempos de resolución.</p>
            </article>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 w-full max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <h3 class="text-center text-4xl font-black text-slate-900">Características Clave</h3>
        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Monitoreo en Tiempo Real</h4>
                <p class="mt-3 text-base leading-relaxed text-slate-600">Supervisa incidencias, reasignaciones y avances operativos con paneles dinámicos.</p>
            </article>
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-fuchsia-500 to-indigo-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Alertas Automatizadas</h4>
                <p class="mt-3 text-base leading-relaxed text-slate-600">Recibe notificaciones por umbrales de riesgo, SLA comprometido y escalamiento.</p>
            </article>
            <article class="feature-card rounded-3xl p-6">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-slate-700 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-900">Reportes Detallados</h4>
                <p class="mt-3 text-base leading-relaxed text-slate-600">Genera vistas gerenciales para seguimiento de productividad y calidad de atención.</p>
            </article>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h3 class="text-2xl font-black text-slate-900">Estado de Servicios BDT</h3>
                <p class="text-base text-slate-500 mt-1">Actualizado en tiempo real por el Centro de Operaciones</p>
            </div>
            <a href="?route=status" class="mt-4 sm:mt-0 inline-flex items-center text-sm font-semibold text-[#010b50] hover:text-blue-700">
                Ver historial de eventos
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white/80 p-5 shadow-sm flex items-center justify-between transition-transform hover:-translate-y-1">
                <div>
                    <p class="text-base font-bold text-slate-800">Core Bancario</p>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Operativo</p>
                </div>
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white/80 p-5 shadow-sm flex items-center justify-between transition-transform hover:-translate-y-1">
                <div>
                    <p class="text-base font-bold text-slate-800">Banca Digital</p>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Operativo</p>
                </div>
                <span class="flex h-3 w-3 relative">
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
            </div>

            <div class="rounded-2xl border border-amber-200 bg-amber-50/80 p-5 shadow-sm flex items-center justify-between transition-transform hover:-translate-y-1">
                <div>
                    <p class="text-base font-bold text-amber-900">VPN Corporativa</p>
                    <p class="text-xs text-amber-700 font-semibold mt-1">Intermitencia</p>
                </div>
                <span class="flex h-3 w-3 relative">
                    <span class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                </span>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white/80 p-5 shadow-sm flex items-center justify-between transition-transform hover:-translate-y-1">
                <div>
                    <p class="text-base font-bold text-slate-800">Correo Institucional</p>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Operativo</p>
                </div>
                <span class="flex h-3 w-3 relative">
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
            </div>
        </div>
    </section>

    <section class="relative z-10 mx-auto mt-20 mb-8 w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-indigo-100 bg-gradient-to-b from-indigo-50/80 to-white p-8 sm:p-10 shadow-sm relative">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-blue-200/40 blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <div class="max-w-xl">
                    <h3 class="text-2xl font-bold text-[#010b50]">¿Problemas para ingresar al sistema?</h3>
                    <p class="mt-2 text-base text-slate-600">Si tu cuenta está bloqueada o presentas fallas de autenticación con el Active Directory, contacta a la Mesa de Ayuda IT de inmediato.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 shrink-0">
                    <a href="?route=help_docs" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-colors hover:bg-slate-50 hover:text-[#010b50]">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Manual de Usuario
                    </a>
                    <a href="tel:4040" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#010b50] px-5 py-3 text-sm font-bold text-white shadow-lg transition-transform hover:-translate-y-0.5 hover:bg-blue-900">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Extensión 4040
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="relative z-10 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col gap-12 pb-24">

        <section aria-labelledby="service-health-title">
            <div class="rounded-3xl border border-slate-200/80 bg-white/60 backdrop-blur-xl p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all hover:bg-white/80">
                <h3 id="service-health-title" class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    Estado de los Sistemas BDT
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="flex items-center justify-between p-4 bg-white/80 rounded-2xl border border-slate-100 shadow-sm">
                        <span class="text-sm font-semibold text-slate-600">Core Bancario</span>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full tracking-wide">OPERATIVO</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-white/80 rounded-2xl border border-slate-100 shadow-sm">
                        <span class="text-sm font-semibold text-slate-600">Banca Digital</span>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full tracking-wide">OPERATIVO</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-white/80 rounded-2xl border border-slate-100 shadow-sm">
                        <span class="text-sm font-semibold text-slate-600">Conexión VPN</span>
                        <span class="text-[10px] font-bold text-amber-700 bg-amber-100 px-2.5 py-1 rounded-full tracking-wide">INTERMITENTE</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-white/80 rounded-2xl border border-slate-100 shadow-sm">
                        <span class="text-sm font-semibold text-slate-600">Módulo Nómina</span>
                        <span class="text-[10px] font-bold text-blue-700 bg-blue-100 px-2.5 py-1 rounded-full tracking-wide">MANTENIMIENTO</span>
                    </div>
                </div>
            </div>
        </section>

        <section aria-labelledby="stats-title">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col p-6 rounded-3xl border border-slate-200/80 bg-white/60 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <span class="text-sm font-medium text-slate-500 mb-1">Usuarios Activos (VPN)</span>
                    <span class="text-4xl font-bold text-[#1e3a8a] tracking-tight">1,248</span>
                    <span class="text-xs text-emerald-600 font-medium mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +12% vs ayer
                    </span>
                </div>
                <div class="flex flex-col p-6 rounded-3xl border border-slate-200/80 bg-white/60 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <span class="text-sm font-medium text-slate-500 mb-1">Tickets Resueltos Hoy</span>
                    <span class="text-4xl font-bold text-[#1e3a8a] tracking-tight">84</span>
                    <span class="text-xs text-emerald-600 font-medium mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Eficiencia óptima
                    </span>
                </div>
                <div class="flex flex-col p-6 rounded-3xl border border-slate-200/80 bg-white/60 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <span class="text-sm font-medium text-slate-500 mb-1">Tiempo de Respuesta</span>
                    <span class="text-4xl font-bold text-[#1e3a8a] tracking-tight">12<span class="text-2xl text-slate-400 font-medium tracking-normal">min</span></span>
                    <span class="text-xs text-amber-600 font-medium mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Promedio general
                    </span>
                </div>
            </div>
        </section>

        <section aria-labelledby="quick-links-title">
            <h3 id="quick-links-title" class="text-center text-4xl font-black text-slate-900 mb-8">Accesos Frecuentes</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <a href="?route=manuals" class="group flex flex-col p-6 rounded-3xl bg-white border border-slate-200 shadow-sm transition-all hover:shadow-md hover:border-[#1e3a8a]/30 hover:-translate-y-1">
                    <div class="h-10 w-10 rounded-full bg-blue-50 text-[#1e3a8a] flex items-center justify-center mb-4 group-hover:bg-[#1e3a8a] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Manuales de Usuario</h4>
                    <p class="text-xs text-slate-500">Guías operativas y normativas vigentes.</p>
                </a>

                <a href="?route=password_reset" class="group flex flex-col p-6 rounded-3xl bg-white border border-slate-200 shadow-sm transition-all hover:shadow-md hover:border-[#1e3a8a]/30 hover:-translate-y-1">
                    <div class="h-10 w-10 rounded-full bg-blue-50 text-[#1e3a8a] flex items-center justify-center mb-4 group-hover:bg-[#1e3a8a] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Gestión de Claves</h4>
                    <p class="text-xs text-slate-500">Desbloqueo y cambio de contraseña.</p>
                </a>

                <a href="?route=directory" class="group flex flex-col p-6 rounded-3xl bg-white border border-slate-200 shadow-sm transition-all hover:shadow-md hover:border-[#1e3a8a]/30 hover:-translate-y-1">
                    <div class="h-10 w-10 rounded-full bg-blue-50 text-[#1e3a8a] flex items-center justify-center mb-4 group-hover:bg-[#1e3a8a] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Directorio Corporativo</h4>
                    <p class="text-xs text-slate-500">Contactos de agencias y áreas centrales.</p>
                </a>

                <a href="?route=create_ticket" class="group flex flex-col p-6 rounded-3xl bg-white border border-slate-200 shadow-sm transition-all hover:shadow-md hover:border-[#1e3a8a]/30 hover:-translate-y-1">
                    <div class="h-10 w-10 rounded-full bg-blue-50 text-[#1e3a8a] flex items-center justify-center mb-4 group-hover:bg-[#1e3a8a] group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-slate-800 mb-1">Soporte Técnico</h4>
                    <p class="text-xs text-slate-500">Reporte de fallas en equipos o sistemas.</p>
                </a>
            </div>
        </section>

        <section aria-labelledby="faq-title" class="mx-auto w-full max-w-3xl">
            <h3 id="faq-title" class="text-center text-4xl font-black text-slate-900 mb-8">Preguntas Frecuentes</h3>
            <div class="space-y-4">
                
                <details class="group rounded-2xl border border-slate-200 bg-white/80 backdrop-blur-md p-6 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 text-slate-800 font-semibold focus:outline-none">
                        <h2 class="text-sm md:text-base">¿Cómo solicito acceso a un nuevo módulo del sistema?</h2>
                        <span class="relative h-5 w-5 shrink-0">
                            <svg class="absolute inset-0 h-5 w-5 opacity-100 group-open:opacity-0 transition-opacity" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg class="absolute inset-0 h-5 w-5 opacity-0 group-open:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-slate-600 text-base">
                        Debes generar un ticket en la opción "Soporte Técnico" seleccionando la categoría "Accesos y Permisología". Asegúrate de adjuntar la autorización formal de tu Gerente de Área en formato PDF.
                    </p>
                </details>

                <details class="group rounded-2xl border border-slate-200 bg-white/80 backdrop-blur-md p-6 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between gap-1.5 text-slate-800 font-semibold focus:outline-none">
                        <h2 class="text-sm md:text-base">¿Qué hago si mi usuario ha sido bloqueado por intentos fallidos?</h2>
                        <span class="relative h-5 w-5 shrink-0">
                            <svg class="absolute inset-0 h-5 w-5 opacity-100 group-open:opacity-0 transition-opacity" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg class="absolute inset-0 h-5 w-5 opacity-0 group-open:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-slate-600 text-base">
                        El sistema desbloquea automáticamente los usuarios tras 15 minutos de espera. Si necesitas acceso inmediato, puedes utilizar la herramienta de "Gestión de Claves" o contactar directamente a la mesa de ayuda a la extensión 1000.
                    </p>
                </details>

            </div>
        </section>

    </div>
    </div>

<script>
    // Lógica para Bloq Mayús
    const passwordField = document.getElementById('password');
    const capsWarning = document.getElementById('caps-lock-warning');

    passwordField.addEventListener('keyup', function(e) {
        if (e.getModifierState('CapsLock')) {
            capsWarning.classList.remove('hidden');
        } else {
            capsWarning.classList.add('hidden');
        }
    });
    // Lógica para el botón de carga
    const loginForm = document.querySelector('form[action="?route=login"]');
    if(loginForm) {
        loginForm.addEventListener('submit', function() {
            const btn = document.getElementById('login-btn');
            document.getElementById('btn-text').textContent = 'Verificando...';
            document.getElementById('btn-spinner').classList.remove('hidden');
            btn.disabled = true;
        });
    }
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