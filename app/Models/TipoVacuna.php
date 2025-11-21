<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVacuna extends Model
{
    use HasFactory;

    // Asegúrate de usar el nombre singular si tu tabla es 'tipos_vacunas'
    protected $table = 'tipos_vacunas'; 

    protected $fillable = [
        'nombre_vacuna',
        'frecuencia_dias'
    ];

    // Relación N:M: Un Tipo de Vacuna ha sido aplicada a muchas Mascotas
    public function mascotas()
    {
        // El segundo parámetro es el nombre de la tabla pivot: 'mascota_vacuna'
        return $this->belongsToMany(Mascota::class, 'mascota_vacuna', 'tipos_vacunas_id', 'mascota_id')
                    // Esto permite acceder al campo 'fecha_aplicacion' en la relación
                    ->withPivot('fecha_aplicacion'); 
    }
}