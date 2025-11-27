{{-- resources/views/admin/adopciones/partials/edit/_header.blade.php --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="edit-adopcion-header text-center">
            <h1 class="display-5 fw-bold text-turquesa">
                <i class="fas fa-edit me-3"></i>Editar Adopción
            </h1>
            <p class="lead text-dark-custom">
                Actualiza la información de la adopción 
                @if($adopcion->mascota && $adopcion->usuario)
                    de <strong class="text-fucsia">{{ $adopcion->mascota->Nombre_mascota }}</strong> 
                    para <strong class="text-turquesa">{{ $adopcion->usuario->Nombre_1 }}</strong>
                @else
                    <strong class="text-turquesa">ID: #{{ $adopcion->id }}</strong>
                @endif
            </p>
        </div>
    </div>
</div>