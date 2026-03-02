<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAdopcion extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_adopcion';

    protected $fillable = [
        // Datos del solicitante
        'nombre_solicitante',
        'apellido_solicitante',
        'email',
        'telefono',
        'direccion',
        'experiencia_mascotas',
        'tipo_vivienda',
        'motivo_adopcion',

        // Compromisos
        'compromiso_cuidado',
        'compromiso_esterilizacion',
        'compromiso_seguimiento',

        // Estado y gestión
        'estado',
        'razon_rechazo',
        'notas_administrador',

        // Relaciones
        'user_id',
        'mascota_id',
        'revisado_por',
    ];

    protected $casts = [
        'compromiso_cuidado' => 'boolean',
        'compromiso_esterilizacion' => 'boolean',
        'compromiso_seguimiento' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * RELACIONES
     */

    // Solicitante registrado (puede ser null si no está registrado)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mascota solicitada
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id');
    }

    // Administrador que revisó la solicitud
    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    // Relación con adopción (cuando se aprueba)
    public function adopcion()
    {
        return $this->hasOne(Adopcion::class, 'solicitud_id');
    }

    /**
     * SCOPES - Consultas comunes
     */

    // Solicitudes pendientes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'Pendiente');
    }

    // Solicitudes en revisión
    public function scopeEnRevision($query)
    {
        return $query->where('estado', 'En revisión');
    }

    // Solicitudes aprobadas
    public function scopeAprobadas($query)
    {
        return $query->where('estado', 'Aprobada');
    }

    // Solicitudes rechazadas
    public function scopeRechazadas($query)
    {
        return $query->where('estado', 'Rechazada');
    }

    // Solicitudes por mascota
    public function scopePorMascota($query, $mascotaId)
    {
        return $query->where('mascota_id', $mascotaId);
    }

    // Solicitudes por email (búsqueda)
    public function scopePorEmail($query, $email)
    {
        return $query->where('email', 'like', "%{$email}%");
    }

    /**
     * MÉTODOS ÚTILES
     */

    // Obtener nombre completo del solicitante
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre_solicitante . ' ' . $this->apellido_solicitante);
    }

    // Verificar si está pendiente
    public function isPendiente(): bool
    {
        return $this->estado === 'Pendiente';
    }

    // Verificar si está aprobada
    public function isAprobada(): bool
    {
        return $this->estado === 'Aprobada';
    }

    // Verificar si está rechazada
    public function isRechazada(): bool
    {
        return $this->estado === 'Rechazada';
    }

    // Verificar si todos los compromisos están aceptados
    public function compromisosCompletos(): bool
    {
        return $this->compromiso_cuidado &&
               $this->compromiso_esterilizacion &&
               $this->compromiso_seguimiento;
    }

    // Aprobar solicitud
    public function aprobar(int $revisorId): void
    {
        $this->estado = 'Aprobada';
        $this->revisado_por = $revisorId;
        $this->save();
    }

    // Rechazar solicitud
    public function rechazar(int $revisorId, string $razon): void
    {
        $this->estado = 'Rechazada';
        $this->razon_rechazo = $razon;
        $this->revisado_por = $revisorId;
        $this->save();
    }

    // Poner en revisión
    public function ponerEnRevision(int $revisorId): void
    {
        $this->estado = 'En revisión';
        $this->revisado_por = $revisorId;
        $this->save();
    }

    /**
     * BOOT - Eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Al crear una solicitud, verificar que la mascota esté disponible
        static::creating(function ($solicitud) {
            $mascota = Mascota::find($solicitud->mascota_id);
            if ($mascota && $mascota->estado !== 'En adopcion') {
                throw new \Exception('La mascota no está disponible para adopción');
            }
        });

        // Al aprobar una solicitud, actualizar estado de la mascota
        static::updated(function ($solicitud) {
            if ($solicitud->isAprobada() && $solicitud->wasChanged('estado')) {
                $mascota = $solicitud->mascota;
                if ($mascota && $mascota->estado === 'En adopcion') {
                    $mascota->estado = 'Adoptado';
                    $mascota->save();
                }
            }
        });
    }
}
