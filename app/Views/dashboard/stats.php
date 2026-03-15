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
    const getText = (id) => document.getElementById(id)?.textContent?.trim() || '0';
    const getCanvasImage = (id) => {
        const canvas = document.getElementById(id);
        if (!canvas) return '';
        try {
            return canvas.toDataURL('image/png');
        } catch (e) {
            console.warn('No se pudo renderizar el gráfico para imprimir:', id, e);
            return '';
        }
    };

    const stats = {
        total: getText('stat-total'),
        cats: getText('stat-cats'),
        status: getText('stat-status'),
        prio: getText('stat-prio')
    };

    const tsChart = getCanvasImage('tsChart');
    const catChart = getCanvasImage('catChart');
    const statusChart = getCanvasImage('statusChart');

    if (!tsChart && !catChart && !statusChart) {
        alert('No hay gráficos listos para imprimir. Espere unos segundos e inténtelo de nuevo.');
        return;
    }

    const printDate = new Date().toLocaleString('es-DO');
    const chartTemplate = (title, image, heightClass) => `
        <section class="panel">
            <h2>${title}</h2>
            <div class="chart ${heightClass}">
                ${image ? `<img src="${image}" alt="${title}">` : '<div class="empty">Sin datos</div>'}
            </div>
        </section>
    `;

    const html = `
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Imprimir - Dashboard</title>
    <style>
        @page { size: A4 landscape; margin: 8mm; }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            color: #0f172a;
            background: #ffffff;
        }
        .sheet {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 6px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            line-height: 1.1;
            color: #1e293b;
        }
        .header .date {
            font-size: 11px;
            color: #475569;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
        }
        .stat {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 7px;
            text-align: center;
        }
        .stat .label {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 2px;
        }
        .stat .value {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.1;
        }
        .row-main {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 8px;
        }
        .panel {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 8px;
            break-inside: avoid;
        }
        .panel h2 {
            margin: 0 0 5px 0;
            font-size: 13px;
            color: #334155;
            font-weight: 600;
        }
        .chart {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .chart-lg { height: 190px; }
        .chart-md { height: 190px; }
        .chart-sm { height: 150px; }
        .chart img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .empty {
            font-size: 12px;
            color: #94a3b8;
        }
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="sheet">
        <header class="header">
            <h1>Dashboard de Datos</h1>
            <div class="date">Generado: ${printDate}</div>
        </header>

        <section class="stats">
            <article class="stat">
                <div class="label">Total tickets</div>
                <div class="value">${stats.total}</div>
            </article>
            <article class="stat">
                <div class="label">Categorías</div>
                <div class="value">${stats.cats}</div>
            </article>
            <article class="stat">
                <div class="label">Estados</div>
                <div class="value">${stats.status}</div>
            </article>
            <article class="stat">
                <div class="label">Prioridades</div>
                <div class="value">${stats.prio}</div>
            </article>
        </section>

        <section class="row-main">
            ${chartTemplate('Tickets en últimos 30 días', tsChart, 'chart-lg')}
            ${chartTemplate('Distribución por categoría', catChart, 'chart-md')}
        </section>

        ${chartTemplate('Resumen por estado', statusChart, 'chart-sm')}
    </div>
</body>
</html>`;

    const w = window.open('', '_blank', 'width=1200,height=900');
    if (!w) {
        alert('El navegador bloqueó la ventana de impresión. Permita ventanas emergentes e intente nuevamente.');
        return;
    }

    w.document.open();
    w.document.write(html);
    w.document.close();
    w.focus();

    setTimeout(() => {
        w.print();
    }, 450);
}

document.getElementById('printBtn').addEventListener('click', printDashboard);
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>