<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="bg-white/90 rounded-2xl border border-slate-200 p-8 shadow-sm">
        <h1 class="text-2xl font-black text-slate-900 mb-4">Manual de Escalamiento</h1>
        <p class="text-sm text-slate-600 mb-6">Guía rápida para escalar incidentes siguiendo el procedimiento operativo.</p>

        <section class="mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-2">1. Clasificación inicial</h2>
            <ol class="list-decimal list-inside text-sm text-slate-700 space-y-2">
                <li>Verifica la prioridad y el impacto en el servicio.</li>
                <li>Revisa la descripción y adjuntos en el ticket.</li>
                <li>Intenta reproducir el incidente en un entorno controlado.</li>
            </ol>
        </section>

        <section class="mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-2">2. Resolución en primer nivel</h2>
            <ol class="list-decimal list-inside text-sm text-slate-700 space-y-2">
                <li>Aplica las comprobaciones y pasos estándar del check-list.</li>
                <li>Documenta cada acción en la bitácora del ticket.</li>
                <li>Si no hay avance en 30 minutos (o según SLA), proceder a escalamiento.</li>
            </ol>
        </section>

        <section class="mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-2">3. Escalamiento a Nivel 2</h2>
            <ol class="list-decimal list-inside text-sm text-slate-700 space-y-2">
                <li>Contacta al supervisor de nivel 2 via Slack/telefono y comparte el ID del ticket.</li>
                <li>Incluye: síntomas, pasos realizados, registros relevantes y captura de pantallas.</li>
                <li>Asigna el ticket a `Soporte` o `Gerente` según proceda y actualizar estado a "En proceso".</li>
            </ol>
        </section>

        <section class="mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-2">4. Escalamiento a Nivel 3 / Proveedor</h2>
            <ol class="list-decimal list-inside text-sm text-slate-700 space-y-2">
                <li>Documenta la evidencia recopilada y solicita la aprobación del gerente si es necesario.</li>
                <li>Escala a soporte avanzado o proveedor externo con el dossier del incidente.</li>
                <li>Mantén comunicación constante con el solicitante y actualiza el ticket con tiempos estimados.</li>
            </ol>
        </section>

        <section class="mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-2">Contactos y recursos</h2>
            <ul class="text-sm text-slate-700 space-y-1">
                <li><strong>Soporte Nivel 2:</strong> soporte@empresa.local / Ext. 1234</li>
                <li><strong>Gerente Operaciones:</strong> gerente@empresa.local / Ext. 1001</li>
                <li><strong>Proveedor Cloud:</strong> proveedor@cloud.example</li>
            </ul>
        </section>

        <div class="mt-6 flex gap-2">
            <a href="?route=dashboard" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 bg-slate-100 text-sm font-semibold text-slate-800 hover:bg-slate-200">Volver al tablero</a>
            <a href="?route=ticket_report" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-700">Generar reporte</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
