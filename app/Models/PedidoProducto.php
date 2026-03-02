<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PedidoProducto extends Pivot
{
    protected $table = 'pedido_producto';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Pedido al que pertenece
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Producto asociado
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
