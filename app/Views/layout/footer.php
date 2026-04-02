</main>

    <footer class="w-full relative overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 border-t border-indigo-100 mt-auto font-sans">
        
        <div class="absolute inset-0 pointer-events-none opacity-40" aria-hidden="true">
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-200 blur-3xl"></div>
            <div class="absolute top-10 right-0 w-80 h-80 rounded-full bg-fuchsia-100 blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-[1440px] mx-auto px-6 py-5">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 flex items-center justify-center bg-white rounded-xl shadow-sm border border-indigo-100">
                        <img src="/assets/images/unexca-logo.png" alt="UNEXCA Logo" class="w-6 h-6 object-contain"/>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[12px] font-extrabold text-[#010b50] tracking-wider uppercase leading-none">UNEXCA</span>
                        <span class="text-[10px] text-slate-500 font-medium tracking-wide mt-0.5">PNF Informática - 2026</span>
                    </div>
                </div>

                <div class="hidden lg:flex items-center bg-white/60 backdrop-blur-md shadow-sm px-4 py-2 rounded-full border border-indigo-100/50">
                    <p class="text-[11px] text-slate-500 tracking-wide font-normal">
                        <span class="text-indigo-500 font-semibold mr-2">Dev Squad:</span> 
                        <span class="hover:text-[#010b50] transition-colors font-bold text-slate-700">
                            <a href="https://github.com/Marianvsf" target="_blank" rel="noopener noreferrer">Marian Suárez</a>
                        </span>
                    </p>
                </div>

                <div class="flex items-center gap-5">
                    <div class="flex items-center">
                        <span class="text-[10px] font-bold text-slate-400 tracking-widest font-mono uppercase">v1.0.4-rc</span>
                    </div>
                    
                    <div class="h-4 w-[1px] bg-slate-300"></div>
                    
                    <div class="flex items-center gap-2 bg-white/70 px-3 py-1.5 rounded-full border border-emerald-100 shadow-sm">
                        <span class="text-[10px] font-bold text-slate-600 tracking-wide">System Status</span>
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex lg:hidden justify-center border-t border-indigo-100/60 pt-4">
                <p class="text-[10px] text-slate-500 text-center tracking-wide uppercase font-medium">
                    Dev: <span class="font-bold text-[#010b50]">Marian Suárez</span> | <span class="text-indigo-500 font-bold">v1.0.4-rc</span>
                </p>
            </div>
        </div>
        
        <div class="relative z-10 w-full py-4 font-sans">
            <div class="max-w-[1440px] mx-auto px-6 flex justify-center">
                <p class="text-slate-400 text-[10px] font-medium leading-relaxed tracking-wide text-center">
                    © 2026 Banco Digital de los Trabajadores. Proyecto de grado UNEXCA. Todos los derechos académicos reservados.
                </p>
            </div>
        </div>
    </footer>
        
    <script>
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