<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $fillable = [
        'Nombre_rep',
        'Fecha_reporte',
        'Descripcion',
        'Email',
        'administrador_id'
    ];

    // Relaciones
    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }
}