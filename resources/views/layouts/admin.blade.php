<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel de Administración') - Boyz in the Sneaker</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#0a0a0a] text-white font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#121212] border-r border-[#25a5be]/20 flex flex-col shadow-[4px_0_15px_rgba(0,0,0,0.5)] z-10">
        <div class="h-16 flex items-center justify-center border-b border-[#25a5be]/20">
            <span class="text-x2 font-bold text-[#25a5be] tracking-widest uppercase shadow-cyan-500/50">Boyz in the Sneaker</span>
        </div>
        
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 rounded-md transition {{ request()->routeIs('dashboard') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                Dashboard
            </a>
            
            <a href="/productos" 
               class="block px-4 py-2 rounded-md transition {{ request()->is('productos*') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                Productos
            </a>
            
            @if(auth()->user()->rol == 'admin' || auth()->user()->rol == 'gestor_productos') 
                <a href="/categorias" 
                class="block px-4 py-2 rounded-md transition {{ request()->is('categorias*') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                    Categorías
                </a>
            @endif

            @if(in_array(auth()->user()->rol, ['admin', 'gestor_stock']))
                <a href="/promociones"
                class="block px-4 py-2 rounded-md transition {{ request()->is('promociones*') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                    Promociones
                </a>
            @endif
            
            @if(auth()->user()->rol == 'admin')
                <a href="/ventas" 
                class="block px-4 py-2 rounded-md transition {{ request()->is('ventas*') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                    Facturación y Ventas
                </a>

                <a href="/usuarios" 
                class="block px-4 py-2 rounded-md transition {{ request()->is('usuarios*') ? 'bg-[#25a5be]/10 text-[#25a5be] font-medium border border-[#25a5be]/30' : 'hover:bg-[#1a1a1a] text-gray-400 hover:text-gray-200 border border-transparent' }}">
                    Usuarios
                </a>
            @endif
        </nav>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-[#121212] border-b border-[#25a5be]/20 flex items-center justify-between px-6 shadow-md z-0">
            <h2 class="text-lg font-semibold text-gray-200">
                @yield('titulo', 'Dashboard')
            </h2>
            
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-400">
                    Hola, <span class="text-[#25a5be]">{{ auth()->user()->username }}</span> ({{ auth()->user()->rol_nombre }})
                </span>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm px-3 py-1.5 bg-red-500/10 text-red-400 rounded-md hover:bg-red-500/20 border border-red-500/30 transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-[#0a0a0a] to-[#121212] p-8">
            @yield('contenido')
        </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>