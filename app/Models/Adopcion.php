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
        'usuario_id',
        'mascota_id'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
    
    // Si implementaste la tabla de Entrevistas (1:N)
   public function entrevistas()
    {
        // Una Adopción puede tener muchas Entrevistas (para seguimiento)
        return $this->hasMany(Entrevista::class, 'adopcion_id');
    }
}