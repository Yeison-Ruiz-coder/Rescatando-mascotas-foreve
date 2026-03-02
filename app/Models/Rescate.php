<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rescate extends Model
{
    use HasFactory;

    protected $table = 'rescates';

    protected $fillable = [
        'fecha_rescate',
        'lugar_rescate',
        'descripcion_rescate',
        'estado',
        'mascota_id',
        'reporte_id',
        'usuario_reporto_id',
        'veterinaria_id',
        'fundacion_id',
        'administrador_gestion_id',
    ];

    protected $casts = [
        'fecha_rescate' => 'date',
    ];

    // Relaciones
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporte_id');
    }

    public function usuarioReporto()
    {
        return $this->belongsTo(User::class, 'usuario_reporto_id');
    }

    public function veterinaria()
    {
        return $this->belongsTo(Veterinaria::class, 'veterinaria_id');
    }

    public function fundacion()
    {
        return $this->belongsTo(Fundacion::class, 'fundacion_id');
    }

    public function administradorGestion()
    {
        return $this->belongsTo(User::class, 'administrador_gestion_id');
    }
}
