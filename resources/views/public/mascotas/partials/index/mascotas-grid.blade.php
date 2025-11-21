<div class="row">
    @forelse($mascotas as $mascota)
        @include('public.mascotas.partials.index.mascota-card', ['mascota' => $mascota])
    @empty
        @include('public.mascotas.partials.index.empty-state')
    @endforelse
</div>