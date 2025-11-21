<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb breadcrumb-mascota">
        <li class="breadcrumb-item">
            <a href="{{ route('public.mascotas.index') }}" class="text-decoration-none">
                <i class="fas fa-arrow-left me-2"></i>Volver a Mascotas
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mascota->Nombre_mascota }}</li>
    </ol>
</nav>