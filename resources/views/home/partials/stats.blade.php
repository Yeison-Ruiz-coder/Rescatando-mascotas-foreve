<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-number">{{ $stats['mascotas_rescatadas'] ?? '1,200+' }}</div>
                <p>Mascotas Rescatadas</p>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-number">{{ $stats['adopciones_exitosas'] ?? '850+' }}</div>
                <p>Adopciones Exitosas</p>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-number">{{ $stats['voluntarios_activos'] ?? '150+' }}</div>
                <p>Voluntarios Activos</p>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="stat-number">{{ $stats['anos_experiencia'] ?? '5' }}</div>
                <p>Años de Experiencia</p>
            </div>
        </div>
    </div>
</section>