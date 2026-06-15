<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promocion;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'modelo',
        'marca',
        'precio',
        'descuento',
        'colores',
        'genero',
        'descripcion',
        'imagen',
        'resena'
    ];

    // casts laravel convierta automaticamente
    protected $casts = [
        'colores' => 'array'
    ];

    public function categoria()    {
        return $this->belongsTo(Categoria::class);
    }

    public function talles()    {
        return $this->hasMany(ProductoTalle::class);
    }
    public function imagenes()    {
        return $this->hasMany(ImagenProducto::class);
    }

    public function getPrecioFinalAttribute()    {
        return $this->precio - (
            $this->precio * $this->descuento / 100
        );
    }

    public function getTieneDescuentoAttribute()    {
        return $this->descuento > 0;
    }

    public function getMontoDescuentoAttribute()    {
        return $this->precio - $this->precio_final;
    }

    public function promociones()     {
        return $this->belongsToMany(
            Promocion::class,
            'promocion_producto'
        );
    }
}
