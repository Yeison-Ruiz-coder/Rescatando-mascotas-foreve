{{-- resources/views/admin/solicitud/partials/index/_table.blade.php --}}
<div class="table-container">
    <table class="solicitudes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Solicitante</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($solicitudes as $solicitud)
                <tr>
                    <td>#{{ $solicitud->id }}</td>
                    <td>
                        <span class="tipo-badge">{{ $solicitud->tipo }}</span>
                    </td>
                    <td>
                        @if ($solicitud->usuario)
                            {{ $solicitud->usuario->Nombre_1 }}
                            {{ $solicitud->usuario->Apellido_1 }}
                        @else
                            Usuario #{{ $solicitud->usuario_id }}
                        @endif
                    </td>
                    <td>{{ $solicitud->fecha_solicitud->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $estado = $solicitud->estado ?? 'Sin Estado';
                            $estado_class = strtolower(str_replace(' ', '-', $estado));
                        @endphp
                        <span class="status-badge {{ $estado_class }}">
                            {{ $estado }}
                        </span>
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.solicitudes.show', $solicitud) }}" class="btn-action view-btn" title="Ver">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.solicitudes.edit', $solicitud) }}" class="btn-action edit-btn" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.solicitudes.destroy', $solicitud) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete-btn" title="Eliminar"
                                onclick="return confirm('¿Estás seguro?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="card-actions no-data">
                        <i class="fa-solid fa-clipboard-list fa-3x"></i>
                        <p>No hay solicitudes registradas</p>
                        <a href="{{ route('admin.solicitudes.create') }}" class="btn-action primary-btn ">
                            Crear Primera Solicitud
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
