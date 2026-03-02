<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Evento;
use App\Models\Noticia;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página de inicio
     */
    public function index()
    {
        // Mascotas destacadas para adopción
        $mascotasDestacadas = Mascota::where('estado', 'En adopcion')
                                     ->with('fundacion')
                                     ->latest()
                                     ->take(6)
                                     ->get();

        // Próximos eventos
        $proximosEventos = Evento::where('fecha_evento', '>=', now())
                                 ->orderBy('fecha_evento', 'asc')
                                 ->take(3)
                                 ->get();

        // Estadísticas
        $totalMascotas = Mascota::count();
        $totalAdoptadas = Mascota::where('estado', 'Adoptado')->count();
        $totalFundaciones = \App\Models\Fundacion::count();
        $totalRescates = \App\Models\Rescate::count();

        // Productos destacados (tienda)
        $productosDestacados = Producto::where('estado', 'disponible')
                                       ->where('stock', '>', 0)
                                       ->where('destacado', true)
                                       ->take(4)
                                       ->get();

        return view('public.home', compact(
            'mascotasDestacadas',
            'proximosEventos',
            'totalMascotas',
            'totalAdoptadas',
            'totalFundaciones',
            'totalRescates',
            'productosDestacados'
        ));
    }
}
