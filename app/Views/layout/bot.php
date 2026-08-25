<?php
/**
 * Widget flotante del asistente de preguntas frecuentes.
 * Se incluye desde layout/footer.php, por lo que está disponible en todo el sistema.
 */
$botLogueado = isset($_SESSION['user_id']);
$botRol = $_SESSION['role'] ?? '';
$botSugerencias = array_slice(\App\Models\Faq::disponibles($botLogueado, $botRol), 0, 5);
?>

<!-- Asistente de preguntas frecuentes -->
<div id="faq-bot" class="fixed bottom-5 right-5 z-[80] font-sans print:hidden">

    <!-- Panel de conversación -->
    <section id="faq-bot-panel"
             class="hidden absolute bottom-[4.5rem] right-0 w-[min(23rem,calc(100vw-2.5rem))] origin-bottom-right overflow-hidden rounded-3xl border border-slate-200/80 bg-white/95 shadow-[0_20px_60px_-15px_rgba(15,23,42,0.25)] backdrop-blur-xl"
             role="dialog" aria-modal="false" aria-labelledby="faq-bot-title">

        <header class="flex items-center gap-3 bg-[#010b50] px-4 py-3.5 text-white">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.83L3 20l1.29-3.44A7.96 7.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h2 id="faq-bot-title" class="text-sm font-bold leading-tight">Asistente BDT</h2>
                <p class="flex items-center gap-1.5 text-[11px] text-indigo-100/90">
                    <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span>
                    Preguntas frecuentes
                </p>
            </div>
            <button type="button" id="faq-bot-close"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-indigo-100 transition hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40"
                    aria-label="Cerrar asistente">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </header>

        <!-- Historial -->
        <div id="faq-bot-log" class="h-[19rem] space-y-3 overflow-y-auto bg-slate-50/60 px-4 py-4" role="log" aria-live="polite" aria-atomic="false">
            <div class="flex justify-start">
                <div class="max-w-[85%] rounded-2xl rounded-tl-sm border border-slate-200 bg-white px-3.5 py-2.5 text-[13px] leading-relaxed text-slate-700 shadow-sm">
                    <?= $botLogueado
                        ? 'Hola. Soy el asistente del sistema de incidencias. Pregúntame sobre tickets, estados, asignaciones o reportes.'
                        : 'Hola. Soy el asistente del sistema de incidencias. Pregúntame sobre accesos, contraseñas o cómo contactar con soporte.' ?>
                </div>
            </div>
        </div>

        <!-- Sugerencias rápidas -->
        <div id="faq-bot-chips" class="flex flex-wrap gap-1.5 border-t border-slate-100 bg-white px-4 py-3">
            <?php foreach ($botSugerencias as $botFaq): ?>
                <button type="button"
                        class="faq-bot-chip rounded-full border border-indigo-100 bg-indigo-50/70 px-3 py-1.5 text-[11px] font-medium text-indigo-700 transition hover:border-indigo-300 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                        data-pregunta="<?= htmlspecialchars($botFaq['pregunta'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($botFaq['pregunta'], ENT_QUOTES, 'UTF-8') ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Entrada -->
        <form id="faq-bot-form" class="flex items-center gap-2 border-t border-slate-100 bg-white px-4 py-3">
            <label class="sr-only" for="faq-bot-input">Escribe tu pregunta</label>
            <input id="faq-bot-input" name="q" type="text" autocomplete="off" maxlength="300"
                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-[13px] placeholder-slate-400 transition-colors focus:border-transparent focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#010b50]/30"
                   placeholder="Escribe tu pregunta…"/>
            <button type="submit"
                    class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#010b50] text-white shadow-md shadow-blue-900/20 transition hover:bg-[#0b1f7a] focus:outline-none focus:ring-2 focus:ring-[#010b50]/40 active:scale-95 disabled:opacity-50"
                    aria-label="Enviar pregunta">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </button>
        </form>
    </section>

    <!-- Botón flotante -->
    <button type="button" id="faq-bot-toggle"
            class="group inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#010b50] text-white shadow-lg shadow-blue-900/30 transition hover:bg-[#0b1f7a] hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-500/25 active:scale-95"
            aria-expanded="false" aria-controls="faq-bot-panel" aria-label="Abrir asistente de preguntas frecuentes">
        <svg id="faq-bot-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <svg id="faq-bot-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>

<script>
(function () {
    const bot = document.getElementById('faq-bot');
    if (!bot) return;

    const panel = document.getElementById('faq-bot-panel');
    const toggle = document.getElementById('faq-bot-toggle');
    const cerrar = document.getElementById('faq-bot-close');
    const iconoAbrir = document.getElementById('faq-bot-icon-open');
    const iconoCerrar = document.getElementById('faq-bot-icon-close');
    const log = document.getElementById('faq-bot-log');
    const form = document.getElementById('faq-bot-form');
    const input = document.getElementById('faq-bot-input');
    const chips = document.getElementById('faq-bot-chips');
    let ocupado = false;

    function abrirPanel(abrir) {
        panel.classList.toggle('hidden', !abrir);
        iconoAbrir.classList.toggle('hidden', abrir);
        iconoCerrar.classList.toggle('hidden', !abrir);
        toggle.setAttribute('aria-expanded', String(abrir));
        toggle.setAttribute('aria-label', abrir ? 'Cerrar asistente de preguntas frecuentes' : 'Abrir asistente de preguntas frecuentes');
        if (abrir) input.focus();
    }

    function scrollFinal() {
        log.scrollTop = log.scrollHeight;
    }

    function burbujaUsuario(texto) {
        const fila = document.createElement('div');
        fila.className = 'flex justify-end';
        const burbuja = document.createElement('div');
        burbuja.className = 'max-w-[85%] rounded-2xl rounded-tr-sm bg-[#010b50] px-3.5 py-2.5 text-[13px] leading-relaxed text-white shadow-sm';
        burbuja.textContent = texto;
        fila.appendChild(burbuja);
        log.appendChild(fila);
        scrollFinal();
    }

    function burbujaBot() {
        const fila = document.createElement('div');
        fila.className = 'flex justify-start';
        const burbuja = document.createElement('div');
        burbuja.className = 'max-w-[85%] rounded-2xl rounded-tl-sm border border-slate-200 bg-white px-3.5 py-2.5 text-[13px] leading-relaxed text-slate-700 shadow-sm';
        fila.appendChild(burbuja);
        log.appendChild(fila);
        scrollFinal();
        return burbuja;
    }

    function mostrarEscribiendo() {
        const burbuja = burbujaBot();
        burbuja.innerHTML = '<span class="inline-flex gap-1 py-1" aria-label="Escribiendo">'
            + '<span class="h-1.5 w-1.5 animate-bounce rounded-full bg-slate-400"></span>'
            + '<span class="h-1.5 w-1.5 animate-bounce rounded-full bg-slate-400" style="animation-delay:.15s"></span>'
            + '<span class="h-1.5 w-1.5 animate-bounce rounded-full bg-slate-400" style="animation-delay:.3s"></span>'
            + '</span>';
        return burbuja.parentElement;
    }

    // Pinta la respuesta: texto en párrafos + enlace opcional + sugerencias.
    function pintarRespuesta(datos) {
        const burbuja = burbujaBot();

        if (datos.pregunta) {
            const titulo = document.createElement('p');
            titulo.className = 'mb-1.5 text-[11px] font-bold uppercase tracking-wide text-indigo-600';
            titulo.textContent = datos.pregunta;
            burbuja.appendChild(titulo);
        }

        String(datos.respuesta || '').split('\n').forEach(function (linea, i) {
            if (!linea.trim()) return;
            const p = document.createElement('p');
            if (i > 0) p.className = 'mt-1.5';
            p.textContent = linea;
            burbuja.appendChild(p);
        });

        if (datos.enlace && datos.enlace.ruta) {
            const a = document.createElement('a');
            a.href = datos.enlace.ruta;
            a.className = 'mt-2.5 inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-[12px] font-semibold text-indigo-700 transition hover:bg-indigo-100';
            a.textContent = datos.enlace.texto || 'Abrir';
            burbuja.appendChild(a);
        }

        if (Array.isArray(datos.sugerencias) && datos.sugerencias.length) {
            const cont = document.createElement('div');
            cont.className = 'mt-3 border-t border-slate-100 pt-2';
            const rotulo = document.createElement('p');
            rotulo.className = 'mb-1.5 text-[11px] font-medium text-slate-400';
            rotulo.textContent = datos.encontrado ? 'También puede interesarte:' : 'Prueba con:';
            cont.appendChild(rotulo);

            datos.sugerencias.forEach(function (s) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'faq-bot-chip mb-1 mr-1 rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-[11px] font-medium text-slate-600 transition hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700';
                btn.dataset.pregunta = s.pregunta;
                btn.textContent = s.pregunta;
                cont.appendChild(btn);
            });
            burbuja.appendChild(cont);
        }

        scrollFinal();
    }

    async function preguntar(texto) {
        if (ocupado) return;
        const consulta = texto.trim();
        if (!consulta) return;

        ocupado = true;
        input.value = '';
        burbujaUsuario(consulta);
        const escribiendo = mostrarEscribiendo();

        try {
            const cuerpo = new URLSearchParams();
            cuerpo.append('q', consulta);

            const respuesta = await fetch('index.php?route=bot_ask', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
                body: cuerpo.toString(),
                credentials: 'same-origin'
            });

            if (!respuesta.ok) throw new Error('HTTP ' + respuesta.status);
            const datos = await respuesta.json();
            escribiendo.remove();
            pintarRespuesta(datos);
        } catch (e) {
            escribiendo.remove();
            pintarRespuesta({
                encontrado: false,
                respuesta: 'No pude conectar con el asistente. Intenta nuevamente o escribe al Centro de Ayuda.',
                enlace: { texto: 'Ir al Centro de Ayuda', ruta: '?route=help' }
            });
        } finally {
            ocupado = false;
            input.focus();
        }
    }

    toggle.addEventListener('click', function () {
        abrirPanel(panel.classList.contains('hidden'));
    });

    cerrar.addEventListener('click', function () {
        abrirPanel(false);
        toggle.focus();
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        preguntar(input.value);
    });

    // Delegación: chips iniciales y los que llegan con cada respuesta.
    bot.addEventListener('click', function (e) {
        const chip = e.target.closest('.faq-bot-chip');
        if (chip) preguntar(chip.dataset.pregunta || chip.textContent);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !panel.classList.contains('hidden')) {
            abrirPanel(false);
            toggle.focus();
        }
    });

    // Cierra el panel al hacer clic fuera del widget.
    document.addEventListener('click', function (e) {
        if (panel.classList.contains('hidden')) return;
        if (bot.contains(e.target)) return;
        abrirPanel(false);
    });

    // Oculta las sugerencias iniciales tras la primera consulta.
    form.addEventListener('submit', function () { chips.classList.add('hidden'); });
    chips.addEventListener('click', function () { chips.classList.add('hidden'); });
})();
</script>
