<!-- Sección 5: Fechas y Fundación -->
<div class="form-section">
    <h4 class="section-title">
        <i class="fas fa-calendar-alt me-2"></i>Fechas y Organización
    </h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="Fecha_ingreso" class="form-label">
                Fecha de Ingreso <span class="required">*</span>
            </label>
            <input type="date" 
                   class="form-control form-control-custom" 
                   id="Fecha_ingreso" 
                   name="Fecha_ingreso" 
                   value="{{ old('Fecha_ingreso', date('Y-m-d')) }}" 
                   required>
        </div>
        <div class="col-md-6">
            <label for="Fecha_salida" class="form-label">
                Fecha de Salida (si aplica)
            </label>
            <input type="date" 
                   class="form-control form-control-custom" 
                   id="Fecha_salida" 
                   name="Fecha_salida" 
                   value="{{ old('Fecha_salida') }}">
        </div>
        <div class="col-12">
            <label for="fundacion_id" class="form-label">
                Fundación (opcional)
            </label>
            <select class="form-select form-select-custom" 
                    id="fundacion_id" 
                    name="fundacion_id">
                <option value="">Sin fundación asignada</option>
                @foreach($fundaciones as $fundacion)
                    <option value="{{ $fundacion->id }}"
                        {{ old('fundacion_id') == $fundacion->id ? 'selected' : '' }}>
                        {{ $fundacion->Nombre_1 }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>