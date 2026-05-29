<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\ProductoTalle;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        // Buscamos la primera categoría disponible para no romper la llave foránea
        // Si no tienes categorías creadas, asegúrate de crear al menos una desde tu panel
        $categoriaId = Categoria::first()->id ?? 1;

        $productos = [
            [
                'modelo' => 'Air Force 1 \'07',
                'marca' => 'Nike',
                'precio' => 115.00,
                'colores' => ['#ffffff'],
                'genero' => 'Unisex',
                'descripcion' => 'El resplandor vive en las Nike Air Force 1 \'07, el icono del baloncesto que da un nuevo giro a lo que mejor conoces.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Air+Force+1',
            ],
            [
                'modelo' => 'Ultraboost 22',
                'marca' => 'adidas',
                'precio' => 190.00,
                'colores' => ['#000000', '#ffffff'],
                'genero' => 'Hombre',
                'descripcion' => 'Zapatillas de running con retorno de energía inigualable gracias a su mediasuela Boost y un ajuste perfecto.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Ultraboost+22',
            ],
            [
                'modelo' => 'RS-X Toys',
                'marca' => 'Puma',
                'precio' => 110.00,
                'colores' => ['#ff0000', '#0000ff', '#ffffff'],
                'genero' => 'Unisex',
                'descripcion' => 'Diseño retro-futurista con una mezcla de colores vibrantes inspirados en los juguetes de colección de los 80s.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Puma+RS-X',
            ],
            [
                'modelo' => '550',
                'marca' => 'New Balance',
                'precio' => 120.00,
                'colores' => ['#ffffff', '#008000'],
                'genero' => 'Unisex',
                'descripcion' => 'Un tributo a los jugadores de baloncesto profesionales de los 90 y al estilo urbano que definió una generación.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=NB+550',
            ],
            [
                'modelo' => 'Chuck Taylor All Star',
                'marca' => 'Converse',
                'precio' => 65.00,
                'colores' => ['#000000', '#ffffff'],
                'genero' => 'Unisex',
                'descripcion' => 'Las inconfundibles zapatillas de lona que empezaron en las canchas y conquistaron las calles de todo el mundo.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Chuck+Taylor',
            ],
            [
                'modelo' => 'Old Skool',
                'marca' => 'Vans',
                'precio' => 70.00,
                'colores' => ['#000000', '#ffffff'],
                'genero' => 'Unisex',
                'descripcion' => 'El calzado clásico de skate de Vans y el primero en lucir la icónica banda lateral (sidestripe).',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Vans+Old+Skool',
            ],
            [
                'modelo' => 'Air Jordan 1 Retro High',
                'marca' => 'Nike',
                'precio' => 180.00,
                'colores' => ['#ff0000', '#000000', '#ffffff'],
                'genero' => 'Hombre',
                'descripcion' => 'Las zapatillas que lo empezaron todo. Combinación de colores clásica de Chicago, fabricadas en cuero premium.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Jordan+1+Retro',
            ],
            [
                'modelo' => 'Gel-Kayano 29',
                'marca' => 'Asics',
                'precio' => 160.00,
                'colores' => ['#0000ff', '#c0c0c0'],
                'genero' => 'Mujer',
                'descripcion' => 'Crean una experiencia de carrera estable y con una gran capacidad de respuesta, ideales para largas distancias.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Asics+Gel-Kayano',
            ],
            [
                'modelo' => 'Club C 85 Vintage',
                'marca' => 'Reebok',
                'precio' => 85.00,
                'colores' => ['#f5f5dc', '#008000'],
                'genero' => 'Unisex',
                'descripcion' => 'Estilo limpio y minimalista que nunca pasa de moda. Calzado inspirado en las pistas de tenis de los años 80.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Reebok+Club+C',
            ],
            [
                'modelo' => 'Air Max 90',
                'marca' => 'Nike',
                'precio' => 130.00,
                'colores' => ['#ffffff', '#000000', '#808080'],
                'genero' => 'Hombre',
                'descripcion' => 'Mantente fiel a tus raíces del running de los 90. Cuentan con la icónica suela Waffle y amortiguación Max Air visible.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=Air+Max+90',
            ],
            [
                'modelo' => 'Superstar',
                'marca' => 'adidas',
                'precio' => 100.00,
                'colores' => ['#ffffff', '#000000'],
                'genero' => 'Unisex',
                'descripcion' => 'Con su icónica puntera de goma, estas zapatillas pasaron del baloncesto a dominar la cultura hip-hop.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=adidas+Superstar',
            ],
            [
                'modelo' => '2002R',
                'marca' => 'New Balance',
                'precio' => 140.00,
                'colores' => ['#808080', '#c0c0c0'],
                'genero' => 'Unisex',
                'descripcion' => 'Inspiradas en el diseño de calzado de running de la década de los 2000 para ofrecer una estética retro que marca tendencia.',
                'imagen' => 'https://via.placeholder.com/800x600/f3f4f6/1f2937?text=NB+2002R',
            ],
        ];

        foreach ($productos as $item) {
            $producto = Producto::create([
                'categoria_id' => $categoriaId,
                'modelo'       => $item['modelo'],
                'marca'        => $item['marca'],
                'precio'       => $item['precio'],
                'colores'      => $item['colores'],
                'genero'       => $item['genero'],
                'descripcion'  => $item['descripcion'],
                'imagen'       => $item['imagen'],
                'resena'       => 0
            ]);

            // Agregar talles aleatorios (del 38 al 43) y stock para cada producto
            $tallesDisponibles = ['38', '39', '40', '41', '42', '43'];
            
            foreach ($tallesDisponibles as $talle) {
                // Hay un 20% de probabilidad de que un talle tenga stock 0 para probar el frontend
                $stockAleatorio = rand(1, 100) > 20 ? rand(5, 30) : 0;

                ProductoTalle::create([
                    'producto_id' => $producto->id,
                    'talle'       => $talle,
                    'stock'       => $stockAleatorio
                ]);
            }
        }
    }
}
