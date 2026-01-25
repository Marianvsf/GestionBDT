<?php require __DIR__ . '/../layout/header.php'; ?>

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

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        
        <div class="text-center">
            <div class="mx-auto h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                <svg class="h-6 w-6 text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Acceso BDT</h2>
            <p class="mt-2 text-sm text-gray-600">Bienvenido a la banca en línea</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md flex items-center">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <p class="text-sm text-red-700 font-medium"><?= $error ?></p>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" method="POST" action="?route=login">
            <div class="rounded-md shadow-sm space-y-4">
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="username" name="username" type="text" required class="pl-10 block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:border-transparent transition duration-150 sm:text-sm" placeholder="Ingrese su usuario">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        
                        <input id="password" name="password" type="password" required class="pl-10 pr-10 block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:border-transparent transition duration-150 sm:text-sm" placeholder="••••••••">
                        
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#010b50] focus:outline-none">
                            <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-off-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[#010b50] focus:ring-[#010b50] border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Recordarme</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-[#010b50] hover:text-blue-800 transition">¿Olvidaste tu clave?</a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-[#010b50] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#010b50] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </span>
                    Ingresar al Sistema
                </button>
            </div>
        </form>
    </div>
</div>

<script>
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