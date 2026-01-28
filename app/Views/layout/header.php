<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Corporativo - BDT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #main-nav { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); left: 50%; transform: translateX(-50%); }
        .nav-top { width: 100%; top: 0; background-color: rgba(255, 255, 255, 1); border-bottom: 1px solid #f3f4f6; padding: 0.75rem 0; }
        .nav-scrolled { width: 90%; max-width: 1200px; top: 1.5rem; border-radius: 9999px; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); padding: 0.5rem 0; }
        
        /* Animación suave para el fondo */
        .animated-bg {
            background: linear-gradient(-45deg, #010b50, #0f172a, #1e3a8a, #312e81);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased font-sans flex flex-col min-h-screen">

    <nav id="main-nav" class="fixed z-50 nav-top">
        <div class="container mx-auto px-6 flex justify-between items-center h-full">
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-[#4F46E5]" viewBox="0 0 24 24" fill="none"><path d="M2 12C2 12 5 9 8 9C11 9 13 12 16 12C19 12 22 9 22 9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17C2 17 5 14 8 14C11 14 13 17 16 17C19 17 22 14 22 14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/></svg>
                <span class="text-xl font-bold text-gray-900 tracking-tight">BDT<span class="text-[#4F46E5]">.sistema</span></span>
            </div>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="#" class="text-sm font-semibold text-gray-500 hover:text-[#010b50]">Centro de Ayuda</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="flex-grow w-full min-h-screen">