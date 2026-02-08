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
                <?php if(isset($_SESSION['user_id']) && $currentRoute !== 'home' && $currentRoute !== 'login'): ?>
                    <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300/60">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </a>
                <?php endif; ?>
                <svg class="w-8 h-8 text-[#4F46E5]" viewBox="0 0 24 24" fill="none"><path d="M2 12C2 12 5 9 8 9C11 9 13 12 16 12C19 12 22 9 22 9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17C2 17 5 14 8 14C11 14 13 17 16 17C19 17 22 14 22 14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/></svg>
                <span class="text-xl font-bold text-gray-900 tracking-tight">BDT<span class="text-[#4F46E5]">.sistema</span></span>
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