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
        'galeria_fotos',
        'vacunas',
        'Fecha_ingreso',
        'Fecha_salida',
        'fundacion_id'
    ];

    protected $casts = [
        'galeria_fotos' => 'array', 
        'Fecha_ingreso' => 'date',
        'Fecha_salida' => 'date',
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
    
   public function razas()
    {
        // Une Mascota con Raza a través de la tabla pivot 'mascota_raza'
        return $this->belongsToMany(Raza::class, 'mascota_raza', 'mascota_id', 'raza_id');
    }

    public function tiposVacunas()
    {
        // Une Mascota con TipoVacuna a través de la tabla pivot 'mascota_vacuna'
        // Permite acceder a la fecha de aplicación
        return $this->belongsToMany(TipoVacuna::class, 'mascota_vacuna', 'mascota_id', 'tipos_vacunas_id')
                    ->withPivot('fecha_aplicacion');
    }
}