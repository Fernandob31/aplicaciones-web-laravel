<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre_modelo' => $this->modelo, // Puedes cambiar el nombre de la clave
            'marca' => $this->marca,
            'precio_final' => (float) $this->precio,
            'colores_disponibles' => is_array($this->colores) ? $this->colores : explode(',', $this->colores),
            'portada' => $this->imagen,
            'galeria' => $this->imagenes->pluck('url_imagen'),
            'talles' => $this->talles->map (function ($talle) {
                return [
                    'numero' => $talle->talle,
                    'stock' => $talle->stock,
                    'hay_stock' => $talle->stock > 0
                ];
            }),
            'decripcion' => $this->descripcion
        ];
    }
}
