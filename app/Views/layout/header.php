<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDT - Banco Digital de los Trabajadores</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* CSS Personalizado para máxima suavidad */
        #main-nav {
            /* El secreto: Transición lenta y curva Bezier (Efecto rebote sutil) */
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            
            /* SIEMPRE centrado para evitar saltos laterales */
            left: 50%;
            transform: translateX(-50%);
        }

        /* Estado 1: Barra Normal (Arriba) */
        .nav-top {
            width: 100%;
            top: 0;
            border-radius: 0;
            background-color: rgba(255, 255, 255, 1); /* Blanco sólido */
            border-bottom: 1px solid #f3f4f6;
            padding-top: 0.75rem;   /* py-3 */
            padding-bottom: 0.75rem;
        }

        /* Estado 2: Píldora Flotante (Scrolled) */
        .nav-scrolled {
            width: 90%;           /* Se encoge */
            max-width: 1200px;    /* Tope máximo */
            top: 1.5rem;          /* Baja un poco (top-6) */
            border-radius: 9999px; /* Redondo */
            background-color: rgba(255, 255, 255, 0.85); /* Semitransparente */
            backdrop-filter: blur(12px); /* Efecto vidrio */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid transparent; /* Quita la línea inferior */
            padding-top: 0.5rem;    /* py-2 (se hace más delgada) */
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased font-sans">

    <nav id="main-nav" class="fixed z-50 nav-top">
        <div class="container mx-auto px-6 flex justify-between items-center h-full">
            
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-[#4F46E5]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 12C2 12 5 9 8 9C11 9 13 12 16 12C19 12 22 9 22 9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17C2 17 5 14 8 14C11 14 13 17 16 17C19 17 22 14 22 14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/>
                </svg>
                <span class="text-xl font-bold text-gray-900 tracking-tight">BDT<span class="text-[#4F46E5]">.sistema</span></span>
            </div>

            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="hidden md:flex items-center gap-8">
                    <a href="?route=dashboard" class="text-sm font-medium text-gray-600 hover:text-[#4F46E5] transition-colors">Dashboard</a>
                    <a href="?route=create_ticket" class="text-sm font-medium text-gray-600 hover:text-[#4F46E5] transition-colors">Reportes</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-[#4F46E5] transition-colors">Equipo</a>
                </div>

                <div class="flex items-center gap-4">
                    <span class="hidden sm:block text-sm font-medium text-gray-500">Hola, Admin</span>
                    <a href="?route=logout" class="group bg-[#4F46E5] hover:bg-[#4338ca] text-white px-5 py-2 rounded-full text-sm font-semibold transition-all shadow-md flex items-center gap-2">
                        <span>Salir</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </a>
                </div>
            <?php else: ?>
                <a href="?route=login" class="text-sm font-semibold text-[#4F46E5]">Iniciar Sesión &rarr;</a>
            <?php endif; ?>
        </div>
    </nav>

    <script>
        const nav = document.getElementById('main-nav');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) { 
                // Al bajar apenas 20px, activa el modo píldora
                nav.classList.remove('nav-top');
                nav.classList.add('nav-scrolled');
            } else {
                // Al volver arriba, vuelve al modo normal
                nav.classList.add('nav-top');
                nav.classList.remove('nav-scrolled');
            }
        });
    </script>

    <div class="pt-24 container mx-auto px-4 min-h-screen">