@extends('layouts.admin')

@section('titulo', 'Resumen General')

@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Total Productos</h3>
            <p class="text-4xl font-bold text-[#25a5be]">0</p>
        </div>
        
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Categorías Activas</h3>
            <p class="text-4xl font-bold text-[#25a5be]">0</p>
        </div>
        
        <div class="bg-[#121212]/80 p-6 rounded-lg border border-[#25a5be]/30 shadow-lg backdrop-blur-sm">
            <h3 class="text-gray-400 text-xs uppercase tracking-widest mb-2">Usuarios Registrados</h3>
            <p class="text-4xl font-bold text-[#25a5be]">1</p>
        </div>
    </div>

    <div class="bg-[#121212]/80 p-8 rounded-lg border border-gray-800 shadow-lg backdrop-blur-sm">
        <h3 class="text-xl text-gray-200 mb-4 border-b border-gray-700 pb-2">Bienvenido al Panel de Administración</h3>
        <p class="text-gray-400 leading-relaxed">
            Desde aquí podrás gestionar todo el catálogo de la tienda. Selecciona una opción en el menú lateral para comenzar a cargar productos o imágenes.
        </p>
    </div>
@endsection