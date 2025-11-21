<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        @include('portals.public.partials.navbar.header')
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            @include('portals.public.partials.navbar.main-menu')
            @include('portals.public.partials.navbar.profile-dropdown')
        </div>
    </div>
</nav>

@include('portals.public.partials.navbar.secondary-menu')