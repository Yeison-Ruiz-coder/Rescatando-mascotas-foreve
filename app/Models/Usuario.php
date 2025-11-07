<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'Nombre_1',
        'Nombre_2',
        'Apellido_1',
        'Apellido_2',
        'Fecha_nacimiento',
        'Direccion',
        'Telefono',
        'Email',
        'Password_user',
        'tipo',
        'administrador_id'
    ];

    protected $hidden = [
        'Password_user'
    ];

    // Relaciones
    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class);
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class);
    }

    public function rescates()
    {
        return $this->hasMany(Rescate::class);
    }
}