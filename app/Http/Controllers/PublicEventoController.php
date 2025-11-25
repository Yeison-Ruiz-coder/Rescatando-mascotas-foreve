<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class PublicEventoController extends Controller
{
    public function index()
    {
        // Mostrar solo eventos futuros o todos
        $eventos = Evento::where('Fecha_evento', '>=', now())
                        ->orderBy('Fecha_evento', 'asc')
                        ->get();
        
        return view('eventos.public.index', compact('eventos'));
    }

    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.public.show', compact('evento'));
    }
}