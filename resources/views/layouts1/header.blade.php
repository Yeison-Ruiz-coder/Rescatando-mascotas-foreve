<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rescatando Mascotas - Home</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
  
  <style>
    body {
      font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
  </style>
</head>

<body>

  <!-- 🔹 Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2); padding: 1rem 0;">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/" style="font-size: 1.3rem; transition: transform 0.3s ease;">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="40" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
        🐶 Rescatando Mascotas forever
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation" style="border: 2px solid white; border-radius: 6px;">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav ms-auto" style="gap: 0.5rem;">
          <li class="nav-item"><a class="nav-link active" href="#inicio" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="/services" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="/adopta" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">Adopta</a></li>
          <li class="nav-item"><a class="nav-link" href="/contacto" style="color: rgba(255, 255, 255, 0.85) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 6px; transition: all 0.3s ease;">Contacto</a></li>

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
  </nav>

  <!-- 🔹 Hero -->
  <section id="inicio" class="hero d-flex align-items-center justify-content-center text-center text-white">

    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://media.istockphoto.com/id/2194197607/photo/happy-mother-father-cute-little-daughter-hugging-together-with-dog-golden-retriever.jpg?s=2048x2048&w=is&k=20&c=1Vl91f_oQMa6X7DW4rhQZXiDHeEO1lrrD3Zio5TBk0M=" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://media.istockphoto.com/id/2169620101/photo/portrait-of-beagle-dog-playing-with-asian-young-woman-on-sofa-in-living-room-at-cozy-home-pet.jpg?s=2048x2048&w=is&k=20&c=UdYBSZ794oGJ8VLCV8-xD3L_MWbbdlbW74ORYUZQIMQ=" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://images.unsplash.com/photo-1625316708582-7c38734be31d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=687" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <div class="container">
      <h1 class="display-4 fw-bold">Dales una nueva oportunidad 🐾</h1>
      
      <p class="lead">Adopta, dona o ayuda a difundir — cada acción salva una vida.</p>
      <a href="#adopta" class="btn btn-lg btn-light mt-3 shadow">Ver Mascotas</a>
    </div>
  </section>

  <!-- 🔹 Servicios -->
  <section id="servicios" class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Nuestros Servicios</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" width="60" alt="icono adopción">
              <h4 class="mt-3">Bienestar Animal</h4>
              <p>Encuentra a tu compañero ideal. Cada mascota está vacunada y lista para un nuevo hogar.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" width="60" alt="icono rescate">
              <h4 class="mt-3">Reencuentros</h4>
              <p>Rescatamos animales en situación de calle, brindándoles cuidado y amor hasta su adopción.</p>
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" width="60" alt="icono rescate">
              <h4 class="mt-3">Buscando mascotas</h4>
              <p>Rescatamos animales en situación de calle, brindándoles cuidado y amor hasta su adopción.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" width="60" alt="icono rescate">
              <h4 class="mt-3">Ultimos rescates</h4>
              <p>Rescatamos animales en situación de calle, brindándoles cuidado y amor hasta su adopción.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/616/616554.png" width="60" alt="icono voluntariado">
              <h4 class="mt-3">Voluntariado</h4>
              <p>Únete a nuestra comunidad de voluntarios y forma parte del cambio para cientos de mascotas.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 🔹 Sección Adopta -->
  <section id="adopta" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Mascotas que buscan hogar 🏠</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400" class="card-img-top" alt="Rocky">
            <div class="card-body">
              <h5 class="card-title">Rocky</h5>
              <p>Macho • 2 años • Juguetón y cariñoso</p>
              <a href="#contacto" class="btn btn-success">Adoptar</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?w=400" class="card-img-top" alt="Luna">
            <div class="card-body">
              <h5 class="card-title">Luna</h5>
              <p>Hembra • 1 año • Dulce y tranquila</p>
              <a href="#contacto" class="btn btn-success">Adoptar</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm border-0">
            <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238?w=400" class="card-img-top" alt="Max">
            <div class="card-body">
              <h5 class="card-title">Max</h5>
              <p>Macho • 3 años • Protector y noble</p>
              <a href="#contacto" class="btn btn-success">Adoptar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 🔹 Formulario de Contacto -->
  <section id="contacto" class="py-5">
    <div class="container">
      <h2 class="fw-bold text-center mb-4">Formulario de Adopción o Contacto 💌</h2>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form class="p-4 bg-white shadow rounded">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="nombre" placeholder="Ej. Ana García" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" placeholder="Ej. ana@gmail.com" required>
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="telefono" placeholder="Ej. +34 600 123 456" required>
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje" rows="4" placeholder="Cuéntanos a quién quieres adoptar o cómo deseas ayudar..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Script para efecto sticky navbar -->
  <script>
    document.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
  {{-- Footer --}}
  @include('layouts1._partials.footer')