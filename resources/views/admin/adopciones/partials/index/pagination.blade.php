{{-- resources/views/admin/adopciones/partials/index/_pagination.blade.php --}}
<div class="d-flex justify-content-between align-items-center p-3 border-top">
    <div>
        {{ $adopciones->links() }}
    </div>
    <small class="text-muted">
        Página {{ $adopciones->currentPage() }} de {{ $adopciones->lastPage() }}
    </small>
</div>