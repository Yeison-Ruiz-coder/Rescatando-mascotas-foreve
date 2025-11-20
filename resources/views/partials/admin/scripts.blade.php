{{-- Scripts Admin --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

{{-- Scripts específicos admin --}}
<script src="{{ asset('js/admin.js') }}"></script>

{{-- Inicialización de componentes admin --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar DataTables si existe
    if ($.fn.DataTable) {
        $('.data-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    }
    
    // Toggle sidebar
    document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
        document.body.classList.toggle('sidebar-collapsed');
    });
});
</script>