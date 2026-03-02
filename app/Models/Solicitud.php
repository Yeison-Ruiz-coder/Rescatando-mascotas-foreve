<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'tipo_solicitud',
        'contenido',
        'fecha_solicitud',
        'estado',
        'razon_rechazo',
        'notas_internas',
        'user_id',
        'nombre_solicitante',
        'email_solicitante',
        'telefono_solicitante',
        'solicitable_id',
        'solicitable_type',
        'revisado_por',
        'fecha_revision',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_revision' => 'datetime',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    // Relación polimórfica - puede ser para mascota, ayuda económica, etc.
    public function solicitable()
    {
        return $this->morphTo();
    }

    public function adopcion()
    {
        return $this->hasOne(Adopcion::class, 'solicitud_id');
    }

    // Scopes útiles
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_solicitud', $tipo);
    }
}
