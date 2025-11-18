<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\VeterinariaController;
use App\Http\Controllers\FundacionController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\RescateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\TipoVacunaController;

// PÁGINA DE INICIO
Route::get('/', [HomeController::class, 'index'])->name('inicio');


// RUTAS PÚBLICAS
Route::get('/', [MascotaController::class, 'publicIndex'])->name('inicio');
Route::get('/mascotas-disponibles', [MascotaController::class, 'publicIndex'])->name('mascotas.public.index');
Route::get('/mascota/{id}', [MascotaController::class, 'publicShow'])->name('mascotas.public.show');

// Para el formulario de solicitud
Route::get('/adopciones/solicitar/{id}', [AdopcionController::class, 'solicitar'])
    ->name('adopciones.solicitar');

// Para procesar la solicitud
Route::post('/adopciones/solicitar', [AdopcionController::class, 'solicitarStore'])
    ->name('adopciones.solicitar.store');
    
// RUTAS PÚBLICAS COMPLETAS (para desarrollo)
Route::resource('donaciones', DonacionController::class);
Route::resource('mascotas', MascotaController::class);
Route::resource('adopciones', AdopcionController::class);
Route::resource('rescates', RescateController::class);
Route::resource('reportes', ReporteController::class);
Route::resource('solicitudes', SolicitudController::class);
Route::resource('suscripciones', SuscripcionController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('administradores', AdministradorController::class);
Route::resource('veterinarias', VeterinariaController::class);
Route::resource('fundaciones', FundacionController::class);
Route::resource('tiendas', TiendaController::class);
Route::resource('eventos', EventoController::class);
Route::resource('comentarios', ComentarioController::class);
Route::resource('notificaciones', NotificacionController::class);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas de administración (también públicas para desarrollo)
//Route::resource('admin/mascotas', MascotaController::class);
Route::resource('razas', RazaController::class);
Route::resource('tipos-vacunas', TipoVacunaController::class);



// RUTAS DE AUTENTICACIÓN
require __DIR__.'/auth.php';

// COMENTA TODAS LAS RUTAS PROTEGIDAS POR AHORA - DESCOMENTAR CUANDO TERMINES EL DESARROLLO
/*
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de recursos COMPLETAS para usuarios autenticados
    Route::resource('reportes', ReporteController::class)->except(['index', 'show']);
    Route::resource('solicitudes', SolicitudController::class)->except(['index', 'show']);
    Route::resource('suscripciones', SuscripcionController::class);
    Route::resource('comentarios', ComentarioController::class);
    Route::resource('notificaciones', NotificacionController::class);
    
    // Rutas para crear mascotas, adopciones y rescates (requieren autenticación)
    Route::resource('mascotas', MascotaController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('adopciones', AdopcionController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('rescates', RescateController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    
    // Rutas de perfil de usuario
    Route::resource('usuarios', UsuarioController::class)->only(['edit', 'update', 'show']);
    
    // RUTAS DE ADMINISTRADOR (Requieren permisos adicionales)
    Route::middleware(['can:admin'])->group(function () {
        Route::resource('administradores', AdministradorController::class);
        Route::resource('veterinarias', VeterinariaController::class);
        Route::resource('fundaciones', FundacionController::class);
        Route::resource('tiendas', TiendaController::class);
        Route::resource('eventos', EventoController::class);
        
        // Admin - Gestión completa de mascotas
        Route::resource('admin/mascotas', MascotaController::class)->except(['index', 'show']);
        
        // Rutas de recurso para la administración de las Razas (Datos Maestros)
        Route::resource('admin/razas', RazaController::class);
        
        // Rutas de recurso para la administración de Tipos de Vacunas (Datos Maestros)
        Route::resource('admin/tipos-vacunas', TipoVacunaController::class);
        
        // Admin - Gestión de reportes y solicitudes
        Route::resource('reportes', ReporteController::class)->only(['index', 'show']);
        Route::resource('solicitudes', SolicitudController::class)->only(['index', 'show']);
    });
});
*/