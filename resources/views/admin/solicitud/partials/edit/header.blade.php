{{-- resources/views/admin/solicitud/partials/edit/_header.blade.php --}}
<div class="banner-titulo">
    <h1>Editar Solicitud #{{ $solicitud->id }}</h1>
    <p>Solicitante: {{ $solicitud->usuario->nombre ?? 'N/A' }} (Tipo: {{ $solicitud->tipo }})</p>
</div>