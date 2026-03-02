<div class="container footer-content-wrapper">
    <div class="row">


        {{-- Logo y Misión --}}
        <div class="col-lg-3 col-md-6 mb-4 footer-logo-col">
            @include('public.layouts.partials.footer.logo-section')
        </div>

        {{-- Contacto --}}
        <div class="col-lg-3 col-md-6 mb-4 footer-section">
            @include('public.layouts.partials.footer.contact-section')
        </div>

        {{-- Formularios y Servicios --}}
        <div class="col-lg-4 col-md-6 mb-4 footer-section footer-forms-services">
            @include('public.layouts.partials.footer.services-section')
        </div>

        {{-- Redes Sociales --}}
        <div class="col-lg-2 col-md-6 mb-4 footer-section footer-social-col">
            @include('public.layouts.partials.footer.social-section')
        </div>
    </div>
</div>
