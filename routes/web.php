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
use Illuminate\Routing\Router;

// Página pública
Route::get('/', function () {
    return view('welcome');
});
// vistas  prueba
Route::view('/','index')->name('index');
Route::view('/about','about')->name('about');
Route::view('/adopta','adopta')->name('adopta');
Route::view('/rescata','rescata')->name('rescata');

// Rutas con autenticación
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de recursos
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
    Route::resource('donaciones', DonacionController::class);
    Route::resource('rescates', RescateController::class);

    // Rutas personalizadas
    Route::get('/mascotas/estado/{estado}', [MascotaController::class, 'porEstado'])->name('mascotas.estado');
    Route::get('/usuarios/tipo/{tipo}', [UsuarioController::class, 'porTipo'])->name('usuarios.tipo');
    Route::get('/estadisticas', [DashboardController::class, 'estadisticas'])->name('estadisticas');
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');
});

// Rutas de autenticación (si usas Laravel Breeze o Jetstream)
require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/eventos', function () {
    return view('eventos');
});
