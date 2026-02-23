<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'tienda_id',
        'total',
        'estado',
        'direccion_envio',
        'metodo_pago',
        'referencia_pago',
        'fecha_pago',
        'fecha_envio',
        'fecha_entrega',
        'creado_por',
        'actualizado_por',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'fecha_pago' => 'datetime',
        'fecha_envio' => 'datetime',
        'fecha_entrega' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
