<!-- Panel de Filtros -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-turquesa text-white">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Filtros de Búsqueda
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mascotas.index') }}" method="GET" class="row g-3 align-items-end">
                    <!-- Filtro por Especie -->
                    <div class="col-md-3">
                        <label for="especie" class="form-label fw-semibold">
                            <i class="fas fa-dog me-1"></i>Especie
                        </label>
                        <select name="especie" id="especie" class="form-select">
                            <option value="">Todas las especies</option>
                            @foreach ($especies as $especie)
                                <option value="{{ $especie }}"
                                    {{ request('especie') == $especie ? 'selected' : '' }}>
                                    {{ $especie }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Estado -->
                    <div class="col-md-3">
                        <label for="estado" class="form-label fw-semibold">
                            <i class="fas fa-chart-bar me-1"></i>Estado
                        </label>
                        <select name="estado" id="estado" class="form-select">
                            <option value="">Todos los estados</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado }}"
                                    {{ request('estado') == $estado ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Raza -->
                    <div class="col-md-3">
                        <label for="raza" class="form-label fw-semibold">
                            <i class="fas fa-tag me-1"></i>Raza
                        </label>
                        <input type="text" name="raza" id="raza" class="form-control"
                            placeholder="Ej: Labrador, Siames, Persa..."
                            value="{{ request('raza') }}">
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-md-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Buscar Mascotas
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>