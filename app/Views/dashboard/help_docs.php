<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mx-auto px-4 py-12 max-w-5xl relative z-10">
    
    <!-- Contenedor Principal con Glassmorphism -->
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/40 p-6 md:p-10 lg:p-12">
        
        <!-- Encabezado -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-50 to-blue-100 flex items-center justify-center text-[#010b50] shadow-sm border border-indigo-100/50">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Manual de Escalamiento</h1>
                    <p class="mt-2 text-sm md:text-base text-slate-500 font-medium">Guía rápida y procedimiento operativo estandarizado para la gestión de incidentes.</p>
                </div>
            </div>
            
            <!-- Botones de Acción Superiores -->
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                <a href="?route=dashboard" class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 bg-white border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#010b50] transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver al tablero
                </a>
                <a href="?route=ticket_report" class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 bg-[#010b50] text-sm font-bold text-white hover:bg-blue-900 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Generar reporte
                </a>
            </div>
        </div>

        <!-- Línea de tiempo (Stepper) -->
        <div class="relative border-l-2 border-indigo-100 ml-4 md:ml-8 space-y-12 pb-8">
            
            <!-- Paso 1 -->
            <div class="relative">
                <div class="absolute -left-[17px] top-1 bg-white w-8 h-8 rounded-full border-4 border-indigo-100 flex items-center justify-center shadow-sm">
                    <span class="w-3 h-3 bg-[#010b50] rounded-full"></span>
                </div>
                <div class="ml-10 md:ml-12">
                    <h2 class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 font-black">1.</span> Clasificación inicial
                    </h2>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Verifica la <strong>prioridad</strong> y el nivel de impacto en la continuidad del servicio.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Revisa detalladamente la descripción y los archivos adjuntos proporcionados en el ticket.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Intenta reproducir el incidente reportado en un entorno controlado.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Paso 2 -->
            <div class="relative">
                <div class="absolute -left-[17px] top-1 bg-white w-8 h-8 rounded-full border-4 border-indigo-100 flex items-center justify-center shadow-sm">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                </div>
                <div class="ml-10 md:ml-12">
                    <h2 class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600 font-black">2.</span> Resolución en Primer Nivel (N1)
                    </h2>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <span>Aplica las comprobaciones técnicas y pasos estándar definidos en el check-list del área.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <span>Documenta cada acción realizada, por mínima que sea, en la bitácora del ticket.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700 bg-amber-50 p-3 rounded-xl border border-amber-100 mt-2">
                                <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-medium text-amber-900">Regla de tiempo: Si no hay avances en la resolución durante <strong class="text-amber-700">30 minutos</strong> (o según el SLA del servicio), procede inmediatamente al escalamiento.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Paso 3 -->
            <div class="relative">
                <div class="absolute -left-[17px] top-1 bg-white w-8 h-8 rounded-full border-4 border-indigo-100 flex items-center justify-center shadow-sm">
                    <span class="w-3 h-3 bg-fuchsia-500 rounded-full"></span>
                </div>
                <div class="ml-10 md:ml-12">
                    <h2 class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                        <span class="text-fuchsia-600 font-black">3.</span> Escalamiento a Nivel 2 (N2)
                    </h2>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-slate-200 text-slate-600 text-xs font-bold shrink-0 mt-0.5">A</span>
                                <span>Contacta al supervisor de Nivel 2 vía Slack o teléfono corporativo y comparte el ID único del ticket.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-slate-200 text-slate-600 text-xs font-bold shrink-0 mt-0.5">B</span>
                                <span>El reporte debe incluir de forma estructurada: síntomas principales, pasos ya realizados, registros (logs) relevantes y capturas de pantalla.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-slate-200 text-slate-600 text-xs font-bold shrink-0 mt-0.5">C</span>
                                <span>Reasigna el ticket al rol <code class="bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-mono text-xs">Soporte</code> o <code class="bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-mono text-xs">Gerente</code> y actualiza el estado a <strong>"En proceso"</strong>.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Paso 4 -->
            <div class="relative">
                <div class="absolute -left-[17px] top-1 bg-white w-8 h-8 rounded-full border-4 border-indigo-100 flex items-center justify-center shadow-sm">
                    <span class="w-3 h-3 bg-rose-500 rounded-full"></span>
                </div>
                <div class="ml-10 md:ml-12">
                    <h2 class="text-xl font-extrabold text-slate-800 mb-3 flex items-center gap-2">
                        <span class="text-rose-600 font-black">4.</span> Escalamiento a Nivel 3 / Proveedor Externo
                    </h2>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 shadow-sm">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>Consolida toda la evidencia recopilada y solicita la aprobación del Gerente Operativo si el escalamiento implica costos o accesos críticos.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>Escala al equipo de soporte avanzado (N3) o levanta un ticket en el portal del proveedor externo adjuntando el dossier completo del incidente.</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-slate-700">
                                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>Mantén comunicación constante con el usuario solicitante y actualiza la plataforma BDT con los Tiempos Estimados de Resolución (ETA).</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Contactos -->
        <div class="mt-16 pt-10 border-t border-slate-200">
            <h2 class="text-xl font-extrabold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Directorio Rápido de Apoyo
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Tarjeta Contacto 1 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-1 shadow-sm transition-shadow hover:shadow-md">
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-1">Soporte Nivel 2</span>
                    <a href="mailto:soporte@empresa.local" class="text-sm font-semibold text-slate-800 hover:text-indigo-600 truncate">soporte@empresa.local</a>
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Ext. 1234
                    </div>
                </div>

                <!-- Tarjeta Contacto 2 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-1 shadow-sm transition-shadow hover:shadow-md">
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Gerente de Operaciones</span>
                    <a href="mailto:gerente@empresa.local" class="text-sm font-semibold text-slate-800 hover:text-blue-600 truncate">gerente@empresa.local</a>
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Ext. 1001
                    </div>
                </div>

                <!-- Tarjeta Contacto 3 -->
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col gap-1 shadow-sm transition-shadow hover:shadow-md">
                    <span class="text-xs font-bold text-rose-600 uppercase tracking-wider mb-1">Proveedor Cloud</span>
                    <a href="mailto:proveedor@cloud.example" class="text-sm font-semibold text-slate-800 hover:text-rose-600 truncate">proveedor@cloud.example</a>
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        Soporte B2B
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>