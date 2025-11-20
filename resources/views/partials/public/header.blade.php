{{-- Header público - Mantenemos tu navbar actual --}}
<header class="public-header">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                <img src="{{ asset('img/logo-oscuro.png') }}" alt="Rescatando Mascotas Forever Logo" class="navbar-logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- Navigation se maneja en partial separado --}}
            @include('partials.public.navigation')
        </div>
    </nav>
</header>