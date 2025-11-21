{{-- RAZAS --}}
<div class="card shadow mb-4">
    <div class="card-header fw-bold">
        <i class="fas fa-paw me-2"></i>Raza / Cruce
    </div>
    <div class="card-body">
        @forelse ($mascota->razas as $raza)
            <span class="badge raza-badge fs-6 me-2 mb-2">{{ $raza->nombre_raza }}</span>
        @empty
            <p class="text-muted">No hay información de raza registrada.</p>
        @endforelse
    </div>
</div>