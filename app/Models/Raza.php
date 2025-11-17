<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    use HasFactory;

    protected $table = 'razas';

    protected $fillable = [
        'nombre_raza',
        'especie'
    ];

    // Relación N:M: Una Raza puede pertenecer a muchas Mascotas (a través de la tabla pivot)
    public function mascotas()
    {
        // El segundo parámetro es el nombre de la tabla pivot: 'mascota_raza'
        return $this->belongsToMany(Mascota::class, 'mascota_raza', 'raza_id', 'mascota_id');
    }
}