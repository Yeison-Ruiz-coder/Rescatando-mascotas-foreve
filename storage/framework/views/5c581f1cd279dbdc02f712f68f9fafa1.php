<!-- 🔹 Navbar Profesional -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2); padding: 1rem 0; position: sticky; top: 0; z-index: 1000;">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/" style="font-size: 1.3rem; color: white !important; transition: transform 0.3s ease;">
      <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Logo" height="40" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
      🐶 Rescatando Mascotas
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation" style="border: 2px solid white; border-radius: 6px;">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto" style="gap: 0.5rem;">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo e(route('index')); ?>" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-home"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('servicios')); ?>" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-cogs"></i> Servicios
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('adopta')); ?>" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-heart"></i> Adopta
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('rescata')); ?>" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-life-ring"></i> Rescata
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(route('contacto')); ?>" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-envelope"></i> Contacto
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">
            <i class="fas fa-user"></i> Usuario
          </a>
          <ul class="dropdown-menu" style="background: white !important; border: 2px solid #e5e7eb !important; border-radius: 10px !important; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important; padding: 0.5rem 0 !important;">
            <li><a class="dropdown-item" href="#" style="color: #1f2937 !important; font-weight: 500; padding: 0.75rem 1.25rem !important; border-radius: 6px !important; margin: 0.25rem 0.5rem; transition: all 0.3s ease;"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></li>
            <li><a class="dropdown-item" href="#" style="color: #1f2937 !important; font-weight: 500; padding: 0.75rem 1.25rem !important; border-radius: 6px !important; margin: 0.25rem 0.5rem; transition: all 0.3s ease;"><i class="fas fa-user-edit"></i> Editar perfil</a></li>
            <li><a class="dropdown-item" href="#" style="color: #1f2937 !important; font-weight: 500; padding: 0.75rem 1.25rem !important; border-radius: 6px !important; margin: 0.25rem 0.5rem; transition: all 0.3s ease;"><i class="fas fa-image"></i> Cambiar foto</a></li>
            <li><a class="dropdown-item" href="#" style="color: #1f2937 !important; font-weight: 500; padding: 0.75rem 1.25rem !important; border-radius: 6px !important; margin: 0.25rem 0.5rem; transition: all 0.3s ease;"><i class="fas fa-lock"></i> Cambiar contraseña</a></li>
            <li><hr class="dropdown-divider" style="margin: 0.5rem 0 !important;"></li>
            <li><a class="dropdown-item" href="#" style="color: #1f2937 !important; font-weight: 500; padding: 0.75rem 1.25rem !important; border-radius: 6px !important; margin: 0.25rem 0.5rem; transition: all 0.3s ease;"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
      
      <form class="d-flex ms-3" role="search" style="gap: 0.5rem;">
        <input class="form-control" type="search" placeholder="Buscar..." aria-label="Search" style="border: 2px solid rgba(255, 255, 255, 0.3) !important; background: rgba(255, 255, 255, 0.1) !important; color: white !important; border-radius: 8px !important; font-size: 0.95rem; transition: all 0.3s ease; padding: 0.6rem 1rem !important;"/>
        <button class="btn btn-outline-success" type="submit" style="color: white !important; border: 2px solid white !important; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; padding: 0.6rem 1.2rem;"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </div>
</nav><?php /**PATH C:\Users\crist\Desktop\RESCATANDO211\Rescatando-mascotas-foreve\resources\views/layouts1/_partials/menu.blade.php ENDPATH**/ ?>