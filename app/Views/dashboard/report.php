<?php require __DIR__ . '/../layout/header.php'; ?>
<style>    
    .feature-card {
        border: 1px solid rgba(203, 213, 225, 0.6);
        background: linear-gradient(160deg, rgba(241, 245, 249, 0.55), rgba(248, 250, 252, 0.45));
        box-shadow: 0 20px 45px -30px rgba(30, 41, 59, 0.35);
    }
    @media (max-width: 768px) {
        .feature-card {
            background: none;
            box-shadow: none;
            border: none;
        }
    }
</style>

<div class="container mx-auto px-4 py-6 sm:py-8 w-full max-w-full overflow-hidden">
    <div class="feature-card md:p-12 rounded-3xl max-w-6xl mx-auto w-full">
        <h2 class="text-xl sm:text-2xl text-center font-bold text-gray-800">Generar reporte de tickets</h2>
        
        <div class="bg-white rounded-xl mt-6 sm:mt-10 mx-auto shadow-sm border border-slate-100 w-full max-w-[880px] p-5 sm:p-10">
            <p class="text-sm text-gray-600 mb-6 text-center md:text-left">Filtra por rango de fechas, estado, categoría o asignado y descarga un CSV.</p>
            
            <form method="POST" action="?route=ticket_report" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="w-full">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Desde</label>
                    <input type="date" name="from_date" class="block w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white" />
                </div>
                
                <div class="w-full">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Hasta</label>
                    <input type="date" name="to_date" class="block w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white" />
                </div>
                
                <div class="w-full">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Estado</label>
                    <select name="status" class="block w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white cursor-pointer">
                        <option value="all">Todos</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Ejecutada">Ejecutada</option>
                    </select>
                </div>
                
                <div class="w-full">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Asignado a</label>
                    <select name="assigned_to" class="block w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white cursor-pointer">
                        <option value="0">Cualquiera</option>
                        <?php foreach ($supportUsers as $su): ?>
                            <option value="<?= $su['id'] ?>"><?= htmlspecialchars($su['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="md:col-span-2 w-full">
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Categoría (palabra clave)</label>
                    <input type="text" name="category" placeholder="Ej: Hardware, Software, Redes..." class="block w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-colors bg-slate-50 focus:bg-white" />
                </div>
                
                <div class="md:col-span-2 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 mt-4 w-full">
                    <a href="?route=dashboard" class="flex justify-center items-center w-full sm:w-auto rounded-full bg-slate-100 px-6 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        Volver
                    </a>
                    <button type="submit" class="flex justify-center items-center w-full sm:w-auto gap-2 rounded-full bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-md hover:-translate-y-0.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Generar CSV
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>