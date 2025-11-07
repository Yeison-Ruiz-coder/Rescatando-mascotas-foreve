<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'Nombre_evento',
        'Lugar_evento',
        'Descripcion',
        'administrador_id'
    ];

    // Relaciones
    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }
}