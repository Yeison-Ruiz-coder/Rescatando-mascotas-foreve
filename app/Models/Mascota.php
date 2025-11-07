<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    protected $fillable = [
        'Nombre_mascota',
        'Especie',
        'Raza',
        'Edad_aprox',
        'Genero',
        'estado',
        'Lugar_rescate',
        'Descripcion',
        'Foto',
        'vacunas',
        'Fecha_ingreso',
        'Fecha_salida',
        'fundacion_id'
    ];

    // Relaciones
    public function fundacion()
    {
        return $this->belongsTo(Fundacion::class);
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }

    public function rescates()
    {
        return $this->hasMany(Rescate::class);
    }
}