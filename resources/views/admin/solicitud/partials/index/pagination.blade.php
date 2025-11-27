{{-- resources/views/admin/solicitud/partials/index/_pagination.blade.php --}}
@if($solicitudes->hasPages())
<div class="pagination-container">
    <div class="pagination-info">
        Mostrando {{ $solicitudes->firstItem() ?? 0 }} - {{ $solicitudes->lastItem() ?? 0 }} de {{ $solicitudes->total() }} solicitudes
    </div>
    <div class="pagination-links">
        {{ $solicitudes->links() }}
    </div>
</div>
@endif