{{-- resources/views/admin/solicitud/partials/create/_form.blade.php --}}
<div class="create-form-container">
    <form action="{{ route('admin.solicitudes.store') }}" method="POST" class="solicitud-form">
        @csrf

        <div class="form-grid">
            <!-- Información del Solicitante -->
            <div class="form-group">
                <label for="user_id">
                    <i class="fa-solid fa-user"></i> Usuario Registrado (opcional):
                </label>
                <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                    <option value="">Selecciona un usuario (o completa datos manual)</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->email }} - {{ $usuario->name ?? $usuario->nombre_completo }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Separador: Datos manuales (se ocultan si hay user_id) -->
            <div id="datosManuales" class="form-group full-width">
                <h4>Datos del Solicitante (si no es usuario registrado)</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre_solicitante">Nombre:</label>
                        <input type="text" id="nombre_solicitante" name="nombre_solicitante"
                               value="{{ old('nombre_solicitante') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email_solicitante">Email:</label>
                        <input type="email" id="email_solicitante" name="email_solicitante"
                               value="{{ old('email_solicitante') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono_solicitante">Teléfono:</label>
                        <input type="text" id="telefono_solicitante" name="telefono_solicitante"
                               value="{{ old('telefono_solicitante') }}" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Tipo de Solicitud -->
            <div class="form-group">
                <label for="tipo_solicitud">
                    <i class="fa-solid fa-tag"></i> Tipo de Solicitud:
                </label>
                <select id="tipo_solicitud" name="tipo_solicitud" required class="form-control @error('tipo_solicitud') is-invalid @enderror">
                    <option value="">Selecciona un tipo</option>
                    <option value="adopcion" {{ old('tipo_solicitud') == 'adopcion' ? 'selected' : '' }}>Adopción</option>
                    <option value="rescate" {{ old('tipo_solicitud') == 'rescate' ? 'selected' : '' }}>Rescate</option>
                    <option value="apadrinamiento" {{ old('tipo_solicitud') == 'apadrinamiento' ? 'selected' : '' }}>Apadrinamiento</option>
                    <option value="donacion" {{ old('tipo_solicitud') == 'donacion' ? 'selected' : '' }}>Donación</option>
                    <option value="otro" {{ old('tipo_solicitud') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo_solicitud')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Item Solicitado (Mascota) -->
            <div class="form-group">
                <label for="solicitable_id">
                    <i class="fa-solid fa-paw"></i> Mascota:
                </label>
                <select id="solicitable_id" name="solicitable_id" required class="form-control @error('solicitable_id') is-invalid @enderror">
                    <option value="">Selecciona una mascota</option>
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->id }}" {{ old('solicitable_id') == $mascota->id ? 'selected' : '' }}>
                            {{ $mascota->nombre }} ({{ $mascota->especie }})
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="solicitable_type" value="App\Models\Mascota">
                @error('solicitable_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Campos específicos para adopción (se muestran solo si se selecciona adopción) -->
        <div id="camposAdopcion" style="display: none;">
            <h4><i class="fa-solid fa-file-signature"></i> Detalles de Adopción</h4>
            <div class="form-grid">
                <div class="form-group">
                    <label for="datos_adopcion_apellido">Apellido:</label>
                    <input type="text" id="datos_adopcion_apellido" name="datos_adopcion[apellido_solicitante]"
                           value="{{ old('datos_adopcion.apellido_solicitante') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="datos_adopcion_direccion">Dirección:</label>
                    <input type="text" id="datos_adopcion_direccion" name="datos_adopcion[direccion]"
                           value="{{ old('datos_adopcion.direccion') }}" class="form-control">
                </div>

                <div class="form-group full-width">
                    <label for="datos_adopcion_experiencia">Experiencia con mascotas:</label>
                    <textarea id="datos_adopcion_experiencia" name="datos_adopcion[experiencia_mascotas]"
                              rows="3" class="form-control">{{ old('datos_adopcion.experiencia_mascotas') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="datos_adopcion_tipo_vivienda">Tipo de vivienda:</label>
                    <select id="datos_adopcion_tipo_vivienda" name="datos_adopcion[tipo_vivienda]" class="form-control">
                        <option value="">Selecciona...</option>
                        <option value="casa" {{ old('datos_adopcion.tipo_vivienda') == 'casa' ? 'selected' : '' }}>Casa</option>
                        <option value="apartamento" {{ old('datos_adopcion.tipo_vivienda') == 'apartamento' ? 'selected' : '' }}>Apartamento</option>
                        <option value="finca" {{ old('datos_adopcion.tipo_vivienda') == 'finca' ? 'selected' : '' }}>Finca</option>
                        <option value="otro" {{ old('datos_adopcion.tipo_vivienda') == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="datos_adopcion_motivo">Motivo de adopción:</label>
                    <textarea id="datos_adopcion_motivo" name="datos_adopcion[motivo_adopcion]"
                              rows="3" class="form-control">{{ old('datos_adopcion.motivo_adopcion') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label>Compromisos:</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="datos_adopcion[compromiso_cuidado]" value="1"
                                   {{ old('datos_adopcion.compromiso_cuidado') ? 'checked' : '' }}>
                            Compromiso de cuidado responsable
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="datos_adopcion[compromiso_esterilizacion]" value="1"
                                   {{ old('datos_adopcion.compromiso_esterilizacion') ? 'checked' : '' }}>
                            Compromiso de esterilización
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="datos_adopcion[compromiso_seguimiento]" value="1"
                                   {{ old('datos_adopcion.compromiso_seguimiento') ? 'checked' : '' }}>
                            Acepta seguimiento post-adopción
                        </label>
                    </div>
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

        <!-- Botones de Acción -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-plus"></i> Crear Solicitud
            </button>
            <a href="{{ route('admin.solicitudes.index') }}" class="btn-cancel">
                <i class="fa-solid fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar/ocultar datos manuales según selección de usuario
    const userSelect = document.getElementById('user_id');
    const datosManuales = document.getElementById('datosManuales');

    function toggleDatosManuales() {
        if (userSelect.value) {
            datosManuales.style.display = 'none';
            // Limpiar campos manuales si se seleccionó usuario
            document.getElementById('nombre_solicitante').value = '';
            document.getElementById('email_solicitante').value = '';
            document.getElementById('telefono_solicitante').value = '';
        } else {
            datosManuales.style.display = 'block';
        }
    }

    userSelect.addEventListener('change', toggleDatosManuales);
    toggleDatosManuales();

    // Mostrar/ocultar campos de adopción según tipo
    const tipoSelect = document.getElementById('tipo_solicitud');
    const camposAdopcion = document.getElementById('camposAdopcion');

    function toggleCamposAdopcion() {
        if (tipoSelect.value === 'adopcion') {
            camposAdopcion.style.display = 'block';
        } else {
            camposAdopcion.style.display = 'none';
        }
    }

    tipoSelect.addEventListener('change', toggleCamposAdopcion);
    toggleCamposAdopcion();
});
</script>
