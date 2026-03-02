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
        'especie',
    ];

    public function mascotas()
    {
        return $this->belongsToMany(Mascota::class, 'mascota_raza', 'raza_id', 'mascota_id');
    }
}
