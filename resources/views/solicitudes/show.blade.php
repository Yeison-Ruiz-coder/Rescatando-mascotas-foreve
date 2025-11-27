@extends('layouts.layout')

@section('title', 'Detalles de Solicitud #' . $solicitud->id)

@section('content')
<section class="admin-panel">
    
    <div class="banner-titulo">
        <h1>Detalles de Solicitud #{{ $solicitud->id }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-details">
        
        {{-- Grupo de Estado Actual --}}
        <div class="detail-group status-group">
            <label>Estado Actual:</label>
            @php
                // Prepara la clase CSS: 'En Revisión' -> 'en-revision'
                $estado_class = strtolower(str_replace(' ', '-', $solicitud->estado ?? 'revision'));
            @endphp
            <span class="status-badge large {{ $estado_class }}">
                {{ $solicitud->estado ?? 'Sin Estado' }}
            </span>
        </div>

        {{-- Detalle: Tipo de Solicitud --}}
        <div class="detail-group">
            <label>Tipo de Solicitud:</label>
            <p>{{ $solicitud->tipo }}</p>
        </div>

        {{-- Detalle: Fecha de Solicitud --}}
        <div class="detail-group">
            <label>Fecha de Solicitud:</label>
            {{-- Asumiendo que fecha_solicitud es un Carbon instance --}}
            <p>{{ $solicitud->fecha_solicitud->format('d/m/Y H:i') }}</p>
        </div>

        {{-- Detalle: Solicitante (Usuario) --}}
        <div class="detail-group">
            <label>Solicitante:</label>
            {{-- Muestra el nombre del usuario si existe, sino muestra el ID --}}
            <p>{{ $solicitud->usuario->nombre ?? 'Usuario ID: ' . ($solicitud->usuario_id ?? 'N/A') }}</p>
        </div>
        
        {{-- Detalle: Fechas de creación/actualización (Opcional, pero útil) --}}
        <div class="detail-group">
            <label>Creada el:</label>
            <p>{{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
        </div>
        
        {{-- Detalle: Contenido / Justificación (Ocupa todo el ancho) --}}
        <div class="detail-group full-width">
            <label>Contenido / Justificación:</label>
            <div class="content-box">
                {{ $solicitud->contenido }}
            </div>
        </div>

        {{-- Botones de Acción --}}
        <div class="action-buttons-group">
            {{-- CORRECCIÓN: Usar 'solicitud.edit' en singular --}}
            <a href="{{ route('solicitud.edit', $solicitud) }}" class="btn-action edit-btn">
                <i class="fa-solid fa-pen-to-square"></i> Editar Estado / Contenido
            </a>
            
            {{-- CORRECCIÓN: Usar 'solicitud.index' en singular --}}
            <a href="{{ route('solicitud.index') }}" class="btn-action back-btn">
                <i class="fa-solid fa-arrow-left"></i> Volver al Listado
            </a>
        </div>
    </div>

</section>
@endsection

@push('styles')
<style>
/* --- VARIABLES DE ESTILO --- */
:root {
    --primary-color: #3f72af; /* Azul fuerte */
    --secondary-color: #dbe2ef; /* Azul claro */
    --text-dark: #112d4e; /* Azul oscuro para texto */
    --border-radius: 8px;
}
/* --- UTILIDADES GENERALES --- */
.admin-panel {
    max-width: 1200px;
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

/* --- ESTILOS PRINCIPALES DE LA TARJETA --- */
.card-details {
    background-color: white;
    padding: 30px;
    border-radius: var(--border-radius);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    /* Distribución en Grid: 2 columnas por defecto, adaptable */
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

/* --- GRUPOS DE DETALLE --- */
.detail-group {
    border-left: 4px solid var(--secondary-color);
    padding-left: 15px;
}

.detail-group.full-width {
    grid-column: 1 / -1; /* Ocupa todas las columnas disponibles */
}

.detail-group label {
    display: block;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 5px;
    font-size: 0.9em;
    text-transform: uppercase;
}

.detail-group p {
    margin: 0;
    font-size: 1.1em;
    color: var(--text-dark);
}

/* --- CAJA DE CONTENIDO --- */
.content-box {
    background-color: var(--secondary-color);
    padding: 15px;
    border-radius: var(--border-radius);
    white-space: pre-wrap; /* Mantiene saltos de línea y espacios */
    font-family: inherit;
    line-height: 1.6;
    border: 1px solid #c9d6de;
}

/* --- GESTIÓN DEL ESTADO --- */
.status-group {
    grid-column: 1 / -1; 
    text-align: center;
    border: none;
    padding-left: 0;
    margin-bottom: 20px;
}

.status-badge {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 9999px;
    font-weight: 700;
    text-transform: uppercase;
    color: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
.status-badge.large {
    font-size: 1.2em;
    margin-top: 8px;
}

/* Colores de Estado Dinámicos */
.en-revision {
    background-color: #ffc107; /* Amarillo */
}
.aprobada {
    background-color: #4CAF50; /* Verde */
}
.rechazada {
    background-color: #F44336; /* Rojo */
}

/* --- BOTONES DE ACCIÓN --- */
.action-buttons-group {
    grid-column: 1 / -1;
    display: flex;
    flex-wrap: wrap; /* Para responsividad en móviles */
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.btn-action {
    padding: 10px 25px;
    border-radius: var(--border-radius);
    font-weight: 700;
    transition: background-color 0.3s, transform 0.2s;
    text-align: center;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}
.btn-action i {
    margin-right: 8px;
}

.edit-btn {
    background-color: var(--primary-color);
    color: white;
}

.back-btn {
    background-color: #6c757d;
    color: white;
}

.btn-action:hover {
    transform: translateY(-2px);
    opacity: 0.95;
}
</style>
@endpush