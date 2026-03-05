{{-- RAZAS --}}
<div class="card shadow mb-4">
    <div class="card-header fw-bold bg-turquesa text-white">
        <i class="fas fa-paw me-2"></i>Raza / Cruce
    </div>
    <div class="card-body">
        @forelse ($mascota->razas as $raza)
            <span class="badge bg-info text-white fs-6 me-2 mb-2 p-2">{{ $raza->nombre_raza }}</span>
        @empty
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-2"></i>
                No hay información de raza registrada.
            </p>
        @endforelse
    </div>
</div>
