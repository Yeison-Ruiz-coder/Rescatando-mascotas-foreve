<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Adopcion;
use App\Models\Solicitud;
use App\Models\Reporte;
use App\Models\Rescate;
use App\Models\Donacion;
use App\Models\User;
use App\Models\Fundacion;
use App\Models\Veterinaria;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Dashboard principal
     */
    public function index()
    {
        // Estadísticas generales
        $totalMascotas = Mascota::count();
        $mascotasEnAdopcion = Mascota::where('estado', 'En adopcion')->count();
        $mascotasAdoptadas = Mascota::where('estado', 'Adoptado')->count();

        $totalUsuarios = User::count();
        $totalFundaciones = Fundacion::count();
        $totalVeterinarias = Veterinaria::count();

        $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->count();
        $adopcionesMes = Adopcion::whereMonth('created_at', now()->month)->count();

        $donacionesMes = Donacion::whereMonth('created_at', now()->month)->sum('valor_donacion');

        $reportesActivos = Reporte::where('estado', 'activo')->count();
        $rescatesMes = Rescate::whereMonth('created_at', now()->month)->count();

        // Gráfico de adopciones por mes (últimos 6 meses)
        $adopcionesPorMes = Adopcion::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Últimas solicitudes
        $ultimasSolicitudes = Solicitud::with('mascota')
                                              ->latest()
                                              ->take(5)
                                              ->get();

        // Últimos reportes
        $ultimosReportes = Reporte::with('usuario')
                                  ->latest()
                                  ->take(5)
                                  ->get();

        // Actividad reciente (eventos combinados)
        $actividadReciente = $this->getActividadReciente();

        return view('admin.dashboard.index', compact(
            'totalMascotas',
            'mascotasEnAdopcion',
            'mascotasAdoptadas',
            'totalUsuarios',
            'totalFundaciones',
            'totalVeterinarias',
            'solicitudesPendientes',
            'adopcionesMes',
            'donacionesMes',
            'reportesActivos',
            'rescatesMes',
            'adopcionesPorMes',
            'ultimasSolicitudes',
            'ultimosReportes',
            'actividadReciente'
        ));
    }

    /**
     * Obtener actividad reciente combinada
     */
    private function getActividadReciente()
    {
        $actividad = collect();

        // Adopciones recientes
        $adopciones = Adopcion::with(['adoptante', 'mascota'])
                             ->latest()
                             ->take(3)
                             ->get()
                             ->map(function ($item) {
                                 return [
                                     'tipo' => 'adopcion',
                                     'descripcion' => "Nueva adopción: {$item->mascota->nombre_mascota} para {$item->adoptante->nombre}",
                                     'fecha' => $item->created_at,
                                     'icon' => 'fa-heart',
                                     'color' => 'success'
                                 ];
                             });

        // Solicitudes nuevas
        $solicitudes = Solicitud::with('mascota')
                                       ->latest()
                                       ->take(3)
                                       ->get()
                                       ->map(function ($item) {
                                           return [
                                               'tipo' => 'solicitud',
                                               'descripcion' => "Nueva solicitud para {$item->mascota->nombre_mascota}",
                                               'fecha' => $item->created_at,
                                               'icon' => 'fa-file',
                                               'color' => 'info'
                                           ];
                                       });

        // Reportes nuevos
        $reportes = Reporte::latest()
                          ->take(3)
                          ->get()
                          ->map(function ($item) {
                              return [
                                  'tipo' => 'reporte',
                                  'descripcion' => "Nuevo reporte: {$item->titulo}",
                                  'fecha' => $item->created_at,
                                  'icon' => 'fa-flag',
                                  'color' => 'warning'
                              ];
                          });

        // Donaciones recientes
        $donaciones = Donacion::with('usuario', 'fundacion')
                             ->where('publica', true)
                             ->latest()
                             ->take(3)
                             ->get()
                             ->map(function ($item) {
                                 return [
                                     'tipo' => 'donacion',
                                     'descripcion' => "Donación de $" . number_format($item->valor_donacion, 0) . " a {$item->fundacion->Nombre_1}",
                                     'fecha' => $item->created_at,
                                     'icon' => 'fa-dollar-sign',
                                     'color' => 'success'
                                 ];
                             });

        return $actividad->concat($adopciones)
                        ->concat($solicitudes)
                        ->concat($reportes)
                        ->concat($donaciones)
                        ->sortByDesc('fecha')
                        ->take(10);
    }
}
