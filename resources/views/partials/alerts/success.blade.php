@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="alert-content">
        <i class="fas fa-check-circle alert-icon"></i>
        <div class="alert-text">
            <h5 class="alert-title">¡Mascota Registrada con Éxito!</h5>
            <p class="alert-message">La mascota ha sido registrada correctamente en el sistema.</p>
            @if(is_string(session('success')) && session('success') != '')
                <small class="alert-details">{{ session('success') }}</small>
            @endif
        </div>
    </div>
    <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif