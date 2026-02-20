<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Admin\ApadrinamientoController as AdminApadrinamientoController;
use App\Http\Controllers\ApadrinamientoController;
use App\Http\Controllers\VeterinariaController;
use App\Http\Controllers\FundacionController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\Admin\ComentarioController as AdminComentarioController;
use App\Http\Controllers\Public\ComentarioController as PublicComentarioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Admin\DonacionController as AdminDonacionController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\RescateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\TipoVacunaController;

// =========================================================================
// RUTAS PÚBLICAS (SIN PREFIJO /admin)
// =========================================================================

// PÁGINA DE INICIO - CORREGIDA
Route::get('/', [HomeController::class, 'index'])->name('inicio');
Route::get('/nosotros', function () {
    return view('public.nosotros');
})->name('nosotros');

// RUTAS PÚBLICAS DE MASCOTAS - CORREGIDAS
Route::prefix('mascotas')->name('public.mascotas.')->group(function () {
    Route::get('/', [MascotaController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [MascotaController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE ADOPCIONES - CORREGIDAS
Route::prefix('adopciones')->name('public.adopciones.')->group(function () {
    Route::get('/', [AdopcionController::class, 'publicIndex'])->name('index');
    Route::get('/solicitar/{id}', [AdopcionController::class, 'solicitar'])->name('solicitar');
    Route::post('/solicitar', [AdopcionController::class, 'solicitarStore'])->name('solicitar.store');
});

// RUTAS PÚBLICAS DE SOLICITUDES - CORREGIDAS
Route::prefix('solicitudes')->name('public.solicitudes.')->group(function () {
    Route::get('/', [SolicitudController::class, 'publicIndex'])->name('index');
    Route::get('/create', [SolicitudController::class, 'publicCreate'])->name('create');
    Route::post('/', [SolicitudController::class, 'publicStore'])->name('store');
});

// RUTAS PÚBLICAS DE EVENTOS - CORREGIDAS
Route::prefix('eventos')->name('public.eventos.')->group(function () {
    Route::get('/', [EventoController::class, 'publicIndex'])->name('index');
    Route::get('/{evento}', [EventoController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE APADRINAMIENTOS - CORREGIDAS
Route::prefix('apadrinamientos')->name('public.apadrinamientos.')->group(function () {
    Route::get('/', [ApadrinamientoController::class, 'publicIndex'])->name('index');
    Route::get('/planes', [ApadrinamientoController::class, 'planes'])->name('planes');
    Route::get('/iniciar/{mascota}', [ApadrinamientoController::class, 'iniciar'])->name('iniciar');
    Route::post('/procesar-pago', [ApadrinamientoController::class, 'procesarPago'])->name('procesar-pago');
    Route::get('/confirmacion/{id}', [ApadrinamientoController::class, 'confirmacion'])->name('confirmacion');
});

// RUTAS PÚBLICAS DE DONACIONES - CORREGIDAS
Route::prefix('donaciones')->name('public.donaciones.')->group(function () {
    Route::get('/', [DonacionController::class, 'publicIndex'])->name('index');
    Route::get('/crear', [DonacionController::class, 'publicCreate'])->name('create');
    Route::post('/', [DonacionController::class, 'publicStore'])->name('store');
    Route::get('/{id}', [DonacionController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE COMENTARIOS - CORREGIDAS
Route::prefix('comentarios')->name('public.comentarios.')->group(function () {
    Route::get('/', [PublicComentarioController::class, 'index'])->name('index');
    Route::get('/{entidadTipo}/{entidadId}', [PublicComentarioController::class, 'show'])->name('show');
    Route::post('/', [PublicComentarioController::class, 'store'])->name('store');
});

// RUTAS PÚBLICAS DE VETERINARIAS - NUEVAS
Route::prefix('veterinarias')->name('public.veterinarias.')->group(function () {
    Route::get('/', [VeterinariaController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [VeterinariaController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE FUNDACIONES - NUEVAS
Route::prefix('fundaciones')->name('public.fundaciones.')->group(function () {
    Route::get('/', [FundacionController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [FundacionController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE TIENDA - NUEVAS
Route::prefix('tienda')->name('public.tienda.')->group(function () {
    Route::get('/', [TiendaController::class, 'publicIndex'])->name('index');
    Route::get('/producto/{id}', [TiendaController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE RESCATES - NUEVAS
Route::prefix('rescates')->name('public.rescates.')->group(function () {
    Route::get('/', [RescateController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [RescateController::class, 'publicShow'])->name('show');
});

// =========================================================================
// RUTAS DE ADMINISTRACIÓN (CON PREFIJO /admin) - SIN MODIFICAR
// =========================================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // CONFIGURACIÓN
    Route::view('/configuracion', 'admin.configuracion.index')->name('configuracion');

    // MASCOTAS (CRUD completo)
    Route::resource('mascotas', MascotaController::class);

    // ADOPCIONES (Admin)
    Route::resource('adopciones', AdopcionController::class);

    // SOLICITUDES (Admin - gestión completa)
    Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
        Route::get('/', [SolicitudController::class, 'index'])->name('index');
        Route::get('/create', [SolicitudController::class, 'create'])->name('create');
        Route::post('/', [SolicitudController::class, 'store'])->name('store');
        Route::get('/{solicitud}', [SolicitudController::class, 'show'])->name('show');
        Route::get('/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('edit');
        Route::put('/{solicitud}', [SolicitudController::class, 'update'])->name('update');
        Route::put('/{solicitud}/status', [SolicitudController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{solicitud}', [SolicitudController::class, 'destroy'])->name('destroy');
    });

    // EVENTOS (Admin)
    Route::resource('eventos', EventoController::class);
    Route::get('/eventos/calendar/vista', [EventoController::class, 'calendar'])->name('eventos.calendar');
    Route::get('/eventos/calendar/data', [EventoController::class, 'calendarData'])->name('eventos.calendar.data');

    // APADRINAMIENTOS (Admin)
    Route::resource('apadrinamientos', AdminApadrinamientoController::class);
    Route::patch('/apadrinamientos/{id}/estado', [AdminApadrinamientoController::class, 'cambiarEstado'])
        ->name('apadrinamientos.estado');

    // DONACIONES (Admin)
    Route::prefix('donaciones')->name('donaciones.')->group(function () {
        Route::get('/', [AdminDonacionController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminDonacionController::class, 'show'])->name('show');
        Route::patch('/{id}/estado', [AdminDonacionController::class, 'updateEstado'])->name('estado');
        Route::get('/reportes/generales', [AdminDonacionController::class, 'reportes'])->name('reportes');
    });

    // RESCATES
    Route::resource('rescates', RescateController::class);

    // USUARIOS
    Route::resource('usuarios', UsuarioController::class);

    // ADMINISTRADORES
    Route::resource('administradores', AdministradorController::class);

    // VETERINARIAS
    Route::resource('veterinarias', VeterinariaController::class);

    // FUNDACIONES
    Route::resource('fundaciones', FundacionController::class);

    // COMENTARIOS
    Route::resource('comentarios', AdminComentarioController::class);

    // NOTIFICACIONES
    Route::resource('notificaciones', NotificacionController::class);

    // TIPOS DE VACUNAS
    Route::resource('tipos-vacunas', TipoVacunaController::class);

    // REPORTES
    Route::get('/reportes/generales', [ReporteController::class, 'generales'])->name('reportes.generales');
    Route::get('/reportes/exportar/{tipo?}', [ReporteController::class, 'exportar'])->name('reportes.exportar');
    Route::resource('reportes', ReporteController::class);

    // TIENDAS
    Route::get('/tiendas/ventas/{id?}', [TiendaController::class, 'ventas'])->name('tiendas.ventas');
    Route::get('/tiendas/inventario/{id?}', [TiendaController::class, 'inventario'])->name('tiendas.inventario');
    Route::resource('tiendas', TiendaController::class);

    // RAZAS
    Route::resource('razas', RazaController::class);
});

// =========================================================================
// RUTAS DE AUTENTICACIÓN
// =========================================================================
require __DIR__ . '/auth.php';