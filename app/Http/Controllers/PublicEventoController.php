<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class PublicEventoController extends Controller
{
    public function index()
    {
        // Obtener solo eventos futuros o mostrar todos
        $eventos = Evento::where('Fecha_evento', '>=', now())
                        ->orderBy('Fecha_evento', 'asc')
                        ->get();
        
        // O si quieres mostrar todos los eventos (pasados y futuros)
        // $eventos = Evento::all();
        
        return view('eventos.public.index', compact('eventos'));
    }

    public function show(Evento $evento)
    {
        return view('eventos.public.show', compact('evento'));
    }
}