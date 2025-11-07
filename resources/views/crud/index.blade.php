@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="{{ $icon }}"></i> {{ $title }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route($route . '.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo {{ $singular }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                        <th>{{ $column }}</th>
                        @endforeach
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        @foreach($fields as $field)
                        <td>{{ $item->$field }}</td>
                        @endforeach
                        <td class="table-actions">
                            <a href="{{ route($route . '.show', $item->id) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route($route . '.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route($route . '.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        @if($items->hasPages())
        <div class="mt-3">
            {{ $items->links() }}
        </div>
        @endif
        
        @else
        <div class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No hay {{ strtolower($title) }} registrados</h5>
            <a href="{{ route($route . '.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus"></i> Crear el primero
            </a>
        </div>
        @endif
    </div>
</div>
@endsection