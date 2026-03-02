<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Listado público de eventos
     */
    public function index(Request $request)
    {
        $query = Evento::where('fecha_evento', '>=', now())
                      ->orWhere('fecha_evento', '>=', now()->subDay());

        // Filtro por mes
        if ($request->filled('mes')) {
            $query->whereMonth('fecha_evento', $request->mes);
        }

        // Filtro por año
        if ($request->filled('anio')) {
            $query->whereYear('fecha_evento', $request->anio);
        }

        $eventos = $query->orderBy('fecha_evento', 'asc')->paginate(9);

        return view('public.eventos.index', compact('eventos'));
    }

    /**
     * Detalle de evento
     */
    public function show($id)
    {
        $evento = Evento::with('creadoPor')->findOrFail($id);

        // Eventos relacionados (mismo mes)
        $relacionados = Evento::whereMonth('fecha_evento', date('m', strtotime($evento->fecha_evento)))
                              ->where('id', '!=', $evento->id)
                              ->limit(3)
                              ->get();

        return view('public.eventos.show', compact('evento', 'relacionados'));
    }

    /**
     * Vista de calendario
     */
    public function calendario()
    {
        $eventos = Evento::where('fecha_evento', '>=', now())
                        ->orderBy('fecha_evento', 'asc')
                        ->get();

        return view('public.eventos.calendario', compact('eventos'));
    }
}
