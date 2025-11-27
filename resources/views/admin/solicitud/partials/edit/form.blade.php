{{-- resources/views/admin/solicitud/partials/edit/_form.blade.php --}}
<div class="edit-form-container">
    <form action="{{ route('solicitud.update', $solicitud) }}" method="POST" class="solicitud-form">
        @csrf
        @method('PUT')

        <!-- INFORMACIÓN DE SOLICITANTE (Solo lectura) -->
<div class="edit-form-container">
    <form action="{{ route('solicitud.update', $solicitud) }}" method="POST" class="solicitud-form">
        @csrf
        @method('PUT')

        <!-- CAMPO OCULTO PARA usuario_id -->
        <input type="hidden" name="usuario_id" value="{{ $solicitud->usuario_id }}">

        <!-- INFORMACIÓN DE SOLICITANTE (Solo lectura) -->
        <div class="info-card">
            <div class="info-grid">
                <div class="info-item">
                
                @if($solicitud->mascota)
                <div class="info-item">
                    <strong>Nombre del solicitante:</strong>
                    <span>{{ $solicitud->usuario->nombre_completo }}</span>
                </div>
                @endif
                @if($solicitud->mascota)
                <div class="info-item">
                    <strong>Mascota solicitada:</strong>
                    <span>{{ $solicitud->mascota->Nombre_mascota }} ({{ $solicitud->mascota->Especie }})</span>
                </div>
                @endif
            </div>
        </div>

        <div class="form-grid">
            <!-- Tipo de Solicitud -->
            <div class="form-group">
                <label for="tipo">
                    <i class="fa-solid fa-tag"></i> Tipo de Solicitud:
                </label>
                <select id="tipo" name="tipo" required class="form-control @error('tipo') is-invalid @enderror">
                    <option value="">Selecciona un tipo</option>
                    <option value="Para Adoptar" {{ old('tipo', $solicitud->tipo) == 'Para Adoptar' ? 'selected' : '' }}>Para Adoptar</option>
                    <option value="Para Rescatar" {{ old('tipo', $solicitud->tipo) == 'Para Rescatar' ? 'selected' : '' }}>Para Rescatar</option>
                    <option value="Para Apadrinar" {{ old('tipo', $solicitud->tipo) == 'Para Apadrinar' ? 'selected' : '' }}>Para Apadrinar</option>
                    <option value="Para Donar" {{ old('tipo', $solicitud->tipo) == 'Para Donar' ? 'selected' : '' }}>Para Donar</option>
                </select>
                @error('tipo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="estado">
                    <i class="fa-solid fa-circle-check"></i> Estado:
                </label>
                <select id="estado" name="estado" required class="form-control @error('estado') is-invalid @enderror">
                    <option value="En Revisión" {{ old('estado', $solicitud->estado) == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
                    <option value="Aprobada" {{ old('estado', $solicitud->estado) == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="Rechazada" {{ old('estado', $solicitud->estado) == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
                @error('estado')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Solicitud -->
            <div class="form-group">
                <label for="fecha_solicitud">
                    <i class="fa-solid fa-calendar"></i> Fecha de Solicitud:
                </label>
                <input type="datetime-local" id="fecha_solicitud" name="fecha_solicitud" 
                       value="{{ old('fecha_solicitud', $solicitud->fecha_solicitud->format('Y-m-d\TH:i')) }}" 
                       required class="form-control @error('fecha_solicitud') is-invalid @enderror">
                @error('fecha_solicitud')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Contenido / Justificación -->
        <div class="form-group full-width">
            <label for="contenido">
                <i class="fa-solid fa-file-lines"></i> Contenido / Justificación:
            </label>
            <textarea id="contenido" name="contenido" rows="10" required 
                      class="form-control @error('contenido') is-invalid @enderror"
                      placeholder="Describe los detalles de la solicitud...">{{ old('contenido', $solicitud->contenido) }}</textarea>
            @error('contenido')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="help-text">
                <i class="fa-solid fa-info-circle"></i> Aquí puedes modificar o añadir notas internas sobre la justificación del solicitante.
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> Guardar Cambios
            </button>
            <a href="{{ route('solicitud.show', $solicitud) }}" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
            <a href="{{ route('solicitud.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </form>
</div>