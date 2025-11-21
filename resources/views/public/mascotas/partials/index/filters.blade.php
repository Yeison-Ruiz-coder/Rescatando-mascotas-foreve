<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="filtros-modernos">
            <form action="{{ route('public.mascotas.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-turquesa fw-bold">Especie</label>
                    <select name="especie" class="form-select">
                        <option value="">Todas las especies</option>
                        @foreach($especies as $especie)
                            <option value="{{ $especie }}" {{ request('especie') == $especie ? 'selected' : '' }}>
                                {{ $especie }}s
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-turquesa fw-bold">Género</label>
                    <select name="genero" class="form-select">
                        <option value="">Todos los géneros</option>
                        <option value="Macho" {{ request('genero') == 'Macho' ? 'selected' : '' }}>Machos</option>
                        <option value="Hembra" {{ request('genero') == 'Hembra' ? 'selected' : '' }}>Hembras</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-buscar-moderno">
                        <i class="fas fa-search me-2"></i> Buscar Mascotas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>