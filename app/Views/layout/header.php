<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Corporativo - BDT</title>
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #main-nav { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); left: 50%; transform: translateX(-50%); }
        .nav-top { width: 100%; top: 0; background-color: rgba(255, 255, 255, 1); border-bottom: 1px solid #f3f4f6; padding: 0.75rem 0; }
        .nav-scrolled { width: 90%; max-width: 1200px; top: 1.5rem; border-radius: 9999px; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); padding: 0.5rem 0; }
        
        /* Animación suave para el fondo */
        .animated-bg {
            background: linear-gradient(-45deg, #010b50, #0f172a, #1e3a8a, #312e81);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased font-sans flex flex-col min-h-screen">

    <?php $currentRoute = $_GET['route'] ?? 'home'; ?>
    <nav id="main-nav" class="fixed z-50 nav-top">
        <div class="container mx-auto px-6 flex flex-col">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center gap-4">
                <?php if(isset($_SESSION['user_id']) && $currentRoute !== 'home' && $currentRoute !== 'login' || $currentRoute == 'help'): ?>
                    <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300/60">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </a>
                <?php endif; ?>
                <svg class="h-6 w-6 text-[#4F46E5] hover:text-blue-800 transition-colors" 
                    fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path d="M320 288C377.4 288 424 241.4 424 184C424 126.6 377.4 80 320 80C262.6 80 216 126.6 216 184C216 241.4 262.6 288 320 288zM96 296C135.8 296 168 263.8 168 224C168 184.2 135.8 152 96 152C56.2 152 24 184.2 24 224C24 263.8 56.2 296 96 296zM0 480L0 512C0 529.7 14.3 544 32 544L118.7 544C114.4 534.2 112 523.4 112 512L112 496C112 442.8 132 394.2 164.9 357.4C153.2 353.9 140.8 352 128 352C57.3 352 0 409.3 0 480zM616 224C616 184.2 583.8 152 544 152C504.2 152 472 184.2 472 224C472 263.8 504.2 296 544 296C583.8 296 616 263.8 616 224zM160 496L160 512C160 529.7 174.3 544 192 544L348.8 544C341.7 522.4 342.5 499.6 359.5 480C345.5 463.8 339 440.3 348.1 416.7C354.7 399.6 364 383.6 375.5 369.4C380.9 362.8 387.1 357.7 393.8 354C371.7 342.5 346.6 336 320 336C231.6 336 160 407.6 160 496zM624.6 451.9C630.9 448.3 634.1 440.8 631.4 433.9C626.6 421.5 619.9 409.8 611.5 399.5C606.9 393.8 598.8 392.8 592.5 396.5C570.7 409.1 543.9 393.7 543.9 368.4C543.9 361.1 539 354.6 531.8 353.5C518.9 351.5 505 351.5 492.1 353.5C484.9 354.6 480 361.1 480 368.4C480 393.6 453.2 409.1 431.4 396.5C425.1 392.9 417 393.9 412.4 399.5C404 409.8 397.3 421.5 392.5 433.9C389.9 440.7 393 448.2 399.3 451.8C421.2 464.4 421.2 495.3 399.3 508C393 511.6 389.8 519.1 392.5 525.9C397.3 538.3 404 550 412.4 560.3C417 566 425.1 567 431.4 563.3C453.2 550.7 480 566.2 480 591.4C480 598.7 484.9 605.2 492.1 606.3C505 608.3 518.9 608.3 531.8 606.3C539 605.2 543.9 598.7 543.9 591.4C543.9 566.2 570.7 550.7 592.5 563.3C598.8 566.9 606.9 565.9 611.5 560.3C619.9 550 626.6 538.3 631.4 525.9C634 519.1 630.9 511.6 624.6 508C602.7 495.4 602.7 464.5 624.6 451.8zM472 480C472 457.9 489.9 440 512 440C534.1 440 552 457.9 552 480C552 502.1 534.1 520 512 520C489.9 520 472 502.1 472 480z"/>
                </svg>
                <span class="text-xl font-italic text-gray-900 tracking-tight">BDT<span class="text-[#4F46E5]">.sistema</span></span>
                </div>
                <div class="flex items-center gap-3">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <a href="?route=help" class="text-sm font-semibold text-gray-500 hover:text-[#010b50]">Centro de Ayuda</a>
                    <?php elseif($currentRoute !== 'home' && $currentRoute !== 'login'): ?>
                        <div class="hidden md:flex items-center gap-3">
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                                <a href="?route=users" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400/40">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    Usuarios
                                </a>
                                <a href="?route=create_user" class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600/40">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="8.5" cy="7" r="4"/>
                                        <line x1="20" y1="8" x2="20" y2="14"/>
                                        <line x1="17" y1="11" x2="23" y2="11"/>
                                    </svg>
                                    Crear usuario
                                </a>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                                <a href="?route=help_requests" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400/40">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2z"/>
                                        <path d="M8 9h8"/>
                                        <path d="M8 13h6"/>
                                    </svg>
                                    Solicitudes
                                </a>
                            <?php endif; ?>
                            <a href="?route=create_ticket" class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>
                                Incidencia
                            </a>
                            <a href="?route=logout" class="inline-flex items-center gap-2 rounded-full bg-[#010b50] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0b1f7a] focus:outline-none focus:ring-2 focus:ring-[#010b50]/40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Salir
                            </a>
                        </div>
                        <button id="nav-toggle" class="md:hidden inline-flex items-center justify-center rounded-full border border-slate-200 bg-white p-2 text-slate-600 shadow-sm hover:bg-slate-50" aria-expanded="false" aria-controls="mobile-menu" aria-label="Abrir menú">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="3" y1="12" x2="21" y2="12"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <line x1="3" y1="18" x2="21" y2="18"/>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(isset($_SESSION['user_id']) && $currentRoute !== 'home' && $currentRoute !== 'login'): ?>
                <div id="mobile-menu" class="md:hidden hidden w-full pt-3 pb-2">
                    <div class="flex flex-col gap-2">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Gerente'): ?>
                            <a href="?route=users" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400/40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                Usuarios
                            </a>
                            <a href="?route=create_user" class="inline-flex items-center justify-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600/40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="8.5" cy="7" r="4"/>
                                    <line x1="20" y1="8" x2="20" y2="14"/>
                                    <line x1="17" y1="11" x2="23" y2="11"/>
                                </svg>
                                Crear usuario
                            </a>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'Gerente' || $_SESSION['role'] === 'Soporte')): ?>
                            <a href="?route=help_requests" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-400/40">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2z"/>
                                    <path d="M8 9h8"/>
                                    <path d="M8 13h6"/>
                                </svg>
                                Solicitudes
                            </a>
                        <?php endif; ?>
                        <a href="?route=create_ticket" class="inline-flex items-center justify-center gap-2 rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600/40">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>
                            Incidencia
                        </a>
                        <a href="?route=logout" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#010b50] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0b1f7a] focus:outline-none focus:ring-2 focus:ring-[#010b50]/40">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16 17 21 12 16 7"/>
                                <line x1="21" y1="12" x2="9" y2="12"/>
                            </svg>
                            Salir
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <script>
        const navToggle = document.getElementById('nav-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        if (navToggle && mobileMenu) {
            navToggle.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.contains('hidden') === false;
                mobileMenu.classList.toggle('hidden');
                navToggle.setAttribute('aria-expanded', String(!isOpen));
            });
        }
    </script>

    <main class="flex-grow w-full pt-12 md:pt-12">