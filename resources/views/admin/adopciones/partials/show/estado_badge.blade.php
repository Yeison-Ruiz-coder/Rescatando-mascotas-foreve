<span class="badge
    @if($adopcion->estado == 'completada') bg-success
    @elseif($adopcion->estado == 'en_proceso') bg-warning text-dark
    @elseif($adopcion->estado == 'aprobada') bg-info
    @elseif($adopcion->estado == 'rechazada') bg-danger
    @else bg-secondary
    @endif" style="font-size: 0.9rem; padding: 0.5rem 1rem;">

    @if($adopcion->estado == 'en_proceso') En Proceso
    @elseif($adopcion->estado == 'aprobada') Aprobada
    @elseif($adopcion->estado == 'completada') Completada
    @elseif($adopcion->estado == 'rechazada') Rechazada
    @elseif($adopcion->estado == 'cancelada') Cancelada
    @else {{ ucfirst($adopcion->estado) }}
    @endif
</span>
