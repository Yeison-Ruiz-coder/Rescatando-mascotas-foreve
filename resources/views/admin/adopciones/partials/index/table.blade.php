{{-- resources/views/admin/adopciones/partials/index/_table.blade.php --}}
<div class="card shadow-sm tabla-adopciones">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Mascota</th>
                        <th>Adoptante</th>
                        <th width="120">Fecha Adopción</th>
                        <th>Lugar</th>
                        <th width="120">Estado</th>
                        <th width="150" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adopciones as $adopcion)
                    <tr>
                        <td class="fw-bold text-turquesa">#{{ $adopcion->id }}</td>
                        <td>
                            @if($adopcion->mascota)
                                <i class="fas fa-paw me-2 text-fucsia"></i>
                                {{ $adopcion->mascota->Nombre_mascota }}
                            @else
                                <span class="text-muted">
                                    <i class="fas fa-question-circle me-2"></i>Mascota no encontrada
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($adopcion->usuario)
                                <i class="fas fa-user me-2 text-turquesa"></i>
                                {{ $adopcion->usuario->Nombre_1 }} {{ $adopcion->usuario->Apellido_1 }}
                            @else
                                <span class="text-muted">
                                    <i class="fas fa-question-circle me-2"></i>Usuario no encontrado
                                </span>
                            @endif
                        </td>
                        <td>
                            <i class="fas fa-calendar me-2 text-muted"></i>
                            {{ $adopcion->Fecha_adopcion->format('d/m/Y') }}
                        </td>
                        <td>
                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                            {{ $adopcion->Lugar_adopcion }}
                        </td>
                        <td>
                            <span class="badge badge-estado 
                                @if($adopcion->estado == 'Aprobado') bg-success
                                @elseif($adopcion->estado == 'En proceso') bg-warning
                                @else bg-danger
                                @endif">
                                {{ $adopcion->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm btn-group-acciones">
                                <a href="{{ route('admin.adopciones.show', $adopcion->id) }}" 
                                   class="btn btn-outline-info" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.adopciones.edit', $adopcion->id) }}" 
                                   class="btn btn-outline-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.adopciones.destroy', $adopcion->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" 
                                            title="Eliminar"
                                            onclick="return confirm('¿Estás seguro de eliminar esta adopción?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>