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

// PÁGINA DE INICIO
Route::get('/', [HomeController::class, 'index'])->name('inicio');
Route::get('/nosotros', function () {
    return view('public.nosotros');
})->name('nosotros');

// RUTAS PÚBLICAS DE MASCOTAS
Route::prefix('mascotas')->name('public.mascotas.')->group(function () {
    Route::get('/', [MascotaController::class, 'publicIndex'])->name('index');
    Route::get('/{id}', [MascotaController::class, 'publicShow'])->name('show');
});

// RUTAS PÚBLICAS DE ADOPCIONES
Route::prefix('adopciones')->name('adopciones.')->group(function () {
    Route::get('/solicitar/{id}', [AdopcionController::class, 'solicitar'])->name('solicitar');
    Route::post('/solicitar', [AdopcionController::class, 'solicitarStore'])->name('solicitar.store');
});

// RUTAS PÚBLICAS DE SOLICITUDES (si es necesario que los usuarios creen solicitudes)
Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
    Route::get('/create', [SolicitudController::class, 'create'])->name('create');
    Route::post('/', [SolicitudController::class, 'store'])->name('store');
});

// RUTAS PÚBLICAS DE EVENTOS
Route::prefix('eventos')->name('public.eventos.')->group(function () {
    Route::get('/', [EventoController::class, 'Eventospublicos'])->name('index');
    Route::get('/{evento}', [EventoController::class, 'showPublic'])->name('show');
});

// ===========================================
// RUTAS PÚBLICAS DE APADRINAMIENTOS (como donaciones)
// ===========================================
Route::prefix('apadrinamientos')->name('apadrinamientos.')->group(function () {
    Route::get('/planes', [ApadrinamientoController::class, 'planes'])->name('planes');
    Route::get('/iniciar/{mascota}', [ApadrinamientoController::class, 'iniciar'])->name('iniciar');
    Route::post('/procesar-pago', [ApadrinamientoController::class, 'procesarPago'])->name('procesar-pago');
    Route::get('/confirmacion/{id}', [ApadrinamientoController::class, 'confirmacion'])->name('confirmacion');
});
// RUTAS PÚBLICAS DE DONACIONES
Route::prefix('donaciones')->name('donaciones.')->group(function () {
    Route::get('/', [DonacionController::class, 'index'])->name('index');
    Route::get('/crear', [DonacionController::class, 'create'])->name('create');
    Route::post('/', [DonacionController::class, 'store'])->name('store');
    Route::get('/{id}', [DonacionController::class, 'show'])->name('show');
});

// =========================================================================
// RUTAS PÚBLICAS DE COMENTARIOS
// =========================================================================
Route::prefix('comentarios')->name('public.comentarios.')->group(function () {
    Route::get('/{entidadTipo}/{entidadId}', [PublicComentarioController::class, 'index'])->name('index');
    Route::post('/', [PublicComentarioController::class, 'store'])->name('store');
});

// =========================================================================
// RUTAS DE ADMINISTRACIÓN (CON PREFIJO /admin)
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

    // APADRINAMIENTOS (Admin) - Usando SuscripcionController
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
    // rutas específicas van primero, así no las atrapa {reporte}
    Route::get('/reportes/generales', [ReporteController::class, 'generales'])->name('reportes.generales');
    Route::get('/reportes/exportar/{tipo?}', [ReporteController::class, 'exportar'])->name('reportes.exportar');
    Route::resource('reportes', ReporteController::class);

    // TIENDAS
    // rutas específicas de ventas/inventario, el parámetro id es opcional pero colocado tras el segmento estático
    // para que la generación de URL sin id no produzca doble barra.
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
