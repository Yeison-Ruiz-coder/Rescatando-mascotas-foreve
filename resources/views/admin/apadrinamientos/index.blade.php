@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Apadrinamientos</h1>
            <a href="{{ route('admin.apadrinamientos.create') }}" class="btn btn-primary mb-3">
                Crear Apadrinamiento
            </a>

            @if($apadrinamientos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Mascota</th>
                                <th>Monto Mensual</th>
                                <th>Frecuencia</th>
                                <th>Estado</th>
                                <th>Fecha Inicio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apadrinamientos as $apadrinamiento)
                                <tr>
                                    <td>{{ $apadrinamiento->id }}</td>
                                    <td>{{ $apadrinamiento->usuario->name ?? 'N/A' }}</td>
                                    <td>{{ $apadrinamiento->mascota->nombre ?? 'N/A' }}</td>
                                    <td>${{ number_format($apadrinamiento->monto_mensual, 2) }}</td>
                                    <td>{{ ucfirst($apadrinamiento->frecuencia) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $apadrinamiento->estado == 'activo' ? 'success' : 'warning' }}">
                                            {{ ucfirst($apadrinamiento->estado) }}
                                        </span>
                                    </td>
                                    <td>{{ $apadrinamiento->fecha_inicio->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('apadrinamientos.show', $apadrinamiento) }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="{{ route('apadrinamientos.edit', $apadrinamiento) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('apadrinamientos.destroy', $apadrinamiento) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $apadrinamientos->links() }}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    No hay apadrinamientos registrados.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
