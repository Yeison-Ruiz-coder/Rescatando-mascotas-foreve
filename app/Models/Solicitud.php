<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes'; 

    protected $fillable = [
        'tipo',
        'contenido', // En minúscula
        'fecha_solicitud', // En minúscula
        'usuario_id',
        'estado', // Nuevo campo
        'mascota_id' // Nuevo campo
    ];

     //  CASTS
    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}