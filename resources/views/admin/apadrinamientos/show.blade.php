@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Ver Apadrinamiento</h1>

            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Usuario:</dt>
                        <dd class="col-sm-9">{{ $apadrinamiento->usuario->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Mascota:</dt>
                        <dd class="col-sm-9">{{ $apadrinamiento->mascota->nombre ?? 'N/A' }}</dd>

                        <dt class="col-sm-3">Monto Mensual:</dt>
                        <dd class="col-sm-9">${{ number_format($apadrinamiento->monto_mensual, 2) }}</dd>

                        <dt class="col-sm-3">Frecuencia:</dt>
                        <dd class="col-sm-9">{{ ucfirst($apadrinamiento->frecuencia) }}</dd>

                        <dt class="col-sm-3">Fecha Inicio:</dt>
                        <dd class="col-sm-9">{{ $apadrinamiento->fecha_inicio->format('d/m/Y') }}</dd>

                        <dt class="col-sm-3">Fecha Fin:</dt>
                        <dd class="col-sm-9">{{ $apadrinamiento->fecha_fin ? $apadrinamiento->fecha_fin->format('d/m/Y') : 'Sin fecha fin' }}</dd>

                        <dt class="col-sm-3">Estado:</dt>
                        <dd class="col-sm-9">
                            <span class="badge bg-{{ $apadrinamiento->estado == 'activo' ? 'success' : 'warning' }}">
                                {{ ucfirst($apadrinamiento->estado) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Mensaje Apoyo:</dt>
                        <dd class="col-sm-9">{{ $apadrinamiento->mensaje_apoyo ?? 'Sin mensaje' }}</dd>
                    </dl>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('apadrinamientos.edit', $apadrinamiento) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('apadrinamientos.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
