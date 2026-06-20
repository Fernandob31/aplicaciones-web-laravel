<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_compra',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'total',
        'estado',
        'my_parment_id',
    ];

    // Una venta tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}