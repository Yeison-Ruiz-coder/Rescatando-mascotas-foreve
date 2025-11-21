<!--Todo fue Migrado y reorganizado en componentes
para revisar cambiar la ruta del controlador mascota en index. --> 





<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/mascotas/create.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-lg-5 py-4">

    
<!-- Cards de mensajes -->
<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <i class="fas fa-check-circle alert-icon"></i>
            <div class="alert-text">
                <h5 class="alert-title">¡Mascota Registrada con Éxito!</h5>
                <p class="alert-message">La mascota ha sido registrada correctamente en el sistema.</p>
                <?php if(is_string(session('success')) && session('success') != ''): ?>
                    <small class="alert-details"><?php echo e(session('success')); ?></small>
                <?php endif; ?>
            </div>
        </div>
        <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <div class="alert-text">
                <h5 class="alert-title">¡Error en el Registro!</h5>
                <p class="alert-message"><?php echo e(session('error')); ?></p>
            </div>
        </div>
        <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
<?php endif; ?>



    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="create-mascota-header text-center">
                <h1 class="display-5 fw-bold">
                    <i class="fas fa-paw me-3"></i>Reportar Nueva Mascota
                </h1>
                <p class="lead">Ayuda a una mascota a encontrar un hogar lleno de amor</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <div class="card form-mascota-card shadow-lg border-0">
                <div class="card-header form-mascota-header">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Formulario de Registro
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('mascotas.store')); ?>" method="POST" enctype="multipart/form-data" id="mascotaForm">
                        <?php echo csrf_field(); ?>

                        <!-- Sección 1: Información Básica -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-info-circle me-2"></i>Información Básica
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="Nombre_mascota" class="form-label">
                                        Nombre de la Mascota <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="Nombre_mascota" 
                                           name="Nombre_mascota" 
                                           value="<?php echo e(old('Nombre_mascota')); ?>"
                                           placeholder="Ej: Max, Luna, Toby..."
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label for="Especie" class="form-label">
                                        Especie <span class="required">*</span>
                                    </label>
                                    <select class="form-select form-select-custom" 
                                            id="Especie" 
                                            name="Especie" 
                                            required>
                                        <option value="">Selecciona una especie</option>
                                        <option value="Perro" <?php echo e(old('Especie') == 'Perro' ? 'selected' : ''); ?>>Perro</option>
                                        <option value="Gato" <?php echo e(old('Especie') == 'Gato' ? 'selected' : ''); ?>>Gato</option>
                                        <option value="Conejo" <?php echo e(old('Especie') == 'Conejo' ? 'selected' : ''); ?>>Conejo</option>
                                        <option value="Otro" <?php echo e(old('Especie') == 'Otro' ? 'selected' : ''); ?>>Otro</option>
                                    </select>
                                </div>

                                <!-- Campo para Razas (selección múltiple) -->
                                <div class="col-md-6">
                                    <label for="razas" class="form-label">
                                        Razas <span class="required">*</span>
                                    </label>
                                    <div class="multi-select-container">
                                        <select class="form-select form-select-custom multi-select" 
                                                id="razas" 
                                                name="razas[]" 
                                                multiple
                                                size="3"
                                                required>
                                            <option value="">Selecciona una o más razas</option>
                                            <?php $__currentLoopData = $razas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($raza->id); ?>"
                                                    <?php echo e(in_array($raza->id, old('razas', [])) ? 'selected' : ''); ?>>
                                                    <?php echo e($raza->nombre_raza); ?> (<?php echo e($raza->especie); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples razas
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="Edad_aprox" class="form-label">
                                        Edad Aproximada (años) <span class="required">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-custom" 
                                           id="Edad_aprox" 
                                           name="Edad_aprox" 
                                           value="<?php echo e(old('Edad_aprox')); ?>"
                                           min="0" 
                                           max="30" 
                                           step="0.5"
                                           placeholder="Ej: 2.5"
                                           required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Género <span class="required">*</span></label>
                                    <div class="radio-group">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="Genero" 
                                                   id="GeneroMacho" 
                                                   value="Macho" 
                                                   <?php echo e(old('Genero') == 'Macho' ? 'checked' : ''); ?>

                                                   required>
                                            <label class="form-check-label" for="GeneroMacho">
                                                <i class="fas fa-mars me-1"></i>Macho
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="Genero" 
                                                   id="GeneroHembra" 
                                                   value="Hembra" 
                                                   <?php echo e(old('Genero') == 'Hembra' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="GeneroHembra">
                                                <i class="fas fa-venus me-1"></i>Hembra
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="estado" class="form-label">
                                        Estado Actual <span class="required">*</span>
                                    </label>
                                    <select class="form-select form-select-custom" 
                                            id="estado" 
                                            name="estado" 
                                            required>
                                        <option value="">Selecciona un estado</option>
                                        <option value="En adopcion" <?php echo e(old('estado') == 'En adopcion' ? 'selected' : ''); ?>>
                                            <i class="fas fa-heart me-1"></i>En adopción
                                        </option>
                                        <option value="Rescatada" <?php echo e(old('estado') == 'Rescatada' ? 'selected' : ''); ?>>
                                            <i class="fas fa-shield-alt me-1"></i>Rescatada
                                        </option>
                                        <option value="Adoptado" <?php echo e(old('estado') == 'Adoptado' ? 'selected' : ''); ?>>
                                            <i class="fas fa-home me-1"></i>Adoptado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 2: Ubicación y Descripción -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>Ubicación y Descripción
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="Lugar_rescate" class="form-label">
                                        Lugar donde se encuentra <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-custom" 
                                           id="Lugar_rescate" 
                                           name="Lugar_rescate" 
                                           value="<?php echo e(old('Lugar_rescate')); ?>"
                                           placeholder="Ej: Parque Central, Calle Principal #123..."
                                           required>
                                </div>

                                <div class="col-12">
                                    <label for="Descripcion" class="form-label">
                                        Descripción <span class="required">*</span>
                                    </label>
                                    <textarea class="form-control form-control-custom" 
                                              id="Descripcion" 
                                              name="Descripcion" 
                                              rows="5"
                                              placeholder="Describe a la mascota: carácter, comportamiento, condición de salud, necesidades especiales..."
                                              required><?php echo e(old('Descripcion')); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 3: Salud y Vacunas -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-syringe me-2"></i>Salud y Vacunas
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="vacunas_aplicadas" class="form-label">
                                        Vacunas Aplicadas
                                    </label>
                                    <div class="multi-select-container">
                                        <select class="form-select form-select-custom multi-select" 
                                                id="vacunas_aplicadas" 
                                                name="vacunas_aplicadas[]" 
                                                multiple
                                                size="3">
                                            <option value="">Selecciona las vacunas aplicadas</option>
                                            <?php $__currentLoopData = $vacunas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacuna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($vacuna->id); ?>"
                                                    <?php echo e(in_array($vacuna->id, old('vacunas_aplicadas', [])) ? 'selected' : ''); ?>>
                                                    <?php echo e($vacuna->nombre_vacuna); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Mantén presionada la tecla Ctrl para seleccionar múltiples vacunas
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sección 4: Galería de Fotos -->
                        <div class="form-section">
                            <h4 class="section-title">
                                <i class="fas fa-camera me-2"></i>Galería de Fotos
                            </h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="fotos" class="form-label">
                                        Fotos de la Mascota <span class="required">*</span>
                                    </label>
                                    <input type="file" 
                                           class="form-control form-control-custom" 
                                           id="fotos" 
                                           name="fotos[]" 
                                           multiple 
                                           accept="image/*" 
                                           required>
                                    <div class="form-help">
                                        <i class="fas fa-info-circle"></i> Selecciona una o más fotos • La primera será la principal • Formatos: JPG, PNG, GIF • Máx. 2MB cada una
                                    </div>

                                    <!-- Preview de imágenes seleccionadas -->
                                    <div id="preview-galeria" class="preview-container mt-3"></div>

                                    <?php $__errorArgs = ['fotos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['fotos.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

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
                                           value="<?php echo e(old('Fecha_ingreso', date('Y-m-d'))); ?>" 
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
                                           value="<?php echo e(old('Fecha_salida')); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="fundacion_id" class="form-label">
                                        Fundación (opcional)
                                    </label>
                                    <select class="form-select form-select-custom" 
                                            id="fundacion_id" 
                                            name="fundacion_id">
                                        <option value="">Sin fundación asignada</option>
                                        <?php $__currentLoopData = $fundaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fundacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fundacion->id); ?>"
                                                <?php echo e(old('fundacion_id') == $fundacion->id ? 'selected' : ''); ?>>
                                                <?php echo e($fundacion->Nombre_1); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-paw me-2"></i>Registrar Mascota
                            </button>
                            <a href="<?php echo e(route('mascotas.index')); ?>" class="btn btn-cancel">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// Preview de múltiples imágenes al seleccionar
document.getElementById('fotos').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-galeria');
    preview.innerHTML = '';

    if (e.target.files.length > 0) {
        const previewTitle = document.createElement('div');
        previewTitle.className = 'preview-title';
        previewTitle.innerHTML = `<small>Vista previa (${e.target.files.length} foto(s) seleccionada(s)):</small>`;
        preview.appendChild(previewTitle);

        const previewRow = document.createElement('div');
        previewRow.className = 'row g-2';
        preview.appendChild(previewRow);

        Array.from(e.target.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-4 col-md-3';
                col.innerHTML = `
                    <div class="preview-item position-relative">
                        <img src="${e.target.result}" 
                             class="preview-image" 
                             alt="Vista previa ${index + 1}">
                        ${index === 0 ? '<span class="preview-badge">Principal</span>' : ''}
                        <div class="preview-info">Foto ${index + 1}</div>
                    </div>
                `;
                previewRow.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
});

// Validación básica de imagen
document.getElementById('fotos').addEventListener('change', function(e) {
    const files = e.target.files;
    Array.from(files).forEach((file, index) => {
        // Validar tamaño
        if (file.size > 2 * 1024 * 1024) {
            alert(`La imagen "${file.name}" es demasiado grande. Máximo 2MB permitido.`);
            e.target.value = '';
            return;
        }

        // Validar tipo
        if (!file.type.match('image.*')) {
            alert(`"${file.name}" no es una imagen válida.`);
            e.target.value = '';
            return;
        }
    });
});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Personal\Desktop\rescatando-mascotas\resources\views/mascotas/create.blade.php ENDPATH**/ ?>