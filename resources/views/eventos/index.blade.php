@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row">
        @foreach ($eventos as $evento)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm" style="height: 100%;">

                @if ($evento->imagen)
                <img src="{{ asset('storage/'.$evento->imagen) }}" 
                     class="card-img-top" 
                     alt="Imagen del evento"
                     style="height:180px; object-fit:cover;">
                @else
                <img src="https://via.placeholder.com/300x180?text=Sin+Imagen" 
                     class="card-img-top"
                     style="height:180px; object-fit:cover;">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $evento->titulo }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($evento->descripcion, 80) }}
                    </p>

                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-primary btn-sm w-100">
                        Ver evento
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
