<?php
$today = new DateTimeImmutable('today');
$defaultToDate = $today->format('Y-m-d');
$defaultFromDate = $today->modify('-29 days')->format('Y-m-d');

$fromDate = trim((string)($_GET['from_date'] ?? $defaultFromDate));
$toDate = trim((string)($_GET['to_date'] ?? $defaultToDate));

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fromDate)) {
    $fromDate = $defaultFromDate;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $toDate)) {
    $toDate = $defaultToDate;
}

if ($fromDate > $toDate) {
    $tmp = $fromDate;
    $fromDate = $toDate;
    $toDate = $tmp;
}

// Formatear etiquetas de fecha en español para mostrar en el título
function formatSpanDate(string $d): string {
    $months = ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
    try {
        $dt = new DateTimeImmutable($d);
        $day = $dt->format('j');
        $month = $months[(int)$dt->format('n') - 1];
        $year = $dt->format('Y');
        return "$day $month $year";
    } catch (Exception $e) {
        return $d;
    }
}

$rangeTitle = 'Del ' . formatSpanDate($fromDate) . ' al ' . formatSpanDate($toDate);
?>
<?php require __DIR__ . '/../layout/header.php'; ?>

<style>
    .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.05);
    }
    
    .metric-icon-box {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
    }
</style>

<div id="dashboard-root" class="container mx-auto px-4 lg:px-8 py-8 w-full max-w-7xl relative overflow-hidden min-h-[calc(100vh-100px)]">

    <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 mt-4 md:mt-0">
        <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm border border-indigo-100 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Dashboard Analítico</h1>
                <div class="text-sm text-slate-500 mt-1">Resumen en tiempo real del rendimiento operativo.</div>
                <div class="text-sm font-medium text-slate-600 mt-2"><?= htmlspecialchars($rangeTitle) ?></div>
            </div>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="?route=dashboard" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 rounded-xl bg-white border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
            <button id="printBtn" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 rounded-xl bg-[#010b50] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-900/20 transition hover:bg-blue-900 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-900/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimir Reporte
            </button>
        </div>
    </div>

    <div class="relative z-10 mb-6 glass-panel p-4 sm:p-5 rounded-2xl">
        <form method="get" action="" class="grid grid-cols-1 gap-4 md:grid-cols-[1fr_1fr_auto_auto] md:items-end">
            <input type="hidden" name="route" value="ticket_stats">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Desde</label>
                <input id="fromDate" type="date" name="from_date" value="<?= htmlspecialchars($fromDate) ?>" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 cursor-pointer">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Hasta</label>
                <input id="toDate" type="date" name="to_date" value="<?= htmlspecialchars($toDate) ?>" class="input-modern block w-full rounded-xl py-3 px-4 text-sm text-slate-700 cursor-pointer">
            </div>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-[#010b50] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-900/20 transition hover:bg-blue-900 hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-[#010b50]/20">
                Aplicar rango
            </button>
            <a href="?route=ticket_stats" class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                Restablecer
            </a>
        </form>
    </div>

    <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl metric-icon-box text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Tickets</div>
                <div id="stat-total" class="text-3xl font-black text-slate-800 leading-none">...</div>
                <div id="growth-total" class="text-sm mt-1 text-slate-500">—</div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Categorías</div>
                <div id="stat-cats" class="text-3xl font-black text-slate-800 leading-none">...</div>
                <div id="growth-cats" class="text-sm mt-1 text-slate-500">—</div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Estados</div>
                <div id="stat-status" class="text-3xl font-black text-slate-800 leading-none">...</div>
                <div id="growth-status" class="text-sm mt-1 text-slate-500">—</div>
            </div>
        </div>

        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Prioridades</div>
                <div id="stat-prio" class="text-3xl font-black text-slate-800 leading-none">...</div>
                <div id="growth-prio" class="text-sm mt-1 text-slate-500">—</div>
            </div>
        </div>
    </div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="col-span-1 lg:col-span-2 glass-panel p-6 sm:p-8 rounded-3xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Volumen de Tickets</h3>
                <span id="rangeBadge" class="text-xs font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full"></span>
            </div>
            <div class="relative w-full h-64 sm:h-72">
                <canvas id="tsChart"></canvas>
            </div>
        </div>
        
        <div class="glass-panel p-6 sm:p-8 rounded-3xl">
            <h3 class="text-lg font-bold text-slate-800 mb-6 text-center">Distribución por Categoría</h3>
            <div class="relative w-full h-64 sm:h-72 flex justify-center">
                <canvas id="catChart"></canvas>
            </div>
        </div>
    </div>

    <div class="relative z-10 glass-panel p-6 sm:p-8 rounded-3xl mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-6">Resumen por Estado Operativo</h3>
        <div class="relative w-full h-56 sm:h-64">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.font.family = "'Roboto', 'Segoe UI', 'Helvetica Neue', Arial, sans-serif";
Chart.defaults.color = '#64748b';

// Animación de conteo para KPIs
function animateCount(el, endValue, duration = 800) {
    if (!el) return;
    const startText = (el.textContent || '').replace(/[^0-9\-]/g, '');
    const start = Number(startText) || 0;
    const change = Number(endValue) - start;
    const startTime = performance.now();
    const easeOutCubic = t => 1 - Math.pow(1 - t, 3);

    function step(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const val = Math.round(start + change * easeOutCubic(progress));
        el.textContent = val.toLocaleString('es-ES');
        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
}

const fromDateInput = document.getElementById('fromDate');
const toDateInput = document.getElementById('toDate');
const rangeBadge = document.getElementById('rangeBadge');

function formatDateRangeLabel(value) {
    const date = new Date(`${value}T00:00:00`);
    if (Number.isNaN(date.getTime())) {
        return value;
    }

    return date.toLocaleDateString('es-ES', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });
}

function updateRangeBadge() {
    if (!rangeBadge) {
        return;
    }

    const fromLabel = formatDateRangeLabel(fromDateInput.value);
    const toLabel = formatDateRangeLabel(toDateInput.value);
    rangeBadge.textContent = `Del ${fromLabel} al ${toLabel}`;
}

async function loadStats() {
    try {
        updateRangeBadge();

        const params = new URLSearchParams({
            from_date: fromDateInput.value,
            to_date: toDateInput.value
        });

        const res = await fetch(`?route=ticket_stats_data&${params.toString()}`);
        if (!res.ok) throw new Error('Error fetching stats');
        const data = await res.json();
        
        // Actualizar KPIs con conteo animado
        const totalVal = Number(data.total || 0);
        const catsVal = Number((data.byCategory || []).length || 0);
        const statusVal = Number((data.byStatus || []).reduce((s, i) => s + Number(i.cnt || 0), 0) || 0);
        const prioVal = Number((data.byPriority || []).length || 0);

        animateCount(document.getElementById('stat-total'), totalVal);
        animateCount(document.getElementById('stat-cats'), catsVal);
        animateCount(document.getElementById('stat-status'), statusVal);
        animateCount(document.getElementById('stat-prio'), prioVal);

        // Mostrar indicadores de crecimiento porcentual por mes
        function renderGrowthBadge(elId, pct) {
            const el = document.getElementById(elId);
            if (!el) return;
            if (pct === null || pct === undefined || Number.isNaN(Number(pct))) {
                el.textContent = '—';
                el.className = 'text-sm mt-1 text-slate-500';
                return;
            }

            const n = Number(pct);
            const sign = n > 0 ? '+' : (n < 0 ? '' : '');
            const arrow = n > 0 ? '▲' : (n < 0 ? '▼' : '–');
            el.textContent = `${sign}${n.toFixed(1)}% ${arrow}`;
            el.className = n > 0 ? 'text-sm mt-1 text-emerald-600' : (n < 0 ? 'text-sm mt-1 text-rose-600' : 'text-sm mt-1 text-slate-500');
        }

        const mg = data.monthlyGrowth || {};
        renderGrowthBadge('growth-total', mg.total?.pct);
        // For categories/priorities/status we may not have detailed pct in payload; use total fallback
        renderGrowthBadge('growth-cats', mg.byCategory && mg.byCategory.length ? mg.byCategory.reduce((s,i)=>s+Number(i.pct||0),0)/mg.byCategory.length : null);
        renderGrowthBadge('growth-status', mg.total?.pct);
        renderGrowthBadge('growth-prio', mg.total?.pct);

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: true
                }
            }
        };

        // 1. Timeseries chart (Líneas)
        const dmap = {};
        (data.timeseries || []).forEach(r => { dmap[r.d] = parseInt(r.cnt); });

        // Construir labels/points respetando el rango seleccionado
        let labels = [];
        let points = [];

        let startDate = new Date(`${fromDateInput.value}T00:00:00`);
        let endDate = new Date(`${toDateInput.value}T00:00:00`);
        if (Number.isNaN(startDate.getTime()) || Number.isNaN(endDate.getTime()) || startDate > endDate) {
            endDate = new Date();
            startDate = new Date();
            startDate.setDate(endDate.getDate() - 29);
        }

        const dayCount = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;

        // Si el rango es muy grande, agregar por mes para no saturar el gráfico
        if (dayCount > 90) {
            const m = new Date(startDate.getFullYear(), startDate.getMonth(), 1);
            while (m <= endDate) {
                const year = m.getFullYear();
                const month = m.getMonth() + 1;
                const label = m.toLocaleDateString('es-ES', { month: 'short', year: 'numeric' });
                labels.push(label);

                // sumar valores del mes
                let sum = 0;
                const daysInMonth = new Date(year, month, 0).getDate();
                for (let d = 1; d <= daysInMonth; d++) {
                    const dayStr = `${year}-${String(month).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                    const dt = new Date(`${dayStr}T00:00:00`);
                    if (dt < startDate || dt > endDate) continue;
                    sum += dmap[dayStr] || 0;
                }
                points.push(sum);
                m.setMonth(m.getMonth() + 1);
            }
        } else {
            const cur = new Date(startDate);
            while (cur <= endDate) {
                const key = cur.toISOString().slice(0, 10);
                labels.push(cur.toLocaleDateString('es-ES', { day: 'numeric', month: 'short' }));
                points.push(dmap[key] || 0);
                cur.setDate(cur.getDate() + 1);
            }
        }

        const tsCtx = document.getElementById('tsChart').getContext('2d');
        
        // Crear gradiente para la línea
        let gradient = tsCtx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.2)');
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

        new Chart(tsCtx, { 
            type: 'line', 
            data: { 
                labels, 
                datasets: [{ 
                    label: 'Tickets Creados', 
                    data: points, 
                    borderColor: '#4f46e5', 
                    backgroundColor: gradient, 
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    fill: true,
                    tension: 0.4
                }] 
            }, 
            options: {
                ...commonOptions,
                scales: {
                    x: { grid: { display: false }, ticks: { maxTicksLimit: 10 } },
                    y: { border: { display: false }, grid: { color: 'rgba(226, 232, 240, 0.6)' }, beginAtZero: true }
                },
                plugins: { legend: { display: false }, ...commonOptions.plugins }
            } 
        });

        // 2. Category pie (Pastel/Doughnut)
        const catLabels = (data.byCategory || []).map(x => x.category);
        const catValues = (data.byCategory || []).map(x => x.cnt);
        const catCtx = document.getElementById('catChart').getContext('2d');
        
        // Paleta de colores moderna
        const modernColors = ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#f43f5e', '#8b5cf6', '#06b6d4'];
        
        new Chart(catCtx, { 
            type: 'doughnut', 
            data: { 
                labels: catLabels, 
                datasets: [{ 
                    data: catValues, 
                    backgroundColor: modernColors,
                    borderWidth: 0,
                    hoverOffset: 4
                }] 
            }, 
            options: {
                ...commonOptions,
                cutout: '65%',
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 15, font: { size: 12 } }
                    },
                    ...commonOptions.plugins
                }
            }
        });

        // 3. Status bar (Barras)
        const stLabels = (data.byStatus || []).map(x => x.status);
        const stValues = (data.byStatus || []).map(x => x.cnt);

        const stColors = stLabels.map(status => {
            const s = status.toLowerCase();
            if (s.includes('ejecutad')) return '#10b981'; // Emerald
            if (s.includes('pendiente')) return '#f59e0b'; // Amber
            if (s.includes('proceso')) return '#3b82f6'; // Blue 
            return '#64748b'; // Slate
        });

        const stCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(stCtx, { 
            type: 'bar', 
            data: { 
                labels: stLabels, 
                datasets: [{ 
                    label: 'Volumen', 
                    data: stValues, 
                    backgroundColor: stColors, 
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: 40
                }] 
            }, 
            options: { 
                ...commonOptions,
                scales: { 
                    x: { grid: { display: false } },
                    y: { border: { display: false }, grid: { color: 'rgba(226, 232, 240, 0.6)' }, beginAtZero: true } 
                },
                plugins: {
                    legend: { display: false },
                    ...commonOptions.plugins
                }
            } 
        });

    } catch (e) {
        console.error('Error cargando estadísticas:', e);
        alert('No se pudieron cargar las estadísticas. Intente recargar la página.');
    }
}

loadStats();

// Lógica de Impresión (Mantenida intacta)
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

    const rangeLabel = rangeBadge?.textContent?.trim() || 'Rango seleccionado';

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
    <title>Imprimir - Dashboard Analítico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        @page { size: A4 landscape; margin: 8mm; }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Arial, sans-serif;
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
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #0f172a;
        }
        .header .date {
            font-size: 11px;
            color: #475569;
        }
        .header .range {
            margin-top: 2px;
            font-size: 11px;
            color: #64748b;
            text-align: right;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 8px;
        }
        .stat {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }
        .stat .label {
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
            margin-bottom: 4px;
        }
        .stat .value {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
        }
        .row-main {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 12px;
            margin-bottom: 8px;
        }
        .panel {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            break-inside: avoid;
        }
        .panel h2 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #334155;
        }
        .chart {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .chart-lg { height: 220px; }
        .chart-md { height: 220px; }
        .chart-sm { height: 180px; }
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
            <div>
                <h1>Reporte Analítico - BDT</h1>
                <div class="range">${rangeLabel}</div>
            </div>
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