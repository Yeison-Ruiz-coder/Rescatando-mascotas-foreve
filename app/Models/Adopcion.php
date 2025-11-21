<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;

    protected $table = 'adopciones';

    protected $fillable = [
        'Lugar_adopcion',
        'Fecha_adopcion',
        'estado',
        'razon_rechazo',
        'fecha_cierre',
        'usuario_id',
        'mascota_id',
        'administrador_id',
        'fundacion_id'
    ];

    protected $casts = [
        'Fecha_adopcion' => 'date',
        'fecha_cierre' => 'date',
    ];

    // Relaciones CORREGIDAS
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'administrador_id');
    }

    public function fundacion()
    {
        return $this->belongsTo(Fundacion::class, 'fundacion_id');
    }

    // Entrevistas - la dejamos para después
    public function entrevistas()
    {
        return $this->hasMany(Entrevista::class, 'adopcion_id');
    }
}
