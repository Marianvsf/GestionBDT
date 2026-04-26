<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Corporativo - BDT</title>
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .app-stage {
            position: fixed;
            inset: 0;
            z-index: -2;
            overflow: hidden;
            isolation: isolate;
        }
        /* Fondos base mucho más limpios y blancos/grises */
        .app-stage--colorful {
            background:
                radial-gradient(1200px circle at 8% 12%, rgba(241, 245, 249, 0.8), transparent 60%),
                linear-gradient(140deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
            background-size: 100% 100%;
        }
        .app-stage--soft {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }
        
        /* Neblina difuminada al extremo (blur 80px) y opacidad mínima (0.15) */
        .app-stage::before,
        .app-stage::after {
            content: "";
            position: absolute;
            inset: -18%;
            pointer-events: none;
            opacity: 0.15;
            filter: blur(80px);
            will-change: transform;
        }
        
        .app-stage::before {
            background:
                radial-gradient(44% 48% at 20% 24%, rgba(37, 99, 235, 0.15), transparent 72%),
                radial-gradient(40% 44% at 72% 18%, rgba(14, 165, 233, 0.1), transparent 74%);
            animation: app-blob-drift 30s ease-in-out infinite;
        }
        
        .app-stage::after {
            background:
                radial-gradient(48% 52% at 74% 68%, rgba(30, 64, 175, 0.12), transparent 72%),
                radial-gradient(36% 42% at 24% 80%, rgba(2, 132, 199, 0.1), transparent 74%);
            animation: app-blob-drift 35s ease-in-out infinite reverse;
        }
        
        /* Cuadrícula corporativa casi invisible */
        .app-grid {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
            background-size: 64px 64px;
            animation: app-grid-drift 40s linear infinite;
            pointer-events: none;
        }
        
        .app-grid::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(100, 116, 139, 0.3) 1px, transparent 1.5px);
            background-size: 110px 110px;
            opacity: 0.1;
            pointer-events: none;
        }
        
        /* Navbar Dynamics */
        #main-nav { 
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); 
            left: 50%; 
            transform: translateX(-50%); 
        }
        
        .nav-top { 
            width: 100%; 
            top: 0; 
            background-color: rgba(255, 255, 255, 0.95); 
            border-bottom: 1px solid rgba(226, 232, 240, 0.8); 
            padding: 0.75rem 0; 
            backdrop-filter: blur(8px);
        }
        
        .nav-scrolled { 
            width: 92%; 
            max-width: 1280px; 
            top: 1.25rem; 
            border-radius: 20px; 
            background-color: rgba(255, 255, 255, 0.75); 
            backdrop-filter: blur(16px) saturate(180%); 
            box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(0,0,0,0.02); 
            padding: 0.5rem 0; 
            border: 1px solid rgba(255, 255, 255, 0.4); 
        }
        
        .login-nav.nav-top { background-color: transparent; border-bottom: none; }
        .login-nav.nav-scrolled { background-color: rgba(255, 255, 255, 0.85); border: 1px solid rgba(255, 255, 255, 0.6); }
        
        .with-ticker.nav-top { top: 2.5rem; }
        .with-ticker.nav-scrolled { top: 3.5rem; }
        
        /* Ticker Animations */
        @keyframes company-ticker-loop {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .company-ticker-track {
            display: flex;
            width: max-content;
            animation: company-ticker-loop 35s linear infinite;
        }
        .company-ticker-track:hover { animation-play-state: paused; }
        
        /* Background Animations */
        @media (prefers-reduced-motion: reduce) {
            .company-ticker-track, .app-stage--colorful, .app-stage--soft, .app-stage::before, .app-stage::after, .app-grid, .app-grid::after {
                animation: none;
            }
        }
        
        @keyframes app-blob-drift {
            0% { transform: translate3d(-1%, 0, 0) scale(1); }
            50% { transform: translate3d(1%, -1%, 0) scale(1.02); }
            100% { transform: translate3d(-1%, 0, 0) scale(1); }
        }
        @keyframes app-grid-drift {
            from { background-position: 0 0, 0 0; }
            to { background-position: 64px 0, 0 64px; }
        }
    </style>
</head>
<body class="relative text-slate-800 antialiased font-sans flex flex-col min-h-screen overflow-x-hidden selection:bg-indigo-100 selection:text-indigo-900">

    <?php $currentRoute = $_GET['route'] ?? 'home'; ?>
    <?php $isLoginRoute = ($currentRoute === 'login'); ?>
    <?php $showCompanyTicker = ($currentRoute === 'login' || $currentRoute === 'home'); ?>
    <?php $showColorfulBackground = ($currentRoute === 'login' || $currentRoute === 'home'); ?>

    <div class="app-stage <?= $showColorfulBackground ? 'app-stage--colorful' : 'app-stage--soft' ?>" aria-hidden="true"></div>
    <div class="app-grid" aria-hidden="true"></div>

    <?php if($showCompanyTicker): ?>
        <section id="company-ticker" class="fixed top-0 left-0 right-0 z-[60] bg-slate-900 text-slate-300 transition-transform duration-300 shadow-md" aria-label="Avisos de la empresa">
            <div class="company-ticker-track py-1.5">
                <div class="flex items-center shrink-0">
                    <span class="px-5 text-[13px] font-bold text-white uppercase tracking-wider bg-indigo-600 ml-2 rounded-md py-0.5">Avisos</span>
                    <span class="px-5 text-sm">Mantenimiento preventivo de la VPN: viernes 22:00 a 23:30.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm">Mesa de ayuda prioriza incidencias de banca digital en cierre de mes.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm">Actualiza tu clave corporativa antes del 30 de marzo.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm text-indigo-300 font-medium hover:text-indigo-200 cursor-pointer transition-colors">Nueva guía rápida de reportes disponible →</span>
                    <span class="text-slate-600 ml-4">|</span>
                </div>
                <div class="flex items-center shrink-0" aria-hidden="true">
                    <span class="px-5 text-[13px] font-bold text-white uppercase tracking-wider bg-indigo-600 ml-2 rounded-md py-0.5">Avisos</span>
                    <span class="px-5 text-sm">Mantenimiento preventivo de la VPN: viernes 22:00 a 23:30.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm">Mesa de ayuda prioriza incidencias de banca digital en cierre de mes.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm">Actualiza tu clave corporativa antes del 30 de marzo.</span>
                    <span class="text-slate-600">|</span>
                    <span class="px-5 text-sm text-indigo-300 font-medium hover:text-indigo-200 cursor-pointer transition-colors">Nueva guía rápida de reportes disponible →</span>
                    <span class="text-slate-600 ml-4">|</span>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <nav id="main-nav" class="fixed z-50 nav-top <?= $showCompanyTicker ? 'with-ticker' : '' ?> <?= $isLoginRoute ? 'login-nav' : '' ?>">
        <div class="container mx-auto px-4 lg:px-8 flex flex-col">
            <div class="flex items-center justify-between h-full">
                
                <div class="flex items-center gap-4">
                    <?php if(isset($_SESSION['user_id']) && $currentRoute !== 'home' && $currentRoute !== 'login' || $currentRoute == 'help'): ?>
                        <a href="?route=dashboard" class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <div class="flex items-center gap-2.5">
                        <div class="h-9 w-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-600/20">
                            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M320 288C377.4 288 424 241.4 424 184C424 126.6 377.4 80 320 80C262.6 80 216 126.6 216 184C216 241.4 262.6 288 320 288zM96 296C135.8 296 168 263.8 168 224C168 184.2 135.8 152 96 152C56.2 152 24 184.2 24 224C24 263.8 56.2 296 96 296zM0 480L0 512C0 529.7 14.3 544 32 544L118.7 544C114.4 534.2 112 523.4 112 512L112 496C112 442.8 132 394.2 164.9 357.4C153.2 353.9 140.8 352 128 352C57.3 352 0 409.3 0 480zM616 224C616 184.2 583.8 152 544 152C504.2 152 472 184.2 472 224C472 263.8 504.2 296 544 296C583.8 296 616 263.8 616 224zM160 496L160 512C160 529.7 174.3 544 192 544L348.8 544C341.7 522.4 342.5 499.6 359.5 480C345.5 463.8 339 440.3 348.1 416.7C354.7 399.6 364 383.6 375.5 369.4C380.9 362.8 387.1 357.7 393.8 354C371.7 342.5 346.6 336 320 336C231.6 336 160 407.6 160 496zM624.6 451.9C630.9 448.3 634.1 440.8 631.4 433.9C626.6 421.5 619.9 409.8 611.5 399.5C606.9 393.8 598.8 392.8 592.5 396.5C570.7 409.1 543.9 393.7 543.9 368.4C543.9 361.1 539 354.6 531.8 353.5C518.9 351.5 505 351.5 492.1 353.5C484.9 354.6 480 361.1 480 368.4C480 393.6 453.2 409.1 431.4 396.5C425.1 392.9 417 393.9 412.4 399.5C404 409.8 397.3 421.5 392.5 433.9C389.9 440.7 393 448.2 399.3 451.8C421.2 464.4 421.2 495.3 399.3 508C393 511.6 389.8 519.1 392.5 525.9C397.3 538.3 404 550 412.4 560.3C417 566 425.1 567 431.4 563.3C453.2 550.7 480 566.2 480 591.4C480 598.7 484.9 605.2 492.1 606.3C505 608.3 518.9 608.3 531.8 606.3C539 605.2 543.9 598.7 543.9 591.4C543.9 566.2 570.7 550.7 592.5 563.3C598.8 566.9 606.9 565.9 611.5 560.3C619.9 550 626.6 538.3 631.4 525.9C634 519.1 630.9 511.6 624.6 508C602.7 495.4 602.7 464.5 624.6 451.8zM472 480C472 457.9 489.9 440 512 440C534.1 440 552 457.9 552 480C552 502.1 534.1 520 512 520C489.9 520 472 502.1 472 480z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold text-slate-800 tracking-tight">BDT<span class="text-indigo-600 font-medium">.sys</span></span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <a href="?route=help" class="text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">Centro de Ayuda</a>
                    <?php elseif($currentRoute !== 'home' && $currentRoute !== 'login'): ?>
                        <div class="hidden md:flex items-center gap-2">
                            <a href="?route=create_ticket" class="hidden lg:inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 mr-2">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14"/><path d="M5 12h14"/>
                                </svg>
                                Nuevo Ticket
                            </a>

                            <div class="relative">
                                <button id="desktop-menu-toggle" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white border border-slate-200 text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" aria-expanded="false" aria-controls="desktop-menu" aria-label="Abrir menú">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/>
                                    </svg>
                                </button>
                                
                                <div id="desktop-menu" class="hidden absolute right-0 mt-3 w-64 rounded-2xl border border-slate-100 bg-white/90 backdrop-blur-xl p-2 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] origin-top-right">
                                    
                                    <div class="px-3 py-2 mb-2 border-b border-slate-100">
                                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Menú Operativo</p>
                                    </div>

                                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                        <a href="?route=create_user" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                            Crear Usuario
                                        </a>
                                        <a href="?route=users" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            Listar Usuarios
                                        </a>
                                        <div class="my-1 border-t border-slate-100"></div>
                                    <?php endif; ?>

                                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                                        <a href="?route=help_requests" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            Centro de ayuda
                                        </a>
                                        <a href="?route=ticket_stats" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                            Estadísticas
                                        </a>
                                        <a href="?route=ticket_report" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-700 mb-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Generar Reportes
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="?route=logout" class="flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-3 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 w-full mt-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </div>
                        </div>

                        <button id="nav-toggle" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors" aria-expanded="false" aria-controls="mobile-menu" aria-label="Abrir menú">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(isset($_SESSION['user_id']) && $currentRoute !== 'home' && $currentRoute !== 'login'): ?>
                <div id="mobile-menu" class="md:hidden hidden w-full pt-4 pb-2 border-t border-slate-100 mt-2">
                    <div class="flex flex-col gap-2">
                        <a href="?route=create_ticket" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Nuevo Ticket
                        </a>
                        
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                            <a href="?route=create_user" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Crear usuario</a>
                            <a href="?route=users" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Listar Usuarios</a>
                        <?php endif; ?>
                        
                        <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                            <a href="?route=help_requests" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Centro de ayuda</a>
                            <a href="?route=ticket_stats" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Estadísticas</a>
                            <a href="?route=ticket_report" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Generar Reportes</a>
                        <?php endif; ?>
                        
                        <a href="?route=logout" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white mt-2">
                            Cerrar Sesión
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    
    <script>
        // Lógica para el menú móvil
        const navToggle = document.getElementById('nav-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const desktopMenuToggle = document.getElementById('desktop-menu-toggle');
        const desktopMenu = document.getElementById('desktop-menu');
        
        if (navToggle && mobileMenu) {
            navToggle.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.contains('hidden') === false;
                mobileMenu.classList.toggle('hidden');
                navToggle.setAttribute('aria-expanded', String(!isOpen));
            });
        }

        if (desktopMenuToggle && desktopMenu) {
            desktopMenuToggle.addEventListener('click', (event) => {
                event.stopPropagation();
                const isOpen = desktopMenu.classList.contains('hidden') === false;
                
                if(!isOpen) {
                    desktopMenu.classList.remove('hidden');
                    // Pequeño timeout para permitir que se aplique display:block antes de animar opacidad
                    setTimeout(() => desktopMenu.classList.add('opacity-100', 'scale-100'), 10);
                } else {
                    desktopMenu.classList.add('hidden');
                }
                desktopMenuToggle.setAttribute('aria-expanded', String(!isOpen));
            });

            document.addEventListener('click', (event) => {
                if (!desktopMenu.contains(event.target) && !desktopMenuToggle.contains(event.target)) {
                    desktopMenu.classList.add('hidden');
                    desktopMenuToggle.setAttribute('aria-expanded', 'false');
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    desktopMenu.classList.add('hidden');
                    desktopMenuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // Lógica para ocultar el ticker y animar el navbar al hacer scroll
        const nav = document.getElementById('main-nav');
        const ticker = document.getElementById('company-ticker');
        const hasTicker = <?= $showCompanyTicker ? 'true' : 'false' ?>;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                if (ticker) ticker.classList.add('-translate-y-full');
                nav.classList.add('nav-scrolled');
                nav.classList.remove('nav-top');
                if (hasTicker) nav.classList.remove('with-ticker');
            } else {
                if (ticker) ticker.classList.remove('-translate-y-full');
                nav.classList.remove('nav-scrolled');
                nav.classList.add('nav-top');
                if (hasTicker) nav.classList.add('with-ticker');
            }
        });
    </script>

    <main class="flex-grow w-full <?= $showCompanyTicker ? 'pt-[6rem] md:pt-[7rem]' : 'pt-[4rem] md:pt-[5rem]' ?>">