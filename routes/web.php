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

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', [DonacionController::class, 'index'])->name('inicio');

// Donaciones públicas
Route::resource('donaciones', DonacionController::class)->only(['index', 'create', 'store']);
=======
// ... otros imports

// PÁGINA DE INICIO
Route::get('/', [HomeController::class, 'index'])->name('inicio');

// RUTAS PÚBLICAS DE MASCOTAS
Route::get('/mascotas-disponibles', [MascotaController::class, 'publicIndex'])->name('public.mascotas.index');
Route::get('/mascota/{id}', [MascotaController::class, 'publicShow'])->name('public.mascotas.show');
//RUTAS PRIVADAS DE MASCOTAS
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas.index');
    Route::get('/mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store');
    Route::get('/mascotas/{mascota}', [MascotaController::class, 'show'])->name('mascotas.show');
    Route::get('/mascotas/{mascota}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit');
    Route::put('/mascotas/{mascota}', [MascotaController::class, 'update'])->name('mascotas.update');
    Route::delete('/mascotas/{mascota}', [MascotaController::class, 'destroy'])->name('mascotas.destroy');
});
>>>>>>> origin/master

// Para el formulario de solicitud
Route::get('/adopciones/solicitar/{id}', [AdopcionController::class, 'solicitar'])
    ->name('adopciones.solicitar');
Route::post('/adopciones/solicitar', [AdopcionController::class, 'solicitarStore'])
    ->name('adopciones.solicitar.store');

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| 2. AUTENTICACIÓN (Laravel Breeze / Jetstream)
|--------------------------------------------------------------------------
|
| NO TOCAR. Esto carga login, register, logout, etc.
|
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
});
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Recursos protegidos
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

    // Rutas personalizadas
    Route::get('/mascotas/estado/{estado}', [MascotaController::class, 'porEstado'])->name('mascotas.estado');
    Route::get('/usuarios/tipo/{tipo}', [UsuarioController::class, 'porTipo'])->name('usuarios.tipo');
    Route::get('/estadisticas', [DashboardController::class, 'estadisticas'])->name('estadisticas');
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');

    // Vista de eventos
    Route::resource('eventos', EventoController::class);


    // Formulario manual para crear mascotas
    Route::get('/mascotas/crear', [MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store');

=======
// RUTAS DE AUTENTICACIÓN
require __DIR__.'/auth.php';

// ⚠️ PARA DESARROLLO - COMENTA EL MIDDLEWARE DE AUTH ⚠️
/*          ________
/*|\     | |        |
/*| \    | |        |
/*|  \   | |        | 
/*|   \  | |        | 
/*|    \ | |        | 
/*|     \| |________|   TOCAR  ,
Route::middleware(['auth'])->group(function () {
    // ... todo el contenido del middleware
});
*/

// RUTAS COMPLETAS PÚBLICAS (PARA DESARROLLO)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('donaciones', DonacionController::class);
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
Route::resource('razas', RazaController::class);
Route::resource('tipos-vacunas', TipoVacunaController::class);
>>>>>>> origin/master
