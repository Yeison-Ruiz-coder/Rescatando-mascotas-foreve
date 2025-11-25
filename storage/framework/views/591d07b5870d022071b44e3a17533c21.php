<footer class="custom-footer">
    
    <div class="container footer-content-wrapper">
        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4 footer-logo-col">
                <img src="<?php echo e(asset('img/logo-oscuro-letras.png')); ?>" alt="Logo Rescatando Mascotas Forever"
                    class="footer-logo mb-3">
                <p class="footer-mission">
                    Transformando vidas de mascotas abandonadas y creando familias felices desde 2025
                </p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 footer-section">
                <h5 class="footer-title">Contacto</h5>
                <ul class="list-unstyled footer-list">
                    <li>+57 304 884 234</li>
                    <li><a href="mailto:contacto.rescatandomascotasforever@org">rmforever@org</a></li>
                    <li>Calle 6 # 234 - 234 Bello oriente, Popayán Cauca, Colombia</li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 footer-section footer-forms-services">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-sm-0">
                        <h5 class="footer-title">Formularios</h5>
                        <ul class="list-unstyled footer-list">
                            <li><a href="<?php echo e(route('adopciones.create')); ?>">Adopción</a></li>
                            <li><a href="<?php echo e(route('rescates.create')); ?>">Rescates</a></li>
                            <li><a href="<?php echo e(route('usuarios.create')); ?>">Rescatistas</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="footer-title">Servicios</h5>
                        <ul class="list-unstyled footer-list">
                            <li><a href="<?php echo e(route('adopciones.index')); ?>">Proceso de Adopción</a></li>
                            <li><a href="<?php echo e(route('donaciones.create')); ?>">Donación</a></li>
                            <li><a href="#">Donación de suministros</a></li>
                            <li><a href="<?php echo e(route('suscripciones.create')); ?>">Suscripción</a></li>
                            <li><a href="#">Rescatistas</a></li>
                            <li><a href="<?php echo e(route('eventos.index')); ?>">Eventos</a></li>
                            <li><a href="#">Calificación</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4 footer-section footer-social-col">
                <h5 class="footer-title-social">Síguenos</h5>
                <div class="social-icons-wrapper">
                    <div class="social-icons">
                        <div class="social-row">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="social-row">
                            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div> 
    <div class="footer-bottom">
        <div class="container">
            <hr class="footer-divider"> 

            <div class="row align-items-center">
                
                <div class="col-md-6 text-center text-md-start">
                    <p class="copyright-text mb-2 mb-md-0">
                        &copy; <?php echo e(date('Y')); ?> Rescatando Mascotas Forever. Todos los derechos reservados.
                    </p>
                </div>
                
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline legal-links mb-0">
                        <li class="list-inline-item"><a href="#">Política de Privacidad</a></li>
                        <li class="list-inline-item"><a href="#">Términos y Condiciones</a></li>
                        <li class="list-inline-item"><a href="#">Política de Cookies</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    </footer><?php /**PATH C:\Users\Dan\Desktop\Rescatando-mascotas-foreve\resources\views/layouts/includes/private/footer.blade.php ENDPATH**/ ?>