<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.05);
    }
    
    .input-modern {
        background-color: #f8fafc;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    
    .input-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }
</style>

<div class="container mx-auto px-4 py-12 lg:py-16 w-full max-w-7xl relative overflow-hidden min-h-[calc(100vh-100px)] flex items-center justify-center">
    
    <div class="absolute top-10 left-1/4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>
    <div class="absolute bottom-10 right-1/4 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>

    <div class="w-full max-w-xl relative z-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-[#010b50]/5 text-[#010b50] mb-5 shadow-sm border border-blue-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Editar Usuario</h2>
            <p class="text-slate-500 mt-2 text-base max-w-sm mx-auto">
                Modifica los datos y permisos de acceso para este miembro del equipo.
            </p>
        </div>

        <div class="glass-panel p-6 sm:p-10 rounded-3xl">
            
            <?php if(isset($error)): ?>
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 p-4">
                    <svg class="h-5 w-5 text-rose-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-base font-medium text-rose-800"><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Usuario</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input id="username" type="text" name="username" class="input-modern block w-full rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-slate-400" required value="<?= htmlspecialchars($user['username']) ?>" autocapitalize="off" spellcheck="false">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-end mb-2 ml-1">
                        <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Contraseña</label>
                        <span class="text-[11px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">Opcional</span>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input id="password" type="password" name="password" class="input-modern block w-full rounded-xl py-3 pl-11 pr-12 text-sm text-slate-700 placeholder-slate-400" placeholder="Dejar en blanco para mantener la actual">
                        
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#010b50] focus:outline-none transition-colors" aria-label="Mostrar u ocultar contraseña">
                            <svg id="eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg id="eye-slash-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                <line x1="2" y1="2" x2="22" y2="22" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="role" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Rol</label>
                        <div class="relative">
                            <select id="role" name="role" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 appearance-none cursor-pointer" required>
                                <option value="" disabled>Selecciona un rol</option>
                                <option value="Gerente" <?= ($user['role'] === 'Gerente') ? 'selected' : '' ?>>Gerente</option>
                                <option value="Analista" <?= ($user['role'] === 'Analista') ? 'selected' : '' ?>>Analista</option>
                                <option value="Soporte" <?= ($user['role'] === 'Soporte') ? 'selected' : '' ?>>Soporte</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="department" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Departamento</label>
                        <div class="relative">
                            <select id="department" name="department" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 appearance-none cursor-pointer" required>
                                <option value="" disabled>Selecciona un departamento</option>
                                <?php foreach (($departments ?? []) as $departmentOption): ?>
                                    <option value="<?= htmlspecialchars($departmentOption) ?>" <?= (($user['department'] ?? '') === $departmentOption) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($departmentOption) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row items-center gap-3">
                    <button type="submit" class="w-full sm:flex-1 flex items-center justify-center gap-2 rounded-xl bg-[#010b50] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition-all hover:bg-blue-900 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-[#010b50]/20">
                        Guardar Cambios
                    </button>
                    <a href="?route=users" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('toggle-password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeSlashIcon = document.getElementById('eye-slash-icon');

    if (usernameInput) {
        usernameInput.addEventListener('input', () => {
            usernameInput.value = usernameInput.value.toLowerCase();
        });
    }

    if (togglePasswordBtn) {
        togglePasswordBtn.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('hidden');
            eyeSlashIcon.classList.toggle('hidden');
        });
    }
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>