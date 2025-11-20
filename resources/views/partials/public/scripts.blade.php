{{-- Scripts públicos --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Scripts globales de la aplicación --}}
<script src="{{ asset('js/app.js') }}"></script>

{{-- Scripts para componentes públicos --}}
@if(request()->is('mascotas/*'))
    <script src="{{ asset('js/mascotas-public.js') }}"></script>
@endif

{{-- Scripts para animaciones --}}
<script src="{{ asset('js/animations.js') }}"></script>