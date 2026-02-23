<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';

    protected $fillable = [
        'mascota_id',
        'veterinaria_id',
        'veterinario_id',
        'registrado_por',
        'fecha_consulta',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'documento_url',
    ];

    protected $casts = [
        'fecha_consulta' => 'date',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    public function veterinaria()
    {
        return $this->belongsTo(Veterinaria::class, 'veterinaria_id');
    }

    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
