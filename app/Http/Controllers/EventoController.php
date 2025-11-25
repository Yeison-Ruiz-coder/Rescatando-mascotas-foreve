<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderBy('Fecha_evento', 'desc')->get();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_evento' => 'required|string|max:255',
            'Lugar_evento' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Fecha_evento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagenUrl = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('eventos', 'public');
            $imagenUrl = Storage::url($imagenPath);
        }

        Evento::create([
            'Nombre_evento' => $request->Nombre_evento,
            'Lugar_evento' => $request->Lugar_evento,
            'Descripcion' => $request->Descripcion,
            'Fecha_evento' => $request->Fecha_evento,
            'imagen_url' => $imagenUrl,
            'administrador_id' => auth()->id() // o el ID del admin según tu lógica
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente!');
    }

    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }
    public function destroy(Evento $evento)
    {
    // Eliminar la imagen si existe
    if ($evento->imagen_url) {
        Storage::delete(str_replace('/storage', '', $evento->imagen_url));
    }
    
    $evento->delete();
    
    return redirect()->route('eventos.index')
        ->with('success', 'Evento eliminado correctamente.');
    }
    public function edit(Evento $evento)
{
    return view('eventos.edit', compact('evento'));
}

    public function update(Request $request, Evento $evento)
    {
    // Lógica para actualizar el evento
    }
}