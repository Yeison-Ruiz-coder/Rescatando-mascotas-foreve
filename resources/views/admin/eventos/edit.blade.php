<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar {{ $evento->Nombre_evento }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @extends('admin.layouts.app')
    @section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Evento: {{ $evento->Nombre_evento }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('eventos.update', $evento) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Nombre_evento" class="form-label">Nombre del Evento *</label>
                                        <input type="text" class="form-control @error('Nombre_evento') is-invalid @enderror"
                                               id="Nombre_evento" name="Nombre_evento"
                                               value="{{ old('Nombre_evento', $evento->Nombre_evento) }}" required>
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
                                               value="{{ old('Lugar_evento', $evento->Lugar_evento) }}" required>
                                        @error('Lugar_evento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Descripción *</label>
                                <textarea class="form-control @error('Descripcion') is-invalid @enderror"
                                          id="Descripcion" name="Descripcion" rows="4" required>{{ old('Descripcion', $evento->Descripcion) }}</textarea>
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
                                               value="{{ old('Fecha_evento', \Carbon\Carbon::parse($evento->Fecha_evento)->format('Y-m-d\TH:i')) }}" required>
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
                                        <div class="form-text">
                                            @if($evento->imagen_url)
                                                <div class="mt-2">
                                                    <strong>Imagen actual:</strong><br>
                                                    <img src="{{ asset($evento->imagen_url) }}" alt="Imagen actual" class="img-thumbnail mt-2" style="max-height: 100px;">
                                                </div>
                                            @endif
                                            Formatos: JPEG, PNG, JPG, GIF (Max: 2MB)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
