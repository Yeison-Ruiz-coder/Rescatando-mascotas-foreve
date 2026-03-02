<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reporte extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reportes';

    protected $fillable = [
        'tipo_reporte',
        'titulo',
        'descripcion',
        'ubicacion',
        'fecha_incidente',
        'especie',
        'raza',
        'color',
        'foto_url',
        'galeria_fotos',
        'estado',
        'user_id',
        'nombre_reportante',
        'telefono_reportante',
        'email_reportante',
        'solucion',
        'resuelto_por',
        'fecha_resolucion',
    ];

    protected $casts = [
        'galeria_fotos' => 'array',
        'fecha_incidente' => 'date',
        'fecha_resolucion' => 'datetime',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resueltoPor()
    {
        return $this->belongsTo(User::class, 'resuelto_por');
    }

    public function rescate()
    {
        return $this->hasOne(Rescate::class, 'reporte_id');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopePerdidos($query)
    {
        return $query->where('tipo_reporte', 'perdido');
    }

    public function scopeEncontrados($query)
    {
        return $query->where('tipo_reporte', 'encontrado');
    }
}
