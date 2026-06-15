@extends('layouts.admin')

@section('titulo', 'Crear Promoción')

@section('contenido')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">
            Crear Promoción
        </h1>
        <p class="text-gray-400 mt-1">
            Configura una nueva promoción para los productos seleccionados.
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/promociones" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="bg-[#121212]/80 rounded-xl border border-gray-800 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Tipo --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Tipo de Promoción <span class="text-red-500">*</span>
                    </label>
                    <select name="tipo" id="tipo" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                        <option value="">Seleccione...</option>
                        <option value="categoria">Categoría</option>
                        <option value="marca">Marca</option>
                        <option value="personalizada">Personalizada</option>
                    </select>
                </div>
                
                {{-- Nombre --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Nombre de la Promoción <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                </div>
                {{-- Descuento --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Descuento (%) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" min="1" max="99" name="descuento" value="{{ old('descuento') }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white" >
                </div>
                {{-- Fecha fin --}}
                <div>
                    <label class="block mb-2 text-gray-300">
                        Fecha Fin <span class="text-red-500">*</span>
                    </label>

                    <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}"
                        class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                </div>
                
                <div class="mt-10 mb-6">
                    <h2 class="text-xl font-bold text-white"> Productos Afectados </h2>
                    <p class="text-gray-400 text-sm mt-1"> Seleccione los productos que participarán en la promoción. </p>
                    {{-- COLUMNA IZQUIERDA --}}
                    <div id="panel-filtros">
                        <div id="opciones-categoria" class="hidden">
                            <label class="block mb-2 text-gray-300"> Categorías </label>
                            <select id="select-categorias" name="categorias[]" multiple class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                                @endforeach
                            </select>
                            <button type="button" id="btn-cargar-categorias" class="mt-3 px-4 py-2 bg-[#25a5be] text-white rounded-lg">
                                Mostrar productos
                            </button>
                        </div>
                        <div id="opciones-marca" class="hidden">
                            <label class="block mb-2 text-gray-300"> Marca </label>
                            <select id="select-marca" name="marca" class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                                <option value=""> Seleccione una marca </option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca }}"> {{ $marca }} </option>
                                @endforeach
                            </select>
                            <button type="button" id="btn-cargar-marca" class="mt-3 px-4 py-2 bg-[#25a5be] text-white rounded-lg">
                                Mostrar productos
                            </button>
                        </div>
                    </div>
                </div>
                <div id="opciones-promocion" class="mt-6">
                    {{-- COLUMNA DERECHA --}}
                    <div id="opciones-productos" class="hidden lg:col-span-2">
                        <div id="contenedor-seleccionar-todos" class="flex items-center gap-2 mb-4">
                            <input type="checkbox" id="seleccionar-todos">
                            <label for="seleccionar-todos" class="text-gray-300"> Seleccionar todos </label>
                        </div>
                        <div class="max-h-96 overflow-y-auto border border-gray-700 rounded-lg">
                            <div class="mb-4">
                                <input type="text" id="buscar-producto" placeholder="Buscar marca o modelo..."
                                    class="w-full bg-[#1a1a1a] border border-gray-700 rounded-lg px-4 py-3 text-white">
                            </div>
                            <table class="w-full text-sm">
                                <thead class="bg-[#1a1a1a] text-gray-300">
                                    <tr>
                                        <th id="columna-check-header" class="p-3 hidden"></th>
                                        <th class="p-3">Marca</th>
                                        <th class="p-3">Modelo</th>
                                        <th class="p-3">Precio</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-productos-body">
                                    @foreach($productos as $producto)
                                        <tr class="fila-producto border-t border-gray-800">
                                            <td class="p-3 text-center">
                                                <input type="checkbox" name="productos[]" value="{{ $producto->id }}" class="producto-checkbox">
                                            </td>
                                            <td class="p-3">
                                                {{ $producto->marca }}
                                            </td>
                                            <td class="p-3">
                                                {{ $producto->modelo }}
                                            </td>
                                            <td class="p-3">
                                                ${{ number_format($producto->precio, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-800 flex gap-4">
                <button type="submit" class="px-6 py-3 bg-[#25a5be] hover:bg-[#1d8fa5] text-white rounded-lg transition">
                    Guardar Promoción
                </button>
                <a href="{{ url('/promociones') }}" class="px-6 py-3 border border-gray-700 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tipo = document.getElementById('tipo');

    const categoria = document.getElementById('opciones-categoria');
    const marca = document.getElementById('opciones-marca');
    const productos = document.getElementById('opciones-productos');

    tipo.addEventListener('change', function () {
        const tbody = document.getElementById('tabla-productos-body');
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    Seleccione los filtros y presione "Mostrar Productos"
                </td>
            </tr>
        `;    

        categoria.classList.add('hidden');
        marca.classList.add('hidden');
        productos.classList.add('hidden');
        // Limpiamos
        const selectCategorias = document.getElementById('select-categorias');
        const selectMarca = document.getElementById('select-marca');
        if (selectCategorias) {
            [...selectCategorias.options].forEach(op => {
                op.selected = false;
            });
        }
        if (selectMarca) {
            selectMarca.selectedIndex = 0;
        }
        
        const contenedorSeleccionarTodos = document.getElementById('contenedor-seleccionar-todos');
        const columnaHeader = document.getElementById('columna-check-header');

        if (this.value === 'personalizada') {
            contenedorSeleccionarTodos.classList.remove('hidden');
            columnaHeader.classList.remove('hidden');
        } else {
            contenedorSeleccionarTodos.classList.add('hidden');
            columnaHeader.classList.add('hidden');
        }

        if (this.value === 'categoria') {
            categoria.classList.remove('hidden');
        }

        if (this.value === 'marca') {
            marca.classList.remove('hidden');
        }

        if (this.value === 'personalizada') {
            productos.classList.remove('hidden');
            fetch('/promociones/productos-filtrados')
                .then(r => r.json())
                .then(productos => {
                    renderizarProductos(productos);
                });
        }
    });
    // Boton categoria
    const btnCategorias = document.getElementById('btn-cargar-categorias');
        if (btnCategorias) {
            btnCategorias.addEventListener('click', function () {
                productos.classList.remove('hidden');
                cargarProductosFiltrados();
            });
        }
    // Boton marca 
    const btnMarca = document.getElementById('btn-cargar-marca');
        if (btnMarca) {
            btnMarca.addEventListener('click', function () {
                productos.classList.remove('hidden');
                cargarProductosFiltrados();
            });
        }
});


const buscador = document.getElementById('buscar-producto');

if (buscador) {
    buscador.addEventListener('keyup', function() {
        const texto = this.value.toLowerCase();

        document.querySelectorAll('.fila-producto').forEach(fila => {
                const contenido = fila.textContent.toLowerCase();

                fila.style.display =
                    contenido.includes(texto)
                        ? ''
                        : 'none';
            });
    });

}

// Dibujar los productos
function renderizarProductos(productos) {
    const tbody = document.getElementById('tabla-productos-body');
    tbody.innerHTML = '';

    if (productos.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    No hay productos disponibles.
                </td>
            </tr>
        `;
        return;
    }
    
    const tipo = document.getElementById('tipo').value;
    // render
    productos.forEach(producto => {
        let columnaCheckbox = '';
        if (tipo === 'personalizada') {
            columnaCheckbox = `
                <td class="p-3 text-center">
                    <input type="checkbox" name="productos[]" value="${producto.id}" class="producto-checkbox">
                </td>
            `;
        }
        tbody.innerHTML += `
            <tr class="fila-producto border-t border-gray-800">
                ${columnaCheckbox}
                <td class="p-3"> ${producto.marca} </td>
                <td class="p-3"> ${producto.modelo} </td>
                <td class="p-3"> $${Number(producto.precio).toLocaleString('es-AR')} </td>
            </tr>
        `;
    });

    const seleccionarTodos = document.getElementById('seleccionar-todos');
    if (seleccionarTodos) {
        seleccionarTodos.addEventListener('change', function () {
            document.querySelectorAll('.producto-checkbox')
                .forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
        });
    }
    // actualizarSeleccionarTodos();
}

// consulta Ajax queda
function cargarProductosFiltrados() {
    const tipo = document.getElementById('tipo').value;
    let url = '/promociones/productos-filtrados?';

    if (tipo === 'categoria') {
        const categorias = document.getElementById('select-categorias');
        const seleccionadas = [...categorias.selectedOptions].map(op => op.value);

        seleccionadas.forEach(id => {
            url += `categorias[]=${id}&`;
        });
    }
    else if (tipo === 'marca') {
        const marca = document.getElementById('select-marca');
        url += `marca=${marca.value}`;
    }
    /*else if (tipo === 'personalizada') {
        url += 'personalizada=1';
    }*/

    console.log(url);

    fetch(url)
        .then(r => r.json())
        .then(productos => {
            renderizarProductos(productos);
        });
}


</script>

@endsection