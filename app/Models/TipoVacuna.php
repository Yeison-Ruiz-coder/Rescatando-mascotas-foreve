<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVacuna extends Model
{
    use HasFactory;

    protected $table = 'tipos_vacunas';

    protected $fillable = [
        'nombre_vacuna',
        'frecuencia_dias',
    ];

    public function mascotas()
    {
        return $this->belongsToMany(Mascota::class, 'mascota_vacuna', 'tipos_vacunas_id', 'mascota_id')
                    ->withPivot('fecha_aplicacion')
                    ->withTimestamps();
    }
}
