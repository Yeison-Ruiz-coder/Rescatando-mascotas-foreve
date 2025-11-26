@extends('layouts.layout')

@section('title', 'Editar Solicitud #' . $solicitud->id)

@section('content')
<section class="admin-panel">
    
    <div class="banner-titulo">
        <h1>Editar Solicitud #{{ $solicitud->id }}</h1>
        <p>Solicitante: {{ $solicitud->usuario->nombre ?? 'N/A' }} (Tipo: {{ $solicitud->tipo }})</p>
    </div>

    <!-- MENSAJES DE ESTADO (Success/Error/Validation) -->
    @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert error">
            Por favor, corrige los siguientes errores:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="edit-form-container">
        <!-- Formulario principal para actualizar toda la solicitud -->
        {{-- CORRECCIÓN: Se usa 'solicitud.update' en singular --}}
        <form action="{{ route('solicitud.update', $solicitud) }}" method="POST" class="solicitud-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="estado">Estado de la Solicitud:</label>
                <select id="estado" name="estado" required class="@error('estado') is-invalid @enderror">
                    <option value="En Revisión" {{ old('estado', $solicitud->estado) == 'En Revisión' ? 'selected' : '' }}>En Revisión</option>
                    <option value="Aprobada" {{ old('estado', $solicitud->estado) == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                    <option value="Rechazada" {{ old('estado', $solicitud->estado) == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
                @error('estado')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Solicitud (No Editable):</label>
                <!-- Aunque no es editable, mostramos el valor para referencia -->
                <input type="text" id="tipo" value="{{ $solicitud->tipo }}" disabled>
            </div>

            <div class="form-group full-width">
                <label for="contenido">Contenido / Detalles de la Solicitud:</label>
                <textarea id="contenido" name="contenido" rows="10" required class="@error('contenido') is-invalid @enderror">{{ old('contenido', $solicitud->contenido) }}</textarea>
                @error('contenido')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <small class="help-text">Aquí puedes modificar o añadir notas internas sobre la justificación del solicitante.</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Guardar Cambios
                </button>
                {{-- CORRECCIÓN: Se usa 'solicitud.show' en singular --}}
                <a href="{{ route('solicitud.show', $solicitud) }}" class="btn-cancel">
                    <i class="fa-solid fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>

</section>
@endsection

@push('styles')
<style>
/* --- VARIABLES DE ESTILO (Tomadas del show.blade.php) --- */
:root {
    --primary-color: #3f72af; /* Azul fuerte */
    --secondary-color: #dbe2ef; /* Azul claro */
    --text-dark: #112d4e; /* Azul oscuro para texto */
    --danger-color: #d9534f; /* Rojo para errores */
    --success-color: #5cb85c; /* Verde para éxito */
    --border-radius: 8px;
}

/* --- UTILIDADES GENERALES --- */
.admin-panel {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}
.banner-titulo {
    text-align: center;
    background-color: var(--primary-color);
    color: white;
    padding: 20px;
    border-radius: var(--border-radius);
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
.banner-titulo p {
    font-size: 1.1em;
    margin-top: 5px;
}

/* --- MENSAJES DE ALERTA --- */
.alert {
    padding: 15px;
    border-radius: var(--border-radius);
    margin-bottom: 20px;
    font-weight: bold;
}
.alert.success {
    background-color: #dff0d8;
    color: #3c763d;
    border: 1px solid #d6e9c6;
}
.alert.error {
    background-color: #f2dede;
    color: #a94442;
    border: 1px solid #ebccd1;
}
.alert ul {
    margin-top: 5px;
    padding-left: 20px;
    font-weight: normal;
}


/* --- CONTENEDOR DEL FORMULARIO --- */
.edit-form-container {
    background-color: white;
    padding: 30px;
    border-radius: var(--border-radius);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.solicitud-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    font-weight: 700;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.solicitud-form input[type="text"],
.solicitud-form select,
.solicitud-form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.solicitud-form textarea {
    resize: vertical;
}

.solicitud-form input:disabled {
    background-color: #eee;
    color: #666;
    cursor: not-allowed;
}

.form-actions {
    grid-column: 1 / -1;
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 20px;
}

.btn-submit, .btn-cancel {
    padding: 10px 25px;
    border: none;
    border-radius: 4px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    text-align: center;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}
.btn-submit i, .btn-cancel i {
    margin-right: 8px;
}

.btn-submit {
    background-color: var(--primary-color);
    color: white;
}

.btn-submit:hover {
    background-color: #315c92;
    transform: translateY(-1px);
}

.btn-cancel {
    background-color: #6c757d;
    color: white;
}

.btn-cancel:hover {
    background-color: #5a6268;
    transform: translateY(-1px);
}

/* Validación y errores */
.is-invalid {
    border-color: var(--danger-color) !important;
}

.error-message {
    color: var(--danger-color);
    font-size: 0.85em;
    margin-top: 5px;
}

.help-text {
    font-size: 0.8em;
    color: #6c757d;
    margin-top: 5px;
}

@media (max-width: 768px) {
    .solicitud-form {
        grid-template-columns: 1fr;
    }
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    .btn-submit, .btn-cancel {
        justify-content: center;
    }
}
</style>
@endpush