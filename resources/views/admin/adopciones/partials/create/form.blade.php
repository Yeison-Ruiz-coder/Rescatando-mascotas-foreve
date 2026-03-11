<form action="{{ route('admin.adopciones.store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- Mascota -->
        <div class="col-md-6 mb-3">
            <label for="mascota_id" class="form-label">Mascota <span class="text-danger">*</span></label>
            <select name="mascota_id" id="mascota_id" class="form-select @error('mascota_id') is-invalid @enderror" required>
                <option value="">Seleccione una mascota</option>
                @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->id }}" {{ old('mascota_id') == $mascota->id ? 'selected' : '' }}>
                        {{ $mascota->nombre }} ({{ $mascota->especie }})
                    </option>
                @endforeach
            </select>
            @error('mascota_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Usuario (Adoptante) -->
        <div class="col-md-6 mb-3">
            <label for="user_id" class="form-label">Adoptante <span class="text-danger">*</span></label>
            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                <option value="">Seleccione un adoptante</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }} - {{ $usuario->email }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fundación -->
        <div class="col-md-6 mb-3">
            <label for="fundacion_id" class="form-label">Fundación</label>
            <select name="fundacion_id" id="fundacion_id" class="form-select @error('fundacion_id') is-invalid @enderror">
                <option value="">Seleccione una fundación</option>
                @foreach($fundaciones as $fundacion)
                    <option value="{{ $fundacion->id }}" {{ old('fundacion_id') == $fundacion->id ? 'selected' : '' }}>
                        {{ $fundacion->nombre }}
                    </option>
                @endforeach
            </select>
            @error('fundacion_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Solicitud (opcional) -->
        <div class="col-md-6 mb-3">
            <label for="solicitud_id" class="form-label">Solicitud Asociada</label>
            <select name="solicitud_id" id="solicitud_id" class="form-select @error('solicitud_id') is-invalid @enderror">
                <option value="">Ninguna (creación directa)</option>
                @foreach($solicitudes as $solicitud)
                    <option value="{{ $solicitud->id }}" {{ old('solicitud_id') == $solicitud->id ? 'selected' : '' }}>
                        Solicitud #{{ $solicitud->id }} - {{ $solicitud->user->name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
            @error('solicitud_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha de Adopción -->
        <div class="col-md-4 mb-3">
            <label for="fecha_adopcion" class="form-label">Fecha de Adopción</label>
            <input type="date" name="fecha_adopcion" id="fecha_adopcion"
                   class="form-control @error('fecha_adopcion') is-invalid @enderror"
                   value="{{ old('fecha_adopcion', date('Y-m-d')) }}">
            @error('fecha_adopcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="col-md-4 mb-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="">Seleccione un estado</option>
                @foreach($estados as $value => $label)
                    <option value="{{ $value }}" {{ old('estado') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha de Cierre -->
        <div class="col-md-4 mb-3">
            <label for="fecha_cierre" class="form-label">Fecha de Cierre</label>
            <input type="date" name="fecha_cierre" id="fecha_cierre"
                   class="form-control @error('fecha_cierre') is-invalid @enderror"
                   value="{{ old('fecha_cierre') }}">
            @error('fecha_cierre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Razón de Rechazo (visible solo si estado es rechazada/cancelada) -->
        <div class="col-12 mb-3 razon-rechazo-container" style="display: none;">
            <label for="razon_rechazo" class="form-label">Razón de Rechazo/Cancelación</label>
            <textarea name="razon_rechazo" id="razon_rechazo" rows="3"
                      class="form-control @error('razon_rechazo') is-invalid @enderror">{{ old('razon_rechazo') }}</textarea>
            @error('razon_rechazo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Botones -->
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.adopciones.index') }}" class="btn btn-secondary">
            <i class="fas fa-times me-2"></i>Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Guardar Adopción
        </button>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('estado').addEventListener('change', function() {
    const razonContainer = document.querySelector('.razon-rechazo-container');
    if (this.value === 'rechazada' || this.value === 'cancelada') {
        razonContainer.style.display = 'block';
    } else {
        razonContainer.style.display = 'none';
    }
});

// Trigger inicial
if (document.getElementById('estado').value === 'rechazada' || document.getElementById('estado').value === 'cancelada') {
    document.querySelector('.razon-rechazo-container').style.display = 'block';
}
</script>
@endpush
