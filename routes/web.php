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

// ---------------------------------------------------------------------
// 1. PÁGINAS PÚBLICAS
// ---------------------------------------------------------------------

// PÁGINA DE INICIO: Muestra directamente el índice de Donaciones.
Route::get('/', [DonacionController::class, 'index'])->name('inicio');

// Otras rutas de recurso que quieras que sean públicas
Route::resource('donaciones', DonacionController::class)->only(['index', 'create', 'store']);


// ---------------------------------------------------------------------
// 2. RUTAS DE AUTENTICACIÓN (LOGIN, REGISTER, LOGOUT, etc.)
// ¡ESTA LÍNEA ESTABA COMENTADA Y FALTABA!
// ---------------------------------------------------------------------
require __DIR__.'/auth.php';


// ---------------------------------------------------------------------
// 3. RUTAS PROTEGIDAS (Requieren que el usuario esté logueado)
// ---------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    });
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de recursos COMPLETAS
    Route::resource('administradores', AdministradorController::class);
    Route::resource('veterinarias', VeterinariaController::class);
    Route::resource('fundaciones', FundacionController::class);
    Route::resource('tiendas', TiendaController::class);
    Route::resource('mascotas', MascotaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('reportes', ReporteController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('comentarios', ComentarioController::class);
    Route::resource('solicitudes', SolicitudController::class);
    Route::resource('suscripciones', SuscripcionController::class);
    Route::resource('adopciones', AdopcionController::class);
    Route::resource('notificaciones', NotificacionController::class);
    Route::resource('rescates', RescateController::class);
    

<<<<<<< Updated upstream

=======
    // Rutas personalizadas
    Route::get('/mascotas/estado/{estado}', [MascotaController::class, 'porEstado'])->name('mascotas.estado');
    Route::get('/usuarios/tipo/{tipo}', [UsuarioController::class, 'porTipo'])->name('usuarios.tipo');
    Route::get('/estadisticas', [DashboardController::class, 'estadisticas'])->name('estadisticas');
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');

// Rutas de autenticación (si usas Laravel Breeze o Jetstream)
require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


>>>>>>> Stashed changes
