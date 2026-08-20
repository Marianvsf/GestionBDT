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
    
    <div class="absolute top-10 right-1/4 w-72 h-72 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>
    <div class="absolute bottom-10 left-1/4 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 pointer-events-none"></div>

    <div class="w-full max-w-2xl relative z-10">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-indigo-50 text-indigo-600 mb-5 shadow-sm border border-indigo-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Reportar Incidencia</h2>
            <p class="text-slate-500 mt-3 text-base max-w-lg mx-auto leading-relaxed">
                Detalla el problema que estás experimentando. Nuestro sistema analizará tu solicitud automáticamente para acelerar la resolución.
            </p>
        </div>

        <div class="glass-panel p-6 sm:p-10 rounded-3xl">
            <form method="POST" class="space-y-6">
                
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Asunto</label>
                    <input type="text" id="title" name="title" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 placeholder-slate-400" placeholder="Ej: Falla de conexión a la VPN corporativa" required>
                </div>

                <div>
                    <label for="department" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Departamento Afectado</label>
                    <div class="relative">
                        <select id="department" name="department" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 appearance-none cursor-pointer" required>
                            <option value="" disabled selected>Selecciona tu área o departamento...</option>
                            <?php foreach (($departments ?? []) as $department): ?>
                                <option value="<?= htmlspecialchars($department) ?>"><?= htmlspecialchars($department) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Descripción Detallada</label>
                    <textarea id="description" name="description" rows="5" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 placeholder-slate-400 resize-y" placeholder="Describe los pasos previos a la falla, mensajes de error en pantalla o cualquier detalle que ayude a soporte técnico..." required></textarea>
                    
                    <div class="flex items-start gap-2 mt-3 ml-1">
                        <div class="bg-indigo-100 text-indigo-600 rounded-full p-1 shrink-0 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p class="text-[11px] sm:text-xs text-slate-500 font-medium leading-relaxed">
                            <strong class="text-slate-700">Clasificación Inteligente:</strong> No te preocupes por la categoría o prioridad, la IA evaluará tu texto para enrutar el ticket de forma óptima.
                        </p>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-slate-900/10">
                        <span>Enviar Reporte</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
                
            </form>
        </div>
        
        <div class="mt-8 text-center">
            <a href="?route=dashboard" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al tablero
            </a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>