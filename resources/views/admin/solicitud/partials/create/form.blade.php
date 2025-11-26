{{-- resources/views/admin/solicitud/partials/create/_form.blade.php --}}
<div class="create-form-container">
    <form action="{{ route('solicitud.store') }}" method="POST" class="solicitud-form">
        @csrf

        <div class="form-grid">
            <!-- Información del Solicitante -->
            <div class="form-group">
                <label for="usuario_id">
                    <i class="fa-solid fa-user"></i> Solicitante:
                </label>
                <select id="usuario_id" name="usuario_id" required class="form-control @error('usuario_id') is-invalid @enderror">
                    <option value="">Selecciona un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }} ({{ $usuario->email }})
                        </option>
                    @endforeach
                </select>
                @error('usuario_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo de Solicitud -->
            <div class="form-group">
                <label for="tipo">
                    <i class="fa-solid fa-tag"></i> Tipo de Solicitud:
                </label>
                <select id="tipo" name="tipo" required class="form-control @error('tipo') is-invalid @enderror">
                    <option value="">Selecciona un tipo</option>
                    <option value="Para Adoptar" {{ old('tipo') == 'Para Adoptar' ? 'selected' : '' }}>Para Adoptar</option>
                    <option value="Para Rescatar" {{ old('tipo') == 'Para Rescatar' ? 'selected' : '' }}>Para Rescatar</option>
                    <option value="Para Apadrinar" {{ old('tipo') == 'Para Apadrinar' ? 'selected' : '' }}>Para Apadrinar</option>
                    <option value="Para Donar" {{ old('tipo') == 'Para Donar' ? 'selected' : '' }}>Para Donar</option>
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
                    <option value="En Revisión" {{ old('estado', 'En Revisión') == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
                    <option value="Aprobada" {{ old('estado') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="Rechazada" {{ old('estado') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
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
                       value="{{ old('fecha_solicitud') }}" 
                       required class="form-control @error('fecha_solicitud') is-invalid @enderror">
                @error('fecha_solicitud')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <div class="help-text">
                    <i class="fa-solid fa-info-circle"></i> Se autocompletará con la fecha y hora actual
                </div>
            </div>
        </div>

        <!-- Contenido / Justificación -->
        <div class="form-group full-width">
            <label for="contenido">
                <i class="fa-solid fa-file-lines"></i> Contenido / Justificación:
            </label>
            <textarea id="contenido" name="contenido" rows="10" required 
                      class="form-control @error('contenido') is-invalid @enderror"
                      placeholder="Describe los detalles de la solicitud, justificación, observaciones...">{{ old('contenido') }}</textarea>
            @error('contenido')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="help-text">
                <i class="fa-solid fa-info-circle"></i> Describe detalladamente la solicitud. Mínimo 10 caracteres.
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="info-card">
            <h5><i class="fa-solid fa-lightbulb"></i> Información Importante</h5>
            <ul>
                <li>Las solicitudes creadas aparecerán en el listado principal</li>
                <li>El estado por defecto es "En Revisión"</li>
                <li>Puedes editar la solicitud después de crearla</li>
                <li>Verifica que todos los datos sean correctos antes de guardar</li>
            </ul>
        </div>

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-plus"></i> Crear Solicitud
            </button>
            <a href="{{ route('solicitud.index') }}" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>