<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container mx-auto px-4 sm:px-6 lg:px-12 py-6 sm:py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Dashboard de Datos</h1>
        <div>
            <a href="?route=dashboard" class="inline-block px-3 py-2 bg-slate-100 rounded">Volver</a>
            <a href="?route=ticket_report_page" class="inline-block px-3 py-2 bg-indigo-600 text-white rounded ml-2">Imprimir</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-sm text-gray-500">Total tickets</div>
            <div id="stat-total" class="text-2xl font-bold">...</div>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-sm text-gray-500">Categorías</div>
            <div id="stat-cats" class="text-2xl font-bold">...</div>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-sm text-gray-500">Estados</div>
            <div id="stat-status" class="text-2xl font-bold">...</div>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <div class="text-sm text-gray-500">Prioridades</div>
            <div id="stat-prio" class="text-2xl font-bold">...</div>
        </div>
    </div>

    <style>
        .chart-fixed { width:100%; }
        .chart-ts { height: 260px; }
        .chart-cat { height: 260px; }
        .chart-status { height: 140px; }
        .chart-fixed canvas { width:100% !important; height:100% !important; }
    </style>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-2 bg-white p-4 rounded shadow chart-fixed chart-ts">
            <h3 class="font-semibold mb-2">Tickets en últimos 30 días</h3>
            <canvas id="tsChart"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow chart-fixed chart-cat">
            <h3 class="font-semibold mb-2">Distribución por categoría</h3>
            <canvas id="catChart"></canvas>
        </div>
    </div>

    <div class="mt-6 bg-white p-4 rounded shadow chart-fixed chart-status">
        <h3 class="font-semibold mb-2">Resumen por estado</h3>
        <canvas id="statusChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
async function loadStats() {
    const res = await fetch('?route=ticket_stats_data');
    if (!res.ok) { console.error('Error fetching stats'); return; }
    const data = await res.json();
    document.getElementById('stat-total').textContent = data.total;
    document.getElementById('stat-cats').textContent = data.byCategory.length;
    document.getElementById('stat-status').textContent = data.byStatus.reduce((s,i)=>s+i.cnt,0);
    document.getElementById('stat-prio').textContent = data.byPriority.length;

    // Timeseries chart
    const labels = [];
    const points = [];
    const dmap = {};
    (data.timeseries || []).forEach(r=> { dmap[r.d]=parseInt(r.cnt); });
    // build last 30 days
    const now = new Date();
    for (let i=29;i>=0;i--) {
        const d = new Date(now.getFullYear(), now.getMonth(), now.getDate()-i);
        const key = d.toISOString().slice(0,10);
        labels.push(key);
        points.push(dmap[key] || 0);
    }
    const tsCtx = document.getElementById('tsChart').getContext('2d');
    new Chart(tsCtx, { type: 'line', data: { labels, datasets: [{ label: 'Tickets', data: points, borderColor: '#4F46E5', backgroundColor: 'rgba(79,70,229,0.08)', fill: true }] }, options: { responsive:true, maintainAspectRatio:true } });

    // Category pie
    const catLabels = data.byCategory.map(x=>x.category);
    const catValues = data.byCategory.map(x=>x.cnt);
    const catCtx = document.getElementById('catChart').getContext('2d');
    new Chart(catCtx, { type: 'pie', data: { labels: catLabels, datasets:[{ data: catValues, backgroundColor: ['#1f77b4','#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b'] }] }, options:{ responsive:true, maintainAspectRatio:true } });

    // Status bar
    const stLabels = data.byStatus.map(x=>x.status);
    const stValues = data.byStatus.map(x=>x.cnt);
    const stCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(stCtx, { type:'bar', data:{ labels:stLabels, datasets:[{ label:'Tickets', data:stValues, backgroundColor:'#10b981' }] }, options:{ responsive:true, maintainAspectRatio:true, scales:{ y:{ beginAtZero:true } } } });
}
loadStats().catch(e=>console.error(e));
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
