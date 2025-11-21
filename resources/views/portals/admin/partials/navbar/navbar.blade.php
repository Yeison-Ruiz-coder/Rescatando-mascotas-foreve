<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        @include('portals.admin.partials.navbar.header')
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            @include('portals.admin.partials.navbar.main-menu')
            @include('portals.admin.partials.navbar.profile-dropdown')
        </div>
    </div>
</nav>

@include('portals.admin.partials.navbar.secondary-menu')