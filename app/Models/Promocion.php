<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';    

    protected $fillable = [
        'nombre',
        'tipo',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    public function productos()    {
        return $this->belongsToMany(Producto::class,'promocion_producto');
    }

}
