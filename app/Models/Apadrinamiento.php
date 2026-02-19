<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apadrinamiento extends Model
{
    protected $table = 'apadrinamientos'; // Cambiar en migración

    protected $fillable = [
        'usuario_id',
        'mascota_id',
        'monto_mensual',
        'frecuencia',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'mensaje_apoyo'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'monto_mensual' => 'decimal:2'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
