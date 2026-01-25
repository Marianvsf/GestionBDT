<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        
        <div class="text-center">
            <div class="mx-auto h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                <svg class="h-6 w-6 text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Acceso BDT</h2>
            <p class="mt-2 text-sm text-gray-600">
                Bienvenido a la banca en línea
            </p>
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
                        <input id="password" name="password" type="password" required class="pl-10 block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:border-transparent transition duration-150 sm:text-sm" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-[#010b50] focus:ring-[#010b50] border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                        Recordarme
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-[#010b50] hover:text-blue-800 transition">
                        ¿Olvidaste tu clave?
                    </a>
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

<?php require __DIR__ . '/../layout/footer.php'; ?>