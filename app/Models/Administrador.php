<?php

namespace App\Models;

//---------------------------------------------------------
// Posible eliminacion por el problema de autenticación
//---------------------------------------------------------

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'Nombre_1',
        'Nombre_2',
        'Apellido_1',
        'Apellido_2',
        'Fecha_nacimiento',
        'Direccion',
        'Telefono',
        'Email',
        'Password_admin',
        'Sueldo_admin'
    ];

    protected $hidden = [
        'Password_admin'
    ];

    // Relaciones
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    public function rescates()
    {
        return $this->hasMany(Rescate::class);
    }

    public function solicitudAdopcion()
    {
        return $this->hasMany(solicitudAdopcion::class);
    }
}