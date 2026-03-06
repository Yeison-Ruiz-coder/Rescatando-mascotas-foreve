<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb breadcrumb-solicitud">
        <li class="breadcrumb-item">
            <a href="{{ route('public.mascotas.index') }}">
                <i class="fas fa-paw me-1"></i>Mascotas
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('public.mascotas.show', $mascota->id) }}">
                {{ $mascota->nombre_mascota }}
            </a>
        </li>
        <li class="breadcrumb-item active">Solicitar Adopción</li>
    </ol>
</nav>
