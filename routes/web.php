<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// =========================================================================
// RUTAS PÚBLICAS (TUS RUTAS ORIGINALES)
// =========================================================================

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\MascotaController as PublicMascotaController;
use App\Http\Controllers\Public\AdopcionController as PublicAdopcionController;
use App\Http\Controllers\Public\SolicitudController as PublicSolicitudController;
use App\Http\Controllers\Public\EventoController as PublicEventoController;
use App\Http\Controllers\Public\ApadrinamientoController as PublicApadrinamientoController;
use App\Http\Controllers\Public\DonacionController as PublicDonacionController;
use App\Http\Controllers\Public\ComentarioController as PublicComentarioController;
use App\Http\Controllers\Public\VeterinariaController as PublicVeterinariaController;
use App\Http\Controllers\Public\FundacionController as PublicFundacionController;
use App\Http\Controllers\Public\RescateController as PublicRescateController;
use App\Http\Controllers\Public\ProductoController as PublicProductoController;
use App\Http\Controllers\Public\CarritoController;
use App\Http\Controllers\Public\PedidoController as PublicPedidoController;
use App\Http\Controllers\Public\TiendaController as PublicTiendaController;

// =========================================================================
// RUTAS DE BREEZE (dashboard y profile)
// =========================================================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// TUS RUTAS PÚBLICAS (REINCORPORADAS)
// =========================================================================

// PÁGINA DE INICIO - ¡LA MÁS IMPORTANTE!
Route::get('/', [HomeController::class, 'index'])->name('inicio');

// Otras páginas estáticas
Route::get('/nosotros', fn() => view('public.nosotros'))->name('nosotros');

// MASCOTAS PÚBLICAS
Route::prefix('mascotas')->name('public.mascotas.')->group(function () {
    Route::get('/', [PublicMascotaController::class, 'index'])->name('index');
    Route::get('/{id}', [PublicMascotaController::class, 'show'])->name('show');
});

// ADOPCIONES PÚBLICAS (VERSIÓN ACTUALIZADA)
Route::prefix('adopciones')->name('public.adopciones.')->group(function () {
    Route::get('/', [PublicAdopcionController::class, 'index'])->name('index');
    Route::get('/mascota/{id}', [PublicAdopcionController::class, 'show'])->name('show'); // Detalle de mascota
    Route::get('/solicitar/{id}', [PublicAdopcionController::class, 'solicitar'])->name('solicitar');
    Route::post('/solicitar', [PublicAdopcionController::class, 'solicitarStore'])->name('solicitar.store');
    Route::get('/solicitud-exitosa/{id}', [PublicAdopcionController::class, 'solicitudExitosa'])->name('solicitud-exitosa');

    // Rutas para usuarios autenticados
    Route::middleware(['auth'])->group(function () {
        Route::get('/mis-solicitudes', [PublicAdopcionController::class, 'misSolicitudes'])->name('mis-solicitudes');
        Route::get('/en-proceso', [PublicAdopcionController::class, 'enProceso'])->name('en-proceso');
        Route::get('/solicitud/{id}', [PublicAdopcionController::class, 'solicitudDetalle'])->name('solicitud-detalle');
    });

    // Ruta AJAX (pública)
    Route::get('/verificar-disponibilidad/{id}', [PublicAdopcionController::class, 'verificarDisponibilidad'])->name('verificar-disponibilidad');
});

// SOLICITUDES PÚBLICAS
Route::prefix('solicitudes')->name('public.solicitudes.')->group(function () {
    Route::get('/', [PublicSolicitudController::class, 'index'])->name('index');
    Route::get('/create', [PublicSolicitudController::class, 'create'])->name('create');
    Route::post('/', [PublicSolicitudController::class, 'store'])->name('store');
});

// EVENTOS PÚBLICOS
Route::prefix('eventos')->name('public.eventos.')->group(function () {
    Route::get('/', [PublicEventoController::class, 'index'])->name('index');
    Route::get('/{evento}', [PublicEventoController::class, 'show'])->name('show');
});

// APADRINAMIENTOS PÚBLICOS
Route::prefix('apadrinamientos')->name('public.apadrinamientos.')->group(function () {
    Route::get('/', [PublicApadrinamientoController::class, 'index'])->name('index');
    Route::get('/planes', [PublicApadrinamientoController::class, 'planes'])->name('planes');
    Route::get('/iniciar/{mascota}', [PublicApadrinamientoController::class, 'iniciar'])->name('iniciar');
    Route::post('/procesar-pago', [PublicApadrinamientoController::class, 'procesarPago'])->name('procesar-pago');
    Route::get('/confirmacion/{id}', [PublicApadrinamientoController::class, 'confirmacion'])->name('confirmacion');
});

// DONACIONES PÚBLICAS
Route::prefix('donaciones')->name('public.donaciones.')->group(function () {
    Route::get('/', [PublicDonacionController::class, 'index'])->name('index');
    Route::get('/crear', [PublicDonacionController::class, 'create'])->name('create');
    Route::post('/', [PublicDonacionController::class, 'store'])->name('store');
    Route::get('/{id}', [PublicDonacionController::class, 'show'])->name('show');
});

// COMENTARIOS PÚBLICOS
Route::prefix('comentarios')->name('public.comentarios.')->group(function () {
    Route::get('/', [PublicComentarioController::class, 'index'])->name('index');
    Route::post('/', [PublicComentarioController::class, 'store'])->name('store');
});

// VETERINARIAS PÚBLICAS
Route::prefix('veterinarias')->name('public.veterinarias.')->group(function () {
    Route::get('/', [PublicVeterinariaController::class, 'index'])->name('index');
    Route::get('/{id}', [PublicVeterinariaController::class, 'show'])->name('show');
});

// FUNDACIONES PÚBLICAS
Route::prefix('fundaciones')->name('public.fundaciones.')->group(function () {
    Route::get('/', [PublicFundacionController::class, 'index'])->name('index');
    Route::get('/{id}', [PublicFundacionController::class, 'show'])->name('show');
});

// RESCATES PÚBLICOS
Route::prefix('rescates')->name('public.rescates.')->group(function () {
    Route::get('/', [PublicRescateController::class, 'index'])->name('index');
    Route::get('/create', [PublicRescateController::class, 'create'])->name('create');
    Route::post('/', [PublicRescateController::class, 'store'])->name('store');
    Route::get('/{id}', [PublicRescateController::class, 'show'])->name('show');
});

// TIENDA PÚBLICA
Route::prefix('tienda')->name('public.tienda.')->group(function () {
    Route::get('/', [PublicTiendaController::class, 'index'])->name('index');
    Route::get('/producto/{id}', [PublicProductoController::class, 'show'])->name('producto.show');
});

// PRODUCTOS PÚBLICOS
Route::prefix('productos')->name('public.productos.')->group(function () {
    Route::get('/', [PublicProductoController::class, 'index'])->name('index');
    Route::get('/{id}', [PublicProductoController::class, 'show'])->name('show');
});

// CARRITO (requiere autenticación)
Route::prefix('carrito')->name('public.carrito.')->middleware(['auth'])->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('index');
    Route::post('/agregar/{producto}', [CarritoController::class, 'agregar'])->name('agregar');
    Route::put('/actualizar/{item}', [CarritoController::class, 'actualizar'])->name('actualizar');
    Route::delete('/eliminar/{item}', [CarritoController::class, 'eliminar'])->name('eliminar');
});

// PEDIDOS USUARIO
Route::prefix('pedidos')->name('public.pedidos.')->middleware(['auth'])->group(function () {
    Route::get('/', [PublicPedidoController::class, 'index'])->name('index');
    Route::get('/checkout', [PublicPedidoController::class, 'checkout'])->name('checkout');
    Route::post('/procesar', [PublicPedidoController::class, 'procesar'])->name('procesar');
    Route::get('/{id}', [PublicPedidoController::class, 'show'])->name('show');
    Route::post('/{id}/cancelar', [PublicPedidoController::class, 'cancelar'])->name('cancelar');
});

// =========================================================================
// RUTAS DE ADMIN (TUS RUTAS ORIGINALES)
// =========================================================================

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MascotaController;
use App\Http\Controllers\Admin\AdopcionController;
use App\Http\Controllers\Admin\SolicitudController as AdminSolicitudController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\ApadrinamientoController;
use App\Http\Controllers\Admin\DonacionController;
use App\Http\Controllers\Admin\RescateController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\VeterinariaController;
use App\Http\Controllers\Admin\FundacionController;
use App\Http\Controllers\Admin\ComentarioController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\RazaController;
use App\Http\Controllers\Admin\TipoVacunaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\CategoriaController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard de admin (¡NO confundir con el dashboard de Breeze!)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    // CONFIGURACIÓN
    Route::view('/configuracion', 'admin.configuracion.index')->name('configuracion');

    // MASCOTAS
    Route::resource('mascotas', MascotaController::class);

    // ADOPCIONES
    Route::resource('adopciones', AdopcionController::class);

    //  SOLICITUDES GENERALES (UNA SOLA VEZ, CON AdminSolicitudController)
    Route::resource('solicitudes', AdminSolicitudController::class);
    Route::patch('/solicitudes/{id}/status', [AdminSolicitudController::class, 'updateStatus'])
        ->name('solicitudes.update-status'); // Sin 'admin.' porque ya está en el prefijo

    // EVENTOS
    Route::resource('eventos', EventoController::class);
    Route::get('/eventos/calendar/vista', [EventoController::class, 'calendar'])->name('eventos.calendar');
    Route::get('/eventos/calendar/data', [EventoController::class, 'calendarData'])->name('eventos.calendar.data');

    // APADRINAMIENTOS
    Route::resource('apadrinamientos', ApadrinamientoController::class);
    Route::patch('/apadrinamientos/{apadrinamiento}/estado', [ApadrinamientoController::class, 'cambiarEstado'])
        ->name('apadrinamientos.estado');

    // DONACIONES
    Route::resource('donaciones', DonacionController::class);
    Route::patch('/donaciones/{donacion}/toggle-publica', [DonacionController::class, 'togglePublica'])
        ->name('donaciones.toggle-publica');
    Route::get('/donaciones-reportes/generales', [DonacionController::class, 'reporte'])
        ->name('donaciones.reporte');

    // RESCATES
    Route::resource('rescates', RescateController::class);

    // USUARIOS
    Route::resource('usuarios', UsuarioController::class);
    Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'cambiarEstado'])
        ->name('usuarios.estado');
    Route::post('/usuarios/{usuario}/verificar-email', [UsuarioController::class, 'verificarEmail'])
        ->name('usuarios.verificar-email');

    // VETERINARIAS
    Route::resource('veterinarias', VeterinariaController::class);

    // FUNDACIONES
    Route::resource('fundaciones', FundacionController::class);
    Route::get('/fundaciones/{fundacion}/necesidades', [FundacionController::class, 'necesidades'])
        ->name('fundaciones.necesidades');

    // COMENTARIOS
    Route::resource('comentarios', ComentarioController::class);
    Route::post('/comentarios/accion-masiva', [ComentarioController::class, 'masivo'])
        ->name('comentarios.masivo');

    // NOTIFICACIONES
    Route::resource('notificaciones', NotificacionController::class);
    Route::post('/notificaciones/enviar-masivo', [NotificacionController::class, 'enviarMasivo'])
        ->name('notificaciones.enviar-masivo');

    // TIPOS DE VACUNAS
    Route::resource('tipos-vacunas', TipoVacunaController::class);
    Route::get('/tipos-vacunas/recomendadas', [TipoVacunaController::class, 'recomendadas'])
        ->name('tipos-vacunas.recomendadas');

    // RAZAS
    Route::resource('razas', RazaController::class);
    Route::get('/razas/especie/{especie}', [RazaController::class, 'porEspecie'])
        ->name('razas.por-especie');

    // REPORTES
    Route::get('/reportes/generales', [ReporteController::class, 'generales'])->name('reportes.generales');
    Route::get('/reportes/exportar/{tipo}', [ReporteController::class, 'exportar'])->name('reportes.exportar');
    Route::resource('reportes', ReporteController::class);

    // TIENDAS
    Route::resource('tiendas', \App\Http\Controllers\Admin\TiendaController::class);
    Route::get('/tiendas/{tienda}/ventas', [\App\Http\Controllers\Admin\TiendaController::class, 'ventas'])->name('tiendas.ventas');
    Route::get('/tiendas/{tienda}/inventario', [\App\Http\Controllers\Admin\TiendaController::class, 'inventario'])->name('tiendas.inventario');

    // PRODUCTOS
    Route::resource('productos', ProductoController::class);
    Route::patch('/productos/{producto}/estado', [ProductoController::class, 'cambiarEstado'])
        ->name('productos.estado');
    Route::post('/productos/{producto}/stock', [ProductoController::class, 'actualizarStock'])
        ->name('productos.stock');
    Route::get('/productos-stock/bajo', [ProductoController::class, 'stockBajo'])
        ->name('productos.stock-bajo');

    // PEDIDOS
    Route::resource('pedidos', PedidoController::class);
    Route::patch('/pedidos/{pedido}/estado', [PedidoController::class, 'cambiarEstado'])
        ->name('pedidos.estado');
    Route::get('/pedidos-reportes/generales', [PedidoController::class, 'reporte'])
        ->name('pedidos.reporte');

    // CATEGORÍAS
    Route::resource('categorias', CategoriaController::class);
    Route::patch('/categorias/{categoria}/toggle', [CategoriaController::class, 'toggleActivo'])
        ->name('categorias.toggle');
    Route::get('/categorias-arbol/visual', [CategoriaController::class, 'arbol'])
        ->name('categorias.arbol');
});

// =========================================================================
// RUTAS DE AUTENTICACIÓN (Breeze)
// =========================================================================
require __DIR__ . '/auth.php';
