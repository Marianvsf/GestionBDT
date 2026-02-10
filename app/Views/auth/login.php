<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="w-full grid grid-cols-1 lg:grid-cols-2 min-h-screen">
    <div class="hidden lg:flex flex-col justify-center relative overflow-hidden animated-bg text-white">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative z-10 max-w-lg mx-auto">
            <div class="mb-8 inline-block bg-blue-500/20 backdrop-blur-sm border border-blue-400/30 rounded-full px-4 py-1 text-sm text-blue-200 font-medium">
                🚀 Versión 1.0.4 Beta
            </div>
            <h1 class="text-5xl font-bold mb-6 leading-tight">
                Gestión Inteligente de <span class="text-blue-300">Incidencias</span>
            </h1>
            <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                Bienvenido al portal centralizado del Banco Digital. Reporta fallas, gestiona tickets y obtén soluciones rápidas gracias a nuestro nuevo motor de clasificación por IA.
            </p>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10">
                    <div class="text-2xl mb-2">⚡</div>
                    <h3 class="font-bold">Clasificación Auto</h3>
                    <p class="text-xs text-blue-200 mt-1">La IA detecta el área del problema al escribir.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10">
                    <div class="text-2xl mb-2">🔒</div>
                    <h3 class="font-bold">Máxima Seguridad</h3>
                    <p class="text-xs text-blue-200 mt-1">Encriptación de extremo a extremo.</p>
                </div>
            </div>
            
            <div class="mt-12 text-xs text-blue-300 opacity-60">
                &copy; 2026 Tecnología y Sistemas BDT
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center bg-white px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-50 blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-md w-full space-y-8 z-10">
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-[#010b50] rounded-2xl rotate-3 flex items-center justify-center mb-6 shadow-xl shadow-blue-900/20">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Acceso Seguro</h2>
                <p class="mt-2 text-sm text-gray-500">Usa tus credenciales de red para ingresar.</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md flex items-center animate-pulse">
                    <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <p class="text-sm text-red-700 font-medium"><?= $error ?></p>
                </div>
            <?php endif; ?>

            <form class="mt-8 space-y-6" method="POST" action="?route=login">
                <div class="space-y-5">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Usuario Corporativo</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#010b50] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="username" name="username" type="text" required class="pl-10 block w-full px-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:border-transparent transition duration-200 sm:text-sm bg-gray-50 focus:bg-white" placeholder="ej: j.perez">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#010b50] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required class="pl-10 pr-10 block w-full px-3 py-3 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:border-transparent transition duration-200 sm:text-sm bg-gray-50 focus:bg-white" placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#010b50] cursor-pointer">
                                <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg id="eye-off-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[#010b50] focus:ring-[#010b50] border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Recordar sesión</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-[#010b50] hover:text-blue-800 transition">Recuperar clave</a>
                    </div>
                </div>

                <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-[#010b50] hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#010b50] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Acceder al Sistema
                    <span class="absolute right-0 inset-y-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-blue-300 group-hover:text-white transition-colors -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </span>
                </button>
            </form>
        </div>
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