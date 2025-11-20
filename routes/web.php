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

// ... otros imports

// PÁGINA DE INICIO
Route::get('/', [HomeController::class, 'index'])->name('inicio');

// RUTAS PÚBLICAS
Route::get('/mascotas-disponibles', [MascotaController::class, 'publicIndex'])->name('mascotas.public.index');
Route::get('/mascota/{id}', [MascotaController::class, 'publicShow'])->name('mascotas.public.show');

// Para el formulario de solicitud
Route::get('/adopciones/solicitar/{id}', [AdopcionController::class, 'solicitar'])
    ->name('adopciones.solicitar');
Route::post('/adopciones/solicitar', [AdopcionController::class, 'solicitarStore'])
    ->name('adopciones.solicitar.store');

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
Route::resource('razas', RazaController::class);
Route::resource('tipos-vacunas', TipoVacunaController::class);