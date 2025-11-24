<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento - Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/pages/eventos/create.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear Nuevo Evento para Mascotas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Nombre_evento" class="form-label">Nombre del Evento *</label>
                                        <input type="text" class="form-control @error('Nombre_evento') is-invalid @enderror" 
                                               id="Nombre_evento" name="Nombre_evento" 
                                               value="{{ old('Nombre_evento') }}" required>
                                        @error('Nombre_evento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Lugar_evento" class="form-label">Lugar del Evento *</label>
                                        <input type="text" class="form-control @error('Lugar_evento') is-invalid @enderror" 
                                               id="Lugar_evento" name="Lugar_evento" 
                                               value="{{ old('Lugar_evento') }}" required>
                                        @error('Lugar_evento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Descripción *</label>
                                <textarea class="form-control @error('Descripcion') is-invalid @enderror" 
                                          id="Descripcion" name="Descripcion" rows="4" required>{{ old('Descripcion') }}</textarea>
                                @error('Descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Fecha_evento" class="form-label">Fecha del Evento *</label>
                                        <input type="datetime-local" class="form-control @error('Fecha_evento') is-invalid @enderror" 
                                               id="Fecha_evento" name="Fecha_evento" 
                                               value="{{ old('Fecha_evento') }}" required>
                                        @error('Fecha_evento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="imagen" class="form-label">Imagen del Evento</label>
                                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" 
                                               id="imagen" name="imagen" accept="image/*">
                                        @error('imagen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Formatos: JPEG, PNG, JPG, GIF (Max: 2MB)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('eventos.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Crear Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>