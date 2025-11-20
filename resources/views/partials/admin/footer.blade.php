{{-- Footer Admin --}}
<footer class="admin-footer bg-light border-top mt-auto">
    <div class="container-fluid">
        <div class="row align-items-center py-3">
            <div class="col-md-6">
                <small class="text-muted">
                    &copy; {{ date('Y') }} Rescatando Mascotas Forever - Panel Administrativo
                </small>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted">
                    v1.0.0 | 
                    <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
                </small>
            </div>
        </div>
    </div>
</footer>