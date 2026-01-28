    </main>

    <footer class="w-full bg-white border-t border-slate-200 transition-colors duration-300 mt-auto font-sans">
        <div class="max-w-[1440px] mx-auto px-6 py-5">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 flex items-center justify-center bg-slate-50 rounded border border-slate-100">
                        <img src="/assets/images/unexca-logo.png" alt="UNEXCA Logo" class="w-5 h-5 object-contain"/>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold text-slate-800 tracking-wider uppercase leading-none">UNEXCA</span>
                        <span class="text-[10px] text-slate-400 font-medium tracking-wide">PNF Informática - 2026</span>
                    </div>
                </div>

                <div class="hidden lg:flex items-center bg-slate-50 px-4 py-1.5 rounded-full border border-slate-100">
                    <p class="text-[11px] text-slate-500 tracking-wide font-normal">
                        <span class="text-slate-400 mr-2">Dev Squad:</span> 
                        <span class="hover:text-blue-600 transition-colors cursor-default font-medium text-slate-700">Marian Suárez</span>
                        <span class="mx-2 text-slate-300">|</span>
                        <span class="hover:text-blue-600 transition-colors cursor-default font-medium text-slate-700">Carlos Barboza</span>
                        <span class="mx-2 text-slate-300">|</span>
                        <span class="hover:text-blue-600 transition-colors cursor-default font-medium text-slate-700">Luis Hernández</span>
                    </p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-medium text-slate-400 tracking-wider font-mono">v1.0.4-rc</span>
                    </div>
                    
                    <div class="h-3 w-[1px] bg-slate-200"></div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-medium text-slate-500 tracking-wide">System Status</span>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex lg:hidden justify-center border-t border-slate-50 pt-3">
                <p class="text-[10px] text-slate-400 text-center tracking-wide uppercase">
                    Dev: Marian • Carlos • Luis
                </p>
            </div>
        </div>
    </footer>

    <div class="w-full bg-white pb-6 font-sans">
        <div class="max-w-[1440px] mx-auto px-6">
            <p class="text-slate-300 text-[10px] font-normal leading-normal tracking-wide text-center md:text-left">
                © 2026 Banco Digital de los Trabajadores. Todos los derechos académicos reservados.
            </p>
        </div>
    </div>

    <script>
        // Lógica del Navbar Scroll (si el navbar está en header.php)
        const nav = document.getElementById('main-nav');
        if(nav) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) { 
                    nav.classList.remove('nav-top'); 
                    nav.classList.add('nav-scrolled'); 
                } else { 
                    nav.classList.add('nav-top'); 
                    nav.classList.remove('nav-scrolled'); 
                }
            });
        }
    </script>

</body>
</html>
