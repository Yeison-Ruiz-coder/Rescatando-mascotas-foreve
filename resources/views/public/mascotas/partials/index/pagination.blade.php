@if($mascotas->hasPages())
<div class="row mt-5">
    <div class="col-12 paginacion-moderna">
        {{ $mascotas->links() }}
    </div>
</div>
@endif