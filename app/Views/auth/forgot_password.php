<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 z-10">
    <!-- Tarjeta Principal (Glassmorphism acorde al login) -->
    <div class="w-full max-w-md rounded-3xl border border-white/65 bg-white/60 p-8 shadow-2xl shadow-indigo-900/10 backdrop-blur-xl sm:p-10">
        
        <!-- Icono y Título -->
        <div class="text-center mb-8">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-100 to-blue-100 text-[#010b50] shadow-sm">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Recuperar contraseña</h2>
            <p class="mt-2 text-sm text-slate-600">Ingresa tu correo corporativo y te enviaremos las instrucciones para restablecer tu acceso.</p>
        </div>

        <!-- Mensajes de Alerta -->
        <?php if(isset($error)): ?>
            <div class="mb-6 flex items-center rounded-xl border border-red-200 bg-red-50 p-4" role="alert">
                <svg class="mr-3 h-5 w-5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <p class="text-sm font-medium text-red-700"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="mb-6 flex items-center rounded-xl border border-emerald-200 bg-emerald-50 p-4" role="alert">
                <svg class="mr-3 h-5 w-5 shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <p class="text-sm font-medium text-emerald-700"><?= htmlspecialchars($success) ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form id="recovery-form" class="space-y-6" action="?route=forgot_password" method="POST">
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">Correo corporativo</label>
                <div class="group relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400 transition-colors group-focus-within:text-[#010b50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="block w-full rounded-xl border border-slate-300 bg-white px-3 py-3 pl-10 text-sm placeholder-slate-400 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-[#010b50]" 
                        placeholder="ej: j.perez@bdt.sys" 
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
            </div>

            <button type="submit" id="submit-btn" class="group relative flex w-full justify-center items-center rounded-xl border border-transparent bg-[#010b50] px-4 py-3 text-sm font-bold text-white shadow-lg transition-all hover:-translate-y-0.5 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-[#010b50] focus:ring-offset-2 disabled:opacity-70 disabled:cursor-not-allowed">
                <span id="btn-text">Enviar instrucciones</span>
                <svg id="btn-spinner" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>

        <!-- Navegación -->
        <div class="mt-8 text-center">
            <a href="?route=login" class="inline-flex items-center text-sm font-semibold text-slate-500 transition-colors hover:text-[#010b50]">
                <svg class="mr-1.5 h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver al inicio de sesión
            </a>
        </div>
        
        <p class="mt-6 text-center text-xs font-medium text-slate-400 bg-slate-50 py-2.5 rounded-lg border border-slate-100">
            Nota: Entorno de simulación; no se envía correo real.
        </p>
    </div>
</div>

<!-- Script para protección de envío múltiple y UX -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('recovery-form');
        const emailInput = document.getElementById('email');

        // Forzar minúsculas y quitar espacios en el email
        if (emailInput) {
            emailInput.addEventListener('input', () => {
                emailInput.value = emailInput.value.toLowerCase().trim();
            });
        }

        if (form) {
            form.addEventListener('submit', function(event) {
                // Verificar que el navegador considere válido el email antes de animar
                if (!form.checkValidity()) return;

                const btn = document.getElementById('submit-btn');
                const btnText = document.getElementById('btn-text');
                const btnSpinner = document.getElementById('btn-spinner');
                const originalText = btnText.textContent;

                // Transición a estado de carga
                btnText.textContent = 'Procesando...';
                btnSpinner.classList.remove('hidden');
                btn.disabled = true;
                btn.setAttribute('aria-busy', 'true');
                document.body.style.cursor = 'wait';

                // Timeout de seguridad en caso de fallo del servidor (10 seg)
                setTimeout(() => {
                    if (btn.disabled) {
                        btn.disabled = false;
                        btn.removeAttribute('aria-busy');
                        btnText.textContent = originalText;
                        btnSpinner.classList.add('hidden');
                        document.body.style.cursor = 'default';
                    }
                }, 10000);
            });
        }
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>