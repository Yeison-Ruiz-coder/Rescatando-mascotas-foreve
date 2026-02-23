<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoAdopcion extends Model
{
    use HasFactory;

    protected $table = 'seguimientos_adopcion';

    protected $fillable = [
        'adopcion_id',
        'fecha_seguimiento',
        'observaciones',
        'estado_mascota',
        'foto_url',
        'realizado_por',
    ];

    protected $casts = [
        'fecha_seguimiento' => 'date',
    ];

    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'adopcion_id');
    }

    public function realizadoPor()
    {
        return $this->belongsTo(User::class, 'realizado_por');
    }
}
