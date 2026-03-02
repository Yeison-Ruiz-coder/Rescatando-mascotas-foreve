<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nombre_evento',
        'lugar_evento',
        'descripcion',
        'fecha_evento',
        'imagen_url',
        'creado_por_id',
    ];

    protected $casts = [
        'fecha_evento' => 'date',
    ];

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_por_id');
    }
}
