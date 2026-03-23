<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .login-stage {
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 55%, #f8fafc 100%);
    }
    .login-sweep {
        position: absolute;
        top: -11rem;
        right: -18rem;
        width: 66rem;
        height: 66rem;
        border-radius: 9999px;
        background: conic-gradient(from 235deg, rgba(56, 189, 248, 0.35), rgba(79, 70, 229, 0.58), rgba(244, 114, 182, 0.62), rgba(251, 146, 60, 0.58), rgba(56, 189, 248, 0.35));
        filter: blur(2px);
        opacity: 0.95;
        transform: rotate(-14deg);
        animation: sweep-rotate 24s linear infinite;
    }
    .login-wave {
        position: absolute;
        top: 5rem;
        right: 11rem;
        width: 50rem;
        height: 50rem;
        border-radius: 9999px;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.35), rgba(255,255,255,0));
        transform: rotate(-18deg);
    }
    .login-grid {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(to right, rgba(148, 163, 184, 0.14) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(148, 163, 184, 0.14) 1px, transparent 1px);
        background-size: 72px 72px;
        mask-image: radial-gradient(circle at 20% 35%, rgba(0,0,0,0.65), transparent 72%);
    }
    @keyframes sweep-rotate {
        0% { transform: rotate(-14deg) translateX(0); }
        50% { transform: rotate(-9deg) translateX(-2.5rem); }
        100% { transform: rotate(-14deg) translateX(0); }
    }
    @media (max-width: 1024px) {
        .login-sweep { right: -28rem; top: -14rem; width: 58rem; height: 58rem; }
        .login-wave { right: -6rem; width: 44rem; height: 44rem; }
    }
    @media (prefers-reduced-motion: reduce) {
        .login-sweep { animation: none; }
    }
</style>

<div class="login-stage relative w-full min-h-screen overflow-hidden">
    <div class="login-sweep pointer-events-none" aria-hidden="true"></div>
    <div class="login-wave pointer-events-none" aria-hidden="true"></div>
    <div class="login-grid pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto grid min-h-screen w-full max-w-7xl grid-cols-1 gap-10 px-4 pb-12 pt-24 sm:px-6 lg:grid-cols-12 lg:gap-14 lg:px-10 lg:pt-32">
        <section class="lg:col-span-7 lg:pt-14">
            <div class="inline-flex items-center gap-2 rounded-full border border-indigo-200/90 bg-white/70 px-4 py-1.5 text-sm font-semibold text-indigo-700 backdrop-blur">
                <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                Plataforma operativa BDT v1.0.4
            </div>
            <h1 class="mt-6 max-w-3xl text-4xl font-black leading-tight text-slate-900 sm:text-5xl lg:text-6xl">
                Gestión inteligente para <span class="bg-gradient-to-r from-indigo-700 via-sky-600 to-pink-500 bg-clip-text text-transparent">incidencias críticas</span> y continuidad operativa.
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-relaxed text-slate-600">
                Reporta fallas, prioriza tickets y acelera la resolución con un flujo diseñado para equipos de soporte bancario en tiempo real.
            </p>

            <div class="mt-10 grid max-w-xl grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-white/70 bg-white/70 p-4 shadow-sm backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priorización automática</p>
                    <p class="mt-2 text-sm text-slate-700">Clasifica la severidad según impacto y área afectada.</p>
                </div>
                <div class="rounded-2xl border border-white/70 bg-white/70 p-4 shadow-sm backdrop-blur">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Trazabilidad completa</p>
                    <p class="mt-2 text-sm text-slate-700">Sigue cada cambio con historial consolidado y seguro.</p>
                </div>
            </div>
        </section>

        <section class="flex items-center lg:col-span-5 lg:justify-end">
            <div class="w-full max-w-md rounded-3xl border border-white/80 bg-white/88 p-8 shadow-2xl shadow-indigo-900/10 backdrop-blur-xl">
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#010b50] shadow-xl shadow-blue-900/20">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Acceso Seguro</h2>
                    <p class="mt-2 text-sm text-gray-500">Usa tus credenciales corporativas para ingresar.</p>
                </div>

                <?php if(isset($error)): ?>
                    <div class="mt-6 flex items-center rounded-md border-l-4 border-red-500 bg-red-50 p-4 animate-pulse">
                        <svg class="mr-2 h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <p class="text-sm font-medium text-red-700"><?= $error ?></p>
                    </div>
                <?php endif; ?>

                <form class="mt-8 space-y-6" method="POST" action="?route=login">
                    <div class="space-y-5">
                        <div>
                            <label for="username" class="mb-1 block text-sm font-medium text-gray-700">Usuario Corporativo</label>
                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="username" name="username" type="text" required class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-3 pl-10 placeholder-gray-400 transition duration-200 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50] sm:text-sm" placeholder="ej: j.perez" autocapitalize="off" spellcheck="false">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Contraseña</label>
                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" required class="block w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-3 pl-10 pr-10 placeholder-gray-400 transition duration-200 focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50] sm:text-sm" placeholder="••••••••">
                                <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3 text-gray-400 hover:text-[#010b50]">
                                    <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg id="eye-off-icon" class="hidden h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 cursor-pointer rounded border-gray-300 text-[#010b50] focus:ring-[#010b50]">
                            <label for="remember-me" class="ml-2 block cursor-pointer text-sm text-gray-700">Recordar sesión</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-[#010b50] transition hover:text-blue-800">Recuperar clave</a>
                        </div>
                    </div>

                    <button type="submit" class="group relative flex w-full justify-center rounded-xl border border-transparent bg-[#010b50] px-4 py-3.5 text-sm font-bold text-white shadow-lg transition-all hover:-translate-y-0.5 hover:bg-blue-900 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:ring-offset-2">
                        Acceder al Sistema
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 -scale-x-100 text-blue-300 transition-colors group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>

<script>
    const usernameInput = document.getElementById('username');

    usernameInput.addEventListener('input', () => {
        usernameInput.value = usernameInput.value.toLowerCase();
    });

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');
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