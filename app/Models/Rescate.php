<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rescate extends Model
{
    use HasFactory;

    protected $table = 'rescates';

    protected $fillable = [
        'Fecha_rescate',
        'Lugar_rescate',
        'Descripcion_rescate',
        'usuario_id',
        'mascota_id',
        'veterinaria_id',
        'tienda_id',
        'fundacion_id',
        'administrador_id'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinaria()
    {
        return $this->belongsTo(Veterinaria::class);
    }

    public function tienda()
    {
        return $this->belongsTo(Tienda::class);
    }

    public function fundacion()
    {
        return $this->belongsTo(Fundacion::class);
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }
}