@extends('layouts.admin')

@section('titulo', 'Categorías')

@section('contenido')

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold text-white">
            Gestión de Categorías
        </h1>

        <p class="text-gray-400 mt-1">
            Administra las categorías de productos de la tienda.
        </p>
    </div>

    <a 
        href="/categorias/create"
        class="px-5 py-2 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition shadow-lg"
    >
        + Nueva Categoría
    </a>

</div>

<div class="bg-[#121212]/80 rounded-lg border border-gray-800 shadow-lg overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-[#1a1a1a] border-b border-gray-700">
            <tr>
                <th class="p-4 text-gray-300">ID</th>
                <th class="p-4 text-gray-300">Nombre</th>
                <th class="p-4 text-gray-300">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($categorias as $categoria)

                <tr class="border-b border-gray-800 hover:bg-[#1a1a1a]/50 transition">

                    <td class="p-4 text-gray-400">
                        {{ $categoria->id }}
                    </td>

                    <td class="p-4 text-white font-medium">
                        {{ $categoria->nombre }}
                    </td>

                    <td class="p-4 flex gap-2">

                        <a 
                            href="/categorias/{{ $categoria->id }}/edit"
                            class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/30 hover:bg-yellow-500/20 transition"
                        >
                            Editar
                        </a>

                        <form action="/categorias/{{ $categoria->id }}" method="POST" class="form-eliminar" >
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1.5 text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg border border-red-500/30 transition-colors flex items-center justify-center">
                                Eliminar
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-500">
                        No hay categorías registradas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#1a1a1a',
        color: '#ffffff',
        iconColor: '#25a5be',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    @endif

    const formularios = document.querySelectorAll('.form-eliminar');
    
    formularios.forEach(formulario => {
        formulario.addEventListener('submit', function (e) {
            e.preventDefault();
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción borrará la categoría de forma permanente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f41e1e',
                cancelButtonColor: '#303640',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#121212',
                color: '#ffffff'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>

@endsection