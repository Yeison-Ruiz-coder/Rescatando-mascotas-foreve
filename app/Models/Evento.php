<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre_evento',
        'Lugar_evento',
        'Descripcion',
        'Fecha_evento',
        'imagen_url',
        'administrador_id'
    ];

    protected $casts = [
        'Fecha_evento' => 'datetime',
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }
}