<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAdopcion extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla explícitamente
    protected $table = 'solicitudes_adopcion';

    protected $fillable = [
        'mascota_id',
        'nombre_solicitante',
        'apellido_solicitante',
        'email',
        'telefono',
        'direccion',
        'experiencia_mascotas',
        'tipo_vivienda',
        'motivo_adopcion',
        'compromiso_cuidado',
        'compromiso_esterilizacion',
        'compromiso_seguimiento',
        'estado',
        'razon_rechazo',
        'notas_administrador',
        'administrador_id'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }
}