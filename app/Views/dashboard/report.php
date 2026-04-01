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
<div class="container mx-auto py-6 sm:py-8">
    <div class="feature-card md:p-12 rounded-3xl max-w-6xl mx-auto">
        <h2 class="text-2xl text-center font-bold text-gray-800">Generar reporte de tickets</h2>
    <div class="bg-white rounded-lg mt-10 mx-auto shadow w-full max-w-[880px] p-8 sm:p-10">
        <p class="text-sm text-gray-600 mb-6">Filtra por rango de fechas, estado, categoría o asignado y descarga un CSV.</p>
        <form method="POST" action="?route=ticket_report" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-700">Desde</label>
                <input type="date" name="from_date" class="mt-1 block w-full border border-slate-200 rounded-md px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Hasta</label>
                <input type="date" name="to_date" class="mt-1 block w-full border border-slate-200 rounded-md px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Estado</label>
                <select name="status" class="mt-1 block w-full border border-slate-200 rounded-md px-3 py-2 text-sm">
                    <option value="all">Todos</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Ejecutada">Ejecutada</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Asignado a</label>
                <select name="assigned_to" class="mt-1 block w-full border border-slate-200 rounded-md px-3 py-2 text-sm">
                    <option value="0">Cualquiera</option>
                    <?php foreach ($supportUsers as $su): ?>
                        <option value="<?= $su['id'] ?>"><?= htmlspecialchars($su['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-700">Categoría (palabra clave)</label>
                <input type="text" name="category" placeholder="Opcional" class="mt-1 block w-full border border-slate-200 rounded-md px-3 py-2 text-sm" />
            </div>
            <div class="md:col-span-2 flex items-center justify-end gap-3 mt-2">
                <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">Volver</a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Generar CSV</button>
            </div>
        </form>
    </div>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
