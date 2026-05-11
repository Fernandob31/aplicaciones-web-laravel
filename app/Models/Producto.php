<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'modelo',
        'marca',
        'precio',
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

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function talles()
    {
        return $this->hasMany(ProductoTalle::class);
    }
}
