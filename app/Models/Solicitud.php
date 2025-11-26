<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // AÑADE ESTA LÍNEA para especificar el nombre de la tabla
    protected $table = 'solicitudes'; 

    // Aquí van tus campos rellenables (fillable)
    protected $fillable = [
        'tipo',
        'contenido',
        'fecha_solicitud',
        'usuario_id',
        'estado',
    ];

    // Si tienes timestamps (created_at, updated_at) en la tabla, déjalo.
    // public $timestamps = true; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}