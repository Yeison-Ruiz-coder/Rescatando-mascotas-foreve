document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.admin-sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const mainContainer = document.querySelector('.admin-main-container');
    
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('collapsed');
            
            // Ajustar el margen del contenido principal
            if (sidebar.classList.contains('collapsed')) {
                mainContainer.style.marginLeft = '70px';
            } else {
                mainContainer.style.marginLeft = '280px';
            }
            
            // Guardar estado
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    }
    
    // Cargar estado guardado
    const savedState = localStorage.getItem('sidebarCollapsed');
    if (savedState === 'true' && sidebar && mainContainer) {
        sidebar.classList.add('collapsed');
        mainContainer.style.marginLeft = '70px';
    }
});