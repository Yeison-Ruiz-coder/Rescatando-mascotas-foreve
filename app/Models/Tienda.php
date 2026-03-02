<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tiendas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen_url',
        'estado',
        'user_id', // Quién vende (fundación o veterinaria)
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Vendedor del producto (fundación o veterinaria)
     */
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Pedidos que incluyen este producto
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }

    /**
     * Verificar si hay stock suficiente
     */
    public function tieneStock($cantidad = 1)
    {
        return $this->stock >= $cantidad;
    }

    /**
     * Reducir stock
     */
    public function reducirStock($cantidad)
    {
        if ($this->tieneStock($cantidad)) {
            $this->decrement('stock', $cantidad);

            // Actualizar estado automáticamente
            if ($this->stock == 0) {
                $this->update(['estado' => 'agotado']);
            }

            return true;
        }

        return false;
    }

    /**
     * Scope para productos disponibles
     */
    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'disponible')
                     ->where('stock', '>', 0);
    }

    /**
     * Scope para productos de un vendedor
     */
    public function scopeDeVendedor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para stock bajo
     */
    public function scopeStockBajo($query, $limite = 5)
    {
        return $query->where('stock', '<=', $limite)
                     ->where('estado', '!=', 'oculto');
    }
}
