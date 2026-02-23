<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'tienda_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria',
        'imagenes',
        'estado',
        'creado_por',
        'actualizado_por',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'imagenes' => 'array',
    ];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }

    // Auditoría
    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizador()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
