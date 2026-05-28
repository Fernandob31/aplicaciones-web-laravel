<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Boyz in the Sneaker</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-b from-[#145369] to-[#121212] text-white min-h-screen flex flex-col font-sans antialiased m-0 p-0">

    <div class="flex-1 flex flex-col justify-center items-center text-center p-5">
        
        <h1 class="text-4xl uppercase tracking-widest m-0 drop-shadow-lg text-[#25a5be] mb-2">Boyz in the Sneaker</h1>
        <div class="w-[100px] h-1 bg-[#25a5be] mb-8 rounded-sm shadow-[0_0_8px_#25a5be70]"></div>

        <div class="bg-[#121212]/80 p-8 rounded-lg shadow-2xl border border-[#25a5be]/30 w-full max-w-md backdrop-blur-sm">
            <h2 class="text-2xl font-bold mb-6 text-[#25a5be]">Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-5 text-left">
                @csrf 

                <div>
                    <label for="username" class="block text-gray-300 font-semibold mb-2">Nombre de Usuario:</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full px-4 py-2 bg-[#0a0a0a] border border-gray-600 rounded-md text-white focus:outline-none focus:border-[#25a5be] focus:ring-1 focus:ring-[#25a5be] transition">
                    @error('username')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-300 font-semibold mb-2">Contraseña:</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 bg-[#0a0a0a] border border-gray-600 rounded-md text-white focus:outline-none focus:border-[#25a5be] focus:ring-1 focus:ring-[#25a5be] transition">
                </div>

                <button type="submit" class="w-full py-3 mt-4 bg-[#25a5be] hover:bg-[#1b7a8d] text-white font-bold rounded-md transition duration-300 uppercase tracking-wide shadow-[0_0_10px_#25a5be50]">
                    Entrar
                </button>
            </form>
        </div>
    </div>

    <footer class="text-center p-5 bg-[#0a0a0a]/80 border-t-2 border-[#25a5be] text-gray-400 text-lg backdrop-blur-sm">
        Aplicaciones Web - 2026
    </footer>

</body>
</html>