<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Categoria;

class MasProductosSeeder extends Seeder
{
    public function run()
    {
        // Buscamos dinámicamente los IDs de las categorías que creaste
        $futbolId = Categoria::where('nombre', 'like', '%fútbol%')->orWhere('nombre', 'like', '%futbol%')->first()->id ?? 1;
        $urbanoId = Categoria::where('nombre', 'like', '%urbano%')->first()->id ?? 1;
        $trekkingId = Categoria::where('nombre', 'like', '%trekking%')->first()->id ?? 1;

        $nuevosProductos = [
            // --- CATEGORÍA: FÚTBOL ---
            [
                'modelo' => 'Mercurial Vapor 15 Academy',
                'marca' => 'Nike',
                'categoria_id' => $futbolId,
                'precio' => 95.00,
                'colores' => ['#ffff00', '#000000'], // Amarillo fosforito y negro
                'genero' => 'Hombre',
                'descripcion' => 'Botines de fútbol para terreno firme. Cuentan con una unidad Zoom Air específica para una velocidad explosiva.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Nike+Mercurial',
            ],
            [
                'modelo' => 'Predator Elite FG',
                'marca' => 'adidas',
                'categoria_id' => $futbolId,
                'precio' => 250.00,
                'colores' => ['#000000', '#ff0000', '#ffffff'],
                'genero' => 'Hombre',
                'descripcion' => 'Diseñados con tecnología Strikeskin para un control milimétrico del balón y un golpeo perfecto al arco.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Adidas+Predator',
            ],
            [
                'modelo' => 'Future Ultimate FG/AG',
                'marca' => 'Puma',
                'categoria_id' => $futbolId,
                'precio' => 220.00,
                'colores' => ['#00ffff', '#ffa500'],
                'genero' => 'Unisex',
                'descripcion' => 'Inspirados en el estilo de juego de Neymar Jr. Cuenta con una parte superior Fuzionfit360 que se adapta al pie.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Puma+Future',
            ],

            // --- CATEGORÍA: URBANO ---
            [
                'modelo' => 'Samba Vegan',
                'marca' => 'adidas',
                'categoria_id' => $urbanoId,
                'precio' => 100.00,
                'colores' => ['#ffffff', '#000000', '#bebebe'],
                'genero' => 'Unisex',
                'descripcion' => 'Nacidas en las canchas de fútbol sala, las Samba son un clásico atemporal de la moda urbana actual.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Adidas+Samba',
            ],
            [
                'modelo' => 'Cortez Leather',
                'marca' => 'Nike',
                'categoria_id' => $urbanoId,
                'precio' => 90.00,
                'colores' => ['#ffffff', '#ff0000', '#0000ff'],
                'genero' => 'Unisex',
                'descripcion' => 'El clásico de running de 1972 rediseñado para el día a día con cuero suave y una mediasuela icónica.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Nike+Cortez',
            ],
            [
                'modelo' => '327 Lifestyle',
                'marca' => 'New Balance',
                'precio' => 110.00,
                'categoria_id' => $urbanoId,
                'colores' => ['#808080', '#f5f5dc'],
                'genero' => 'Mujer',
                'descripcion' => 'Silueta angular que rediseña de forma moderna los elementos de los calzados de running clásicos de los años 70.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=NB+327',
            ],
            [
                'modelo' => 'Cali Star',
                'marca' => 'Puma',
                'precio' => 80.00,
                'categoria_id' => $urbanoId,
                'colores' => ['#ffffff', '#ffa500'],
                'genero' => 'Mujer',
                'descripcion' => 'Zapatillas urbanas de corte bajo con plataforma sutil, inspiradas en el ambiente relajado de la costa de California.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Puma+Cali',
            ],

            // --- CATEGORÍA: TREKKING ---
            [
                'modelo' => 'Speedcross 6 GORE-TEX',
                'marca' => 'Salomon',
                'categoria_id' => $trekkingId,
                'precio' => 160.00,
                'colores' => ['#000000', '#808080'],
                'genero' => 'Unisex',
                'descripcion' => 'Calzado de trail y trekking impermeable. Fiel a sus raíces, es más ligera y cuenta con una evacuación de barro más rápida.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Salomon+Speedcross',
            ],
            [
                'modelo' => 'Moab 3 Waterproof',
                'marca' => 'Merrell',
                'categoria_id' => $trekkingId,
                'precio' => 140.00,
                'colores' => ['#8b4513', '#556b2f'], // Marrón y verde oliva
                'genero' => 'Hombre',
                'descripcion' => 'La opción favorita de los senderistas por su comodidad, resistencia y una plantilla con soporte excelente para terrenos difíciles.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Merrell+Moab+3',
            ],
            [
                'modelo' => 'Redmond III Waterproof',
                'marca' => 'Columbia',
                'categoria_id' => $trekkingId,
                'precio' => 110.00,
                'colores' => ['#a0522d', '#000000'],
                'genero' => 'Mujer',
                'descripcion' => 'Zapatilla de senderismo duradera que ofrece tracción excelente y amortiguación ligera en condiciones húmedas y secas.',
                'imagen' => 'https://via.placeholder.com/800x600/1a1a1a/ffffff?text=Columbia+Redmond',
            ],
        ];

        foreach ($nuevosProductos as $item) {
            $producto = Producto::create([
                'categoria_id' => $item['categoria_id'],
                'modelo'       => $item['modelo'],
                'marca'        => $item['marca'],
                'precio'       => $item['precio'],
                'colores'      => $item['colores'],
                'genero'       => $item['genero'],
                'descripcion'  => $item['descripcion'],
                'imagen'       => $item['imagen'],
                'resena'       => 0
            ]);

            // Talles y stock aleatorios para simular inventario variado en el panel
            $tallesDisponibles = ['37', '38', '39', '40', '41', '42', '43'];
            foreach ($tallesDisponibles as $talle) {
                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle'       => $talle,
                    'stock'       => rand(1, 10) > 2 ? rand(3, 25) : 0
                ]);
            }
        }
    }
}