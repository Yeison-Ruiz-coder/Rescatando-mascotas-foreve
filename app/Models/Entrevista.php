<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;

    protected $table = 'entrevistas';

    protected $fillable = [
        'adopcion_id',
        'fecha_entrevista',
        'notas',
        'resultado',
        'admin_id'
    ];

    // Relación 1:N Inversa: Una Entrevista pertenece a una Adopción
    public function adopcion()
    {
        return $this->belongsTo(Adopcion::class, 'adopcion_id');
    }

    // Relación 1:N Inversa: Una Entrevista fue realizada por un Administrador/Usuario
    public function administrador()
    {
        // Asumiendo que admin_id apunta a la tabla 'usuarios'
        return $this->belongsTo(Usuario::class, 'admin_id'); 
    }
}