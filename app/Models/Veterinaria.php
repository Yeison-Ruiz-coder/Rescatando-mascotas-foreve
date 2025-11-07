<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinaria extends Model
{
    use HasFactory;

    protected $table = 'veterinarias';

    protected $fillable = [
        'Nombre_vet',
        'Direccion',
        'Telefono',
        'Email'
    ];

    // Relaciones
    public function rescates()
    {
        return $this->hasMany(Rescate::class);
    }
}