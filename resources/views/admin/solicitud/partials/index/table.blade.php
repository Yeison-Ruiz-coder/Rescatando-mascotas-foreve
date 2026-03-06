{{-- resources/views/admin/solicitud/partials/index/_table.blade.php --}}
<div class="table-container">
    <table class="solicitudes-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Solicitante</th>
                <th>Item</th>
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
                        <span class="tipo-badge tipo-{{ $solicitud->tipo_solicitud }}">
                            {{ ucfirst($solicitud->tipo_solicitud) }}
                        </span>
                    </td>
                    <td>
                        @if ($solicitud->usuario)
                            {{ $solicitud->usuario->name ?? $solicitud->usuario->nombre_completo }}
                        @else
                            {{ $solicitud->nombre_solicitante }}
                            @if($solicitud->esAdopcion() && $apellido = $solicitud->getDatoAdopcion('apellido_solicitante'))
                                {{ $apellido }}
                            @endif
                            <br>
                            <small class="text-muted">{{ $solicitud->email_solicitante }}</small>
                        @endif
                    </td>
                    <td>
                        @if($solicitud->solicitable)
                            @if($solicitud->solicitable_type == 'App\Models\Mascota')
                                <span class="item-info">
                                    <i class="fa-solid fa-paw"></i>
                                    {{ $solicitud->solicitable->nombre ?? 'Mascota' }}
                                </span>
                            @else
                                <span class="item-info">
                                    {{ class_basename($solicitud->solicitable_type) }}
                                </span>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $solicitud->fecha_solicitud->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $estado_class = strtolower(str_replace('_', '-', $solicitud->estado ?? 'pendiente'));
                            $estado_texto = str_replace('_', ' ', ucfirst($solicitud->estado ?? 'pendiente'));
                        @endphp
                        <span class="status-badge {{ $estado_class }}">
                            {{ $estado_texto }}
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
                                onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="no-data">
                        <i class="fa-solid fa-clipboard-list fa-3x"></i>
                        <p>No hay solicitudes registradas</p>
                        <a href="{{ route('admin.solicitudes.create') }}" class="btn-action primary-btn">
                            Crear Primera Solicitud
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
