<!-- Mascotas Section -->
<section id="mascotas" class="adopta-section">
    <div class="container">
        <h2 class="section-title">Mascotas Disponibles para Adoptar</h2>
        <p class="section-subtitle">Conoce a nuestros amigos que buscan un hogar lleno de amor y cuidado.</p>
        
        <div class="row g-4">
            <?php if(isset($mascotasRecientes) && $mascotasRecientes->count() > 0): ?>
                <?php $__currentLoopData = $mascotasRecientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mascota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <!-- Imagen con overlay -->
                        <div class="card-imagen-container">
                            <?php if($mascota->Foto): ?>
                            <img src="<?php echo e(asset('storage/' . $mascota->Foto)); ?>" 
                                 alt="<?php echo e($mascota->Nombre_mascota); ?>">
                            <?php else: ?>
                            <div class="w-100 h-100 bg-gris-claro d-flex align-items-center justify-content-center">
                                <i class="fas fa-paw fa-4x text-turquesa opacity-50"></i>
                            </div>
                            <?php endif; ?>
                            <div class="overlay-mascota"></div>
                            
                            <!-- Badges flotantes -->
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">
                                    <?php echo e($mascota->Especie); ?>

                                </span>
                                <span class="badge-moderno badge-genero-moderno">
                                    <?php echo e($mascota->Genero); ?>

                                </span>
                                <span class="badge-moderno badge-edad-moderno">
                                    <?php echo e($mascota->Edad_aprox); ?> años
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenido -->
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota"><?php echo e($mascota->Nombre_mascota); ?></h3>
                            
                            <p class="descripcion-mascota">
                                <?php echo e(Str::limit($mascota->Descripcion, 150)); ?>

                            </p>
                            
                            <!-- Información de fundación -->
                            <?php if($mascota->fundacion): ?>
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: <?php echo e($mascota->fundacion->Nombre_1); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Botones -->
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('public.mascotas.show', $mascota->id)); ?>" 
                                   class="btn-conocer-mas flex-fill">
                                   <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="<?php echo e(route('adopciones.solicitar', $mascota->id)); ?>" 
                                   class="btn-adoptar-home">
                                   <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <!-- Mascotas de ejemplo (cuando no hay datos) -->
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <div class="card-imagen-container">
                            <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" 
                                 alt="Rocky">
                            <div class="overlay-mascota"></div>
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">Perro</span>
                                <span class="badge-moderno badge-genero-moderno">Macho</span>
                                <span class="badge-moderno badge-edad-moderno">2 años</span>
                            </div>
                        </div>
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">Rocky</h3>
                            <p class="descripcion-mascota">
                                Perro juguetón y muy cariñoso. Perfecto para familias activas. Le encanta correr y jugar en el parque.
                            </p>
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: Fundación Amigos Peludos</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn-conocer-mas flex-fill">
                                    <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="#" class="btn-adoptar-home">
                                    <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Segunda mascota de ejemplo -->
                <div class="col-xl-4 col-lg-6 mb-4 animate-fade-in-up">
                    <div class="card-mascota-moderna">
                        <div class="card-imagen-container">
                            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=400&h=300&fit=crop" 
                                 alt="Luna">
                            <div class="overlay-mascota"></div>
                            <div class="badges-container">
                                <span class="badge-moderno badge-especie-moderno">Gato</span>
                                <span class="badge-moderno badge-genero-moderno">Hembra</span>
                                <span class="badge-moderno badge-edad-moderno">1 año</span>
                            </div>
                        </div>
                        <div class="card-body-moderno">
                            <h3 class="nombre-mascota">Luna</h3>
                            <p class="descripcion-mascota">
                                Gatita tranquila y cariñosa. Ideal para apartamentos. Le gusta dormir en lugares cálidos y acurrucarse.
                            </p>
                            <div class="info-fundacion">
                                <i class="fas fa-home"></i>
                                <span>Rescatado por: Refugio Felino</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn-conocer-mas flex-fill">
                                    <i class="fas fa-heart me-2"></i>Conocer más
                                </a>
                                <a href="#" class="btn-adoptar-home">
                                    <i class="fas fa-home me-2"></i>Adoptar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="<?php echo e(route('public.mascotas.index')); ?>" class="btn-primary-custom">
                Ver Todas las Mascotas
            </a>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\Rescatando-mascotas-foreve\resources\views/home/partials/mascotas.blade.php ENDPATH**/ ?>