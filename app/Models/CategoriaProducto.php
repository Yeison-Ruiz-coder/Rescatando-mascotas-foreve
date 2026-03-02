<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoriaProducto extends Pivot
{
    protected $table = 'categoria_producto';

    protected $fillable = [
        'categoria_id',
        'producto_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
