<?php require __DIR__ . '/../layout/header.php'; ?>
<div id="dashboard-root" class="container mx-auto px-4 sm:px-6 lg:px-12 py-6 sm:py-8">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
        <h1 class="text-2xl font-bold">Dashboard de Datos</h1>
        <div>
            <a href="?route=dashboard" class="inline-block px-3 py-2 bg-slate-100 rounded hover:bg-slate-200 transition">Volver</a>
                <button id="printBtn" class="inline-block px-3 py-2 bg-indigo-600 text-white rounded ml-2 hover:bg-indigo-700 transition">Imprimir</button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-1 lg:col-span-2 bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2 text-gray-700">Tickets en últimos 30 días</h3>
            <div class="relative w-full h-64 sm:h-72">
                <canvas id="tsChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-2 text-gray-700">Distribución por categoría</h3>
            <div class="relative w-full h-64 sm:h-72 flex justify-center">
                <canvas id="catChart"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2 text-gray-700">Resumen por estado</h3>
        <div class="relative w-full h-56 sm:h-64">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
async function loadStats() {
    try {
        const res = await fetch('?route=ticket_stats_data');
        if (!res.ok) throw new Error('Error fetching stats');
        const data = await res.json();
        
        document.getElementById('stat-total').textContent = data.total || 0;
        document.getElementById('stat-cats').textContent = data.byCategory?.length || 0;
        document.getElementById('stat-status').textContent = data.byStatus?.reduce((s,i) => s + i.cnt, 0) || 0;
        document.getElementById('stat-prio').textContent = data.byPriority?.length || 0;

        // Opciones base para que no se distorsionen
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false, // ¡Clave para evitar la distorsión!
        };

        // Timeseries chart (Líneas)
        const labels = [];
        const points = [];
        const dmap = {};
        (data.timeseries || []).forEach(r => { dmap[r.d] = parseInt(r.cnt); });
        
        const now = new Date();
        for (let i = 29; i >= 0; i--) {
            const d = new Date(now.getFullYear(), now.getMonth(), now.getDate() - i);
            const key = d.toISOString().slice(0, 10);
            labels.push(key);
            points.push(dmap[key] || 0);
        }
        const tsCtx = document.getElementById('tsChart').getContext('2d');
        new Chart(tsCtx, { 
            type: 'line', 
            data: { 
                labels, 
                datasets: [{ 
                    label: 'Tickets', 
                    data: points, 
                    borderColor: '#4F46E5', 
                    backgroundColor: 'rgba(79,70,229,0.08)', 
                    fill: true,
                    tension: 0.3 // Opcional: suaviza la línea
                }] 
            }, 
            options: commonOptions 
        });

        // Category pie (Pastel)
        const catLabels = (data.byCategory || []).map(x => x.category);
        const catValues = (data.byCategory || []).map(x => x.cnt);
        const catCtx = document.getElementById('catChart').getContext('2d');
        new Chart(catCtx, { 
            type: 'pie', 
            data: { 
                labels: catLabels, 
                datasets: [{ 
                    data: catValues, 
                    backgroundColor: ['#1f77b4','#ff7f0e','#2ca02c','#d62728','#9467bd','#8c564b'] 
                }] 
            }, 
            options: {
                ...commonOptions,
                plugins: { legend: { position: 'bottom' } } // Opcional: mejora el espacio
            }
        });

        // Status bar (Barras)
        // Status bar (Barras)
    const stLabels = (data.byStatus || []).map(x => x.status);
    const stValues = (data.byStatus || []).map(x => x.cnt);

    // Generar colores dinámicos según el nombre del estado
    const stColors = stLabels.map(status => {
      const s = status.toLowerCase();
      if (s.includes('Ejecutado')) return '#9ca3af'; 
      if (s.includes('pendiente')) return '#f59e0b'; 
      if (s.includes('proceso')) return '#3b82f6';   
      return '#10b981'; 
    });

    const stCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(stCtx, { 
      type: 'bar', 
      data: { 
        labels: stLabels, 
        datasets: [{ 
          label: 'Tickets', 
          data: stValues, 
          backgroundColor: stColors, 
          borderRadius: 4 
        }] 
      }, 
      options: { 
        ...commonOptions,
        scales: { 
          y: { beginAtZero: true } 
        },
        plugins: {
          legend: { display: false } 
        }
      } 
    });

    } catch (e) {
        console.error('Error cargando estadísticas:', e);
        alert('No se pudieron cargar las estadísticas. Intente recargar la página.');
    }
}

loadStats();
</script>

<script>
function printDashboard() {
    const root = document.getElementById('dashboard-root');
    if (!root) return alert('No se encontró el área para imprimir');

    // Clonar y reemplazar canvases por imágenes PNG (preserva gráficos)
    const clone = root.cloneNode(true);
    const canvases = root.querySelectorAll('canvas');
    canvases.forEach(c => {
        try {
            const id = c.id;
            const dataUrl = c.toDataURL('image/png');
            const img = document.createElement('img');
            img.src = dataUrl;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            const target = clone.querySelector('#' + id);
            if (target && target.parentNode) target.parentNode.replaceChild(img, target);
        } catch (e) {
            // canvas may be tainted if coming from other origin; ignore
            console.warn('No se pudo renderizar canvas a imagen', e);
        }
    });

    const w = window.open('', '_blank', 'width=1200,height=900');
    w.document.write('<!doctype html><html><head><meta charset="utf-8"><title>Imprimir - Dashboard</title>');
    w.document.write('<meta name="viewport" content="width=device-width,initial-scale=1">');
    w.document.write('<link rel="stylesheet" href="https://cdn.tailwindcss.com">');
    w.document.write('</head><body class="bg-white">');
    w.document.write(clone.innerHTML);
    w.document.write('</body></html>');
    w.document.close();
    w.focus();
    setTimeout(() => { w.print(); }, 600);
}

document.getElementById('printBtn').addEventListener('click', printDashboard);
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>