<!-- Sección 5: Fechas y Fundación -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-calendar-alt me-2"></i>Fechas y Organización
    </h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="fecha_ingreso" class="form-label">
                Fecha de Ingreso <span class="required">*</span>
            </label>
            <input type="date"
                   class="form-control form-control-custom @error('fecha_ingreso') is-invalid @enderror"
                   id="fecha_ingreso"
                   name="fecha_ingreso"
                   value="{{ old('fecha_ingreso', $mascota->fecha_ingreso ? $mascota->fecha_ingreso->format('Y-m-d') : date('Y-m-d')) }}"
                   required>
            @error('fecha_ingreso')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="fecha_salida" class="form-label">
                Fecha de Salida (si aplica)
            </label>
            <input type="date"
                   class="form-control form-control-custom @error('fecha_salida') is-invalid @enderror"
                   id="fecha_salida"
                   name="fecha_salida"
                   value="{{ old('fecha_salida', $mascota->fecha_salida ? $mascota->fecha_salida->format('Y-m-d') : '') }}">
            @error('fecha_salida')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="fundacion_id" class="form-label">
                Fundación <span class="required">*</span>
            </label>
            <select class="form-select form-select-custom @error('fundacion_id') is-invalid @enderror"
                    id="fundacion_id"
                    name="fundacion_id"
                    required>
                <option value="">Selecciona una fundación</option>
                @foreach($fundaciones as $fundacion)
                    <option value="{{ $fundacion->id }}"
                        {{ old('fundacion_id', $mascota->fundacion_id) == $fundacion->id ? 'selected' : '' }}>
                        {{ $fundacion->Nombre_1 }}
                    </option>
                @endforeach
            </select>
            @error('fundacion_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
