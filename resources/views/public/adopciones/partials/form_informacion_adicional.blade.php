<div class="seccion-formulario animacion-entrada">
    <h5>
        <i class="fas fa-clipboard-check"></i>Información Adicional
    </h5>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="experiencia_mascotas" class="form-label-solicitud">
                <i class="fas fa-paw"></i>Experiencia con Mascotas
            </label>
            <select class="form-select-solicitud @error('experiencia_mascotas') is-invalid @enderror" 
                    id="experiencia_mascotas" name="experiencia_mascotas" required>
                <option value="">Selecciona una opción</option>
                <option value="Si, he tenido mascotas antes" {{ old('experiencia_mascotas') == 'Si, he tenido mascotas antes' ? 'selected' : '' }}>
                    Sí, he tenido mascotas antes
                </option>
                <option value="Si, actualmente tengo mascotas" {{ old('experiencia_mascotas') == 'Si, actualmente tengo mascotas' ? 'selected' : '' }}>
                    Sí, actualmente tengo mascotas
                </option>
                <option value="No, sería mi primera mascota" {{ old('experiencia_mascotas') == 'No, sería mi primera mascota' ? 'selected' : '' }}>
                    No, sería mi primera mascota
                </option>
            </select>
            @error('experiencia_mascotas')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="tipo_vivienda" class="form-label-solicitud">
                <i class="fas fa-home"></i>Tipo de Vivienda
            </label>
            <select class="form-select-solicitud @error('tipo_vivienda') is-invalid @enderror" 
                    id="tipo_vivienda" name="tipo_vivienda" required>
                <option value="">Selecciona una opción</option>
                <option value="Casa con patio" {{ old('tipo_vivienda') == 'Casa con patio' ? 'selected' : '' }}>
                    Casa con patio
                </option>
                <option value="Casa sin patio" {{ old('tipo_vivienda') == 'Casa sin patio' ? 'selected' : '' }}>
                    Casa sin patio
                </option>
                <option value="Apartamento" {{ old('tipo_vivienda') == 'Apartamento' ? 'selected' : '' }}>
                    Apartamento
                </option>
                <option value="Finca" {{ old('tipo_vivienda') == 'Finca' ? 'selected' : '' }}>
                    Finca
                </option>
                <option value="Otro" {{ old('tipo_vivienda') == 'Otro' ? 'selected' : '' }}>
                    Otro
                </option>
            </select>
            @error('tipo_vivienda')
                <div class="mensaje-error">
                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-0">
        <label for="motivo_adopcion" class="form-label-solicitud">
            <i class="fas fa-heart"></i>¿Por qué quieres adoptar a {{ $mascota->Nombre_mascota }}?
        </label>
        <textarea class="form-control-solicitud @error('motivo_adopcion') is-invalid @enderror" 
                  id="motivo_adopcion" name="motivo_adopcion" 
                  rows="4" 
                  placeholder="Cuéntanos por qué serías un buen hogar para {{ $mascota->Nombre_mascota }}. Comparte tu motivación, experiencia y cómo planeas cuidarlo..." 
                  required>{{ old('motivo_adopcion') }}</textarea>
        @error('motivo_adopcion')
            <div class="mensaje-error">
                <i class="fas fa-exclamation-circle"></i>{{ $message }}
            </div>
        @enderror
    </div>
</div>