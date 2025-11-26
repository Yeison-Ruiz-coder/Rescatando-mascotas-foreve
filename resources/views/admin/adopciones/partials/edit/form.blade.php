{{-- resources/views/admin/adopciones/partials/edit/_form.blade.php --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-turquesa text-white py-3">
        <h5 class="mb-0">
            <i class="fas fa-paw me-2"></i>Formulario de Edición de Adopción
        </h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.adopciones.update', $adopcion->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Selección de Mascota -->
                <div class="col-md-6 mb-3">
                    <label for="mascota_id" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-paw me-2"></i>Mascota *
                    </label>
                    <select class="form-select @error('mascota_id') is-invalid @enderror" 
                            id="mascota_id" name="mascota_id" required>
                        <option value="">Selecciona una mascota</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}" 
                                {{ $adopcion->mascota_id == $mascota->id ? 'selected' : '' }}>
                                {{ $mascota->Nombre_mascota }} ({{ $mascota->Especie }} - {{ $mascota->Raza }})
                            </option>
                        @endforeach
                    </select>
                    @error('mascota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Selección de Usuario -->
                <div class="col-md-6 mb-3">
                    <label for="usuario_id" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-user me-2"></i>Adoptante *
                    </label>
                    <select class="form-select @error('usuario_id') is-invalid @enderror" 
                            id="usuario_id" name="usuario_id" required>
                        <option value="">Selecciona un adoptante</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" 
                                {{ $adopcion->usuario_id == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->Nombre_1 }} {{ $usuario->Apellido_1 }} - {{ $usuario->Email }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Fecha de Adopción -->
                <div class="col-md-6 mb-3">
                    <label for="Fecha_adopcion" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-calendar me-2"></i>Fecha de Adopción *
                    </label>
                    <input type="date" class="form-control @error('Fecha_adopcion') is-invalid @enderror" 
                           id="Fecha_adopcion" name="Fecha_adopcion" 
                           value="{{ old('Fecha_adopcion', $adopcion->Fecha_adopcion->format('Y-m-d')) }}" required>
                    @error('Fecha_adopcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lugar de Adopción -->
                <div class="col-md-6 mb-3">
                    <label for="Lugar_adopcion" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-map-marker-alt me-2"></i>Lugar de Adopción *
                    </label>
                    <input type="text" class="form-control @error('Lugar_adopcion') is-invalid @enderror" 
                           id="Lugar_adopcion" name="Lugar_adopcion" 
                           value="{{ old('Lugar_adopcion', $adopcion->Lugar_adopcion) }}" 
                           placeholder="Ej: Bogotá, Medellín..." required>
                    @error('Lugar_adopcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Estado de la Adopción -->
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-tasks me-2"></i>Estado de la Adopción *
                    </label>
                    <select class="form-select @error('estado') is-invalid @enderror" 
                            id="estado" name="estado" required>
                        <option value="En proceso" {{ $adopcion->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="Aprobado" {{ $adopcion->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                        <option value="Rechazado" {{ $adopcion->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                        <option value="Completado" {{ $adopcion->estado == 'Completado' ? 'selected' : '' }}>Completado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha de Cierre -->
                <div class="col-md-6 mb-3">
                    <label for="fecha_cierre" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-calendar-check me-2"></i>Fecha de Cierre
                    </label>
                    <input type="date" class="form-control @error('fecha_cierre') is-invalid @enderror" 
                           id="fecha_cierre" name="fecha_cierre" 
                           value="{{ old('fecha_cierre', $adopcion->fecha_cierre ? $adopcion->fecha_cierre->format('Y-m-d') : '') }}">
                    @error('fecha_cierre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Administrador Responsable -->
                <div class="col-md-6 mb-3">
                    <label for="administrador_id" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-user-shield me-2"></i>Administrador Responsable
                    </label>
                    <select class="form-select @error('administrador_id') is-invalid @enderror" 
                            id="administrador_id" name="administrador_id">
                        <option value="">Selecciona un administrador</option>
                        @foreach($administradores as $admin)
                            <option value="{{ $admin->id }}" 
                                {{ $adopcion->administrador_id == $admin->id ? 'selected' : '' }}>
                                {{ $admin->Nombre_1 }} {{ $admin->Apellido_1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('administrador_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fundación -->
                <div class="col-md-6 mb-3">
                    <label for="fundacion_id" class="form-label fw-bold text-turquesa">
                        <i class="fas fa-home me-2"></i>Fundación
                    </label>
                    <select class="form-select @error('fundacion_id') is-invalid @enderror" 
                            id="fundacion_id" name="fundacion_id">
                        <option value="">Selecciona una fundación</option>
                        @foreach($fundaciones as $fundacion)
                            <option value="{{ $fundacion->id }}" 
                                {{ $adopcion->fundacion_id == $fundacion->id ? 'selected' : '' }}>
                                {{ $fundacion->Nombre_1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('fundacion_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Razón de Rechazo (condicional) -->
            <div class="mb-3" id="razon_rechazo_container" 
                 style="{{ $adopcion->estado == 'Rechazado' ? '' : 'display: none;' }}">
                <label for="razon_rechazo" class="form-label fw-bold text-turquesa">
                    <i class="fas fa-exclamation-triangle me-2"></i>Razón de Rechazo
                </label>
                <textarea class="form-control @error('razon_rechazo') is-invalid @enderror" 
                          id="razon_rechazo" name="razon_rechazo" 
                          rows="3" placeholder="Explique la razón del rechazo...">{{ old('razon_rechazo', $adopcion->razon_rechazo) }}</textarea>
                @error('razon_rechazo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones de Acción -->
            @include('admin.adopciones.partials.edit.actions')

        </form>
    </div>
</div>