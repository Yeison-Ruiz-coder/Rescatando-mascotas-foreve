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
        'Email',
        'registro_sanitario',
        'capacidad_maxima',
        'necesidades_actuales',
        'horario_atencion',
        'recibe_voluntarios',
    ];

    protected $casts = [
        'necesidades_actuales' => 'array',
        'recibe_voluntarios' => 'boolean',
        'capacidad_maxima' => 'integer',
    ];

    // Relaciones
    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'fundacion_id');
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'fundacion_id');
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'fundacion_id');
    }

    public function rescates()
    {
        return $this->hasMany(Rescate::class, 'fundacion_id');
    }

    public function usuariosFundacion()
    {
        return $this->hasMany(User::class, 'fundacion_id');
    }

    // Scope para fundaciones que reciben voluntarios
    public function scopeRecibenVoluntarios($query)
    {
        return $query->where('recibe_voluntarios', true);
    }
}
