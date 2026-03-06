{{-- resources/views/admin/solicitud/partials/edit/_form.blade.php --}}
<div class="edit-form-container">
    <form action="{{ route('admin.solicitudes.update', $solicitud) }}" method="POST" class="solicitud-form">
        @csrf
        @method('PUT')

        <!-- CAMPO OCULTO PARA user_id -->
        <input type="hidden" name="user_id" value="{{ $solicitud->user_id }}">

        <!-- INFORMACIÓN DE SOLICITANTE (Solo lectura) -->
        <div class="info-card">
            <h4><i class="fa-solid fa-user"></i> Información del Solicitante</h4>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Nombre:</strong>
                    <span>
                        @if($solicitud->usuario)
                            {{ $solicitud->usuario->name ?? $solicitud->usuario->nombre_completo }}
                        @else
                            {{ $solicitud->nombre_solicitante }}
                            @if($solicitud->esAdopcion() && $apellido = $solicitud->getDatoAdopcion('apellido_solicitante'))
                                {{ $apellido }}
                            @endif
                        @endif
                    </span>
                </div>

                <div class="info-item">
                    <strong>Email:</strong>
                    <span>{{ $solicitud->email_solicitante ?? ($solicitud->usuario->email ?? 'No especificado') }}</span>
                </div>

                <div class="info-item">
                    <strong>Teléfono:</strong>
                    <span>{{ $solicitud->telefono_solicitante ?? 'No especificado' }}</span>
                </div>

                @if($solicitud->solicitable && $solicitud->solicitable_type == 'App\Models\Mascota')
                <div class="info-item">
                    <strong>Mascota solicitada:</strong>
                    <span>{{ $solicitud->solicitable->nombre ?? 'Mascota #' . $solicitud->solicitable_id }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="form-grid">
            <!-- Tipo de Solicitud -->
            <div class="form-group">
                <label for="tipo_solicitud">
                    <i class="fa-solid fa-tag"></i> Tipo de Solicitud:
                </label>
                <select id="tipo_solicitud" name="tipo_solicitud" required class="form-control @error('tipo_solicitud') is-invalid @enderror">
                    <option value="">Selecciona un tipo</option>
                    <option value="adopcion" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == 'adopcion' ? 'selected' : '' }}>Adopción</option>
                    <option value="rescate" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == 'rescate' ? 'selected' : '' }}>Rescate</option>
                    <option value="apadrinamiento" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == 'apadrinamiento' ? 'selected' : '' }}>Apadrinamiento</option>
                    <option value="donacion" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == 'donacion' ? 'selected' : '' }}>Donación</option>
                    <option value="otro" {{ old('tipo_solicitud', $solicitud->tipo_solicitud) == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo_solicitud')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="estado">
                    <i class="fa-solid fa-circle-check"></i> Estado:
                </label>
                <select id="estado" name="estado" required class="form-control @error('estado') is-invalid @enderror">
                    <option value="pendiente" {{ old('estado', $solicitud->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_revision" {{ old('estado', $solicitud->estado) == 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                    <option value="aprobada" {{ old('estado', $solicitud->estado) == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="rechazada" {{ old('estado', $solicitud->estado) == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                    <option value="completada" {{ old('estado', $solicitud->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
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

            <!-- Notas Internas (solo admin) -->
            <div class="form-group full-width">
                <label for="notas_internas">
                    <i class="fa-solid fa-lock"></i> Notas Internas (solo visible para administradores):
                </label>
                <textarea id="notas_internas" name="notas_internas" rows="4"
                          class="form-control @error('notas_internas') is-invalid @enderror"
                          placeholder="Notas internas, observaciones, seguimiento...">{{ old('notas_internas', $solicitud->notas_internas) }}</textarea>
                @error('notas_internas')
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
                <i class="fa-solid fa-info-circle"></i> Aquí puedes modificar o añadir notas sobre la justificación del solicitante.
            </div>
        </div>

        <!-- Razón de Rechazo (visible solo si está rechazada) -->
        @if($solicitud->isRechazada())
        <div class="form-group full-width">
            <label for="razon_rechazo">
                <i class="fa-solid fa-ban"></i> Razón de Rechazo:
            </label>
            <textarea id="razon_rechazo" name="razon_rechazo" rows="3"
                      class="form-control" readonly>{{ $solicitud->razon_rechazo }}</textarea>
        </div>
        @endif

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> Guardar Cambios
            </button>
            <a href="{{ route('admin.solicitudes.show', $solicitud) }}" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
            <a href="{{ route('admin.solicitudes.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </form>
</div>
