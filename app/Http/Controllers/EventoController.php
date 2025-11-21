<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    // Mostrar todos los eventos
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    // Formulario para crear evento
    public function create()
    {
        return view('eventos.create');
    }

    // Guardar evento
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_evento' => 'required',
            'Lugar_evento' => 'required',
            'Descripcion' => 'required',
            'imagen' => 'nullable|image_url|mimes:jpg,jpeg,png'
        ]);

        $evento = new Evento();
        $evento->Nombre_evento = $request->Nombre_evento;
        $evento->Lugar_evento = $request->Lugar_evento;
        $evento->Descripcion = $request->Descripcion;

        // Guardar imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/eventos', $filename);
            $evento->imagen_url = $filename;
        }

        $evento->save();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado correctamente');
    }
}
