<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tiendas';

    protected $fillable = [
        'Nombre_tienda',
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