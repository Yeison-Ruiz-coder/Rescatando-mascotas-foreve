@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Registrar Mascota</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('mascotas.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nombre de la mascota</label>
                <input name="Nombre_mascota" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Especie</label>
                <input name="Especie" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Raza</label>
                <input name="Raza" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Edad aproximada</label>
                <input type="number" name="Edad_aprox" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Género</label>
                <select name="Genero" class="form-control" required>
                    <option>Hembra</option>
                    <option>Macho</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Adoptado">Adoptado</option>
                    <option value="En adopcion">En adopcion</option>
                    <option value="Rescatada">Rescatada</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Lugar de rescate</label>
                <input name="Lugar_rescate" class="form-control" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Descripción</label>
                <textarea name="Descripcion" class="form-control" required></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label>URL de la foto</label>
                <input name="Foto" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Vacunas</label>
                <input name="vacunas" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Fecha de ingreso</label>
                <input type="date" name="Fecha_ingreso" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Fecha de salida (opcional)</label>
                <input type="date" name="Fecha_salida" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>ID de fundación (opcional)</label>
                <input type="number" name="fundacion_id" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary mt-3">Registrar Mascota</button>
    </form>
</div>

@endsection
