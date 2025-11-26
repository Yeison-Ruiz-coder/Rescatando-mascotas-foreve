<div class="seccion-formulario animacion-entrada">
    <h5>
        <i class="fas fa-user-circle"></i>Tus Datos Personales
    </h5>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label-solicitud">
                <i class="fas fa-signature"></i>Nombre
            </label>
            <input type="text" class="form-control-solicitud @error('nombre') is-invalid @enderror" 
                   id="nombre" name="nombre" 
                   value="{{ old('nombre') }}" 
                   placeholder="Ingresa tu nombre" required>
            @error('nombre')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="apellido" class="form-label-solicitud">
                <i class="fas fa-signature"></i>Apellido
            </label>
            <input type="text" class="form-control-solicitud @error('apellido') is-invalid @enderror" 
                   id="apellido" name="apellido" 
                   value="{{ old('apellido') }}" 
                   placeholder="Ingresa tu apellido" required>
            @error('apellido')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label-solicitud">
                <i class="fas fa-envelope"></i>Email
            </label>
            <input type="email" class="form-control-solicitud @error('email') is-invalid @enderror" 
                   id="email" name="email" 
                   value="{{ old('email') }}" 
                   placeholder="tu@email.com" required>
            @error('email')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="telefono" class="form-label-solicitud">
                <i class="fas fa-phone"></i>Teléfono
            </label>
            <input type="tel" class="form-control-solicitud @error('telefono') is-invalid @enderror" 
                   id="telefono" name="telefono" 
                   value="{{ old('telefono') }}" 
                   placeholder="+57 300 123 4567" required>
            @error('telefono')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="direccion" class="form-label-solicitud">
            <i class="fas fa-map-marker-alt"></i>Dirección Completa
        </label>
        <textarea class="form-control-solicitud @error('direccion') is-invalid @enderror" 
                  id="direccion" name="direccion" 
                  rows="3" 
                  placeholder="Ingresa tu dirección completa (ciudad, barrio, dirección)" 
                  required>{{ old('direccion') }}</textarea>
        @error('direccion')
            <div class="mensaje-error">
                <i class="fas fa-exclamation-circle"></i>{{ $message }}
            </div>
        @enderror
    </div>
</div>