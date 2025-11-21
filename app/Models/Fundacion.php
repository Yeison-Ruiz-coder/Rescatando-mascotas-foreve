<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundacion extends Model
{
    use HasFactory;

    protected $table = 'fundaciones';

    protected $fillable = [
        'Nombre_1',
        'Direccion',
        'Telefono',
        'Email'
    ];

    // Relaciones
    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class);
    }

    public function rescates()
    {
        return $this->hasMany(Rescate::class);
    }

    public function adopciones(){
        return $this->hasMany(Adopcion::class);
    }
}