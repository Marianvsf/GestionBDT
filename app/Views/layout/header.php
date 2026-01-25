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
<div id="default-carousel" class="relative w-full h-[500px] md:h-[600px] overflow-hidden" data-carousel="slide">
    
    <div class="relative h-full overflow-hidden rounded-b-3xl shadow-2xl group">
        
        <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
            <img src="https://images.unsplash.com/photo-1565514020176-db792f4b6d96?q=80&w=2000&auto=format&fit=crop" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Banco Digital">
            <div class="absolute inset-0 bg-gradient-to-r from-[#010b50]/90 via-[#010b50]/50 to-transparent flex items-center">
                <div class="container mx-auto px-6 md:px-12">
                    <div class="max-w-lg text-white animate-fade-in-up">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">Tu Futuro Financiero <br><span class="text-blue-300">Comienza Aquí</span></h1>
                        <p class="text-lg text-gray-200 mb-8">Gestión inteligente, segura y rápida de tus activos. La banca del futuro diseñada para los trabajadores de hoy.</p>
                        <a href="?route=login" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition transform hover:-translate-y-1 shadow-lg border border-blue-400">
                            Ingresar Ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=2000&auto=format&fit=crop" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Seguridad">
            <div class="absolute inset-0 bg-gradient-to-r from-[#010b50]/90 via-[#010b50]/60 to-transparent flex items-center">
                <div class="container mx-auto px-6 md:px-12">
                    <div class="max-w-lg text-white">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">Seguridad de <br><span class="text-green-400">Última Generación</span></h1>
                        <p class="text-lg text-gray-200 mb-8">Tus datos protegidos con encriptación de grado militar. Confianza absoluta en cada transacción.</p>
                        <button class="bg-transparent hover:bg-white/10 text-white font-bold py-3 px-8 rounded-full border-2 border-white transition">
                            Conocer Más
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2000&auto=format&fit=crop" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Tecnología">
            <div class="absolute inset-0 bg-gradient-to-r from-[#010b50]/90 via-[#010b50]/60 to-transparent flex items-center">
                <div class="container mx-auto px-6 md:px-12">
                    <div class="max-w-lg text-white">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">Innovación <br><span class="text-yellow-300">Sin Límites</span></h1>
                        <p class="text-lg text-gray-200 mb-8">Accede a tus cuentas desde cualquier lugar, en cualquier dispositivo. Tecnología al servicio de tu comodidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:outline-none transition" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:outline-none transition" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white focus:outline-none transition" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>

    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/10 group-hover:bg-white/20 group-focus:ring-2 group-focus:ring-white group-focus:outline-none backdrop-blur-sm">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/10 group-hover:bg-white/20 group-focus:ring-2 group-focus:ring-white group-focus:outline-none backdrop-blur-sm">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('[data-carousel-item]');
        const dots = document.querySelectorAll('[data-carousel-slide-to]');
        const prevBtn = document.querySelector('[data-carousel-prev]');
        const nextBtn = document.querySelector('[data-carousel-next]');
        let currentIndex = 0;
        const totalItems = items.length;
        let intervalId;

        // Función para mostrar un slide específico
        function showSlide(index) {
            items.forEach((item, i) => {
                if (i === index) {
                    item.classList.remove('hidden');
                    item.classList.add('block');
                } else {
                    item.classList.add('hidden');
                    item.classList.remove('block');
                }
            });

            // Actualizar puntos
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.add('bg-white/50');
                    dot.classList.remove('bg-white');
                }
            });
            currentIndex = index;
        }

        // Siguiente Slide
        function nextSlide() {
            let nextIndex = (currentIndex + 1) % totalItems;
            showSlide(nextIndex);
        }

        // Anterior Slide
        function prevSlide() {
            let prevIndex = (currentIndex - 1 + totalItems) % totalItems;
            showSlide(prevIndex);
        }

        // Configurar botones
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetInterval();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetInterval();
        });

        // Configurar puntos
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
                resetInterval();
            });
        });

        // Autoplay
        function startInterval() {
            intervalId = setInterval(nextSlide, 5000); 
        }

        function resetInterval() {
            clearInterval(intervalId);
            startInterval();
        }

        // Iniciar
        showSlide(0);
        startInterval();
    });
</script>

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