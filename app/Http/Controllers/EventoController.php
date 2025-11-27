<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    // MÉTODOS DE ADMINISTRACIÓN
    public function index()
    {
        $eventos = Evento::orderBy('created_at', 'desc')->get();
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.eventos.create');
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
            $imagenUrl = '/storage/' . $imagenPath;
        }

        Evento::create([
            'Nombre_evento' => $request->Nombre_evento,
            'Lugar_evento' => $request->Lugar_evento,
            'Descripcion' => $request->Descripcion,
            'Fecha_evento' => $request->Fecha_evento,
            'imagen_url' => $imagenUrl,
            'administrador_id' => auth()->id()
        ]);

        return redirect()->route('admin.eventos.index') // MANTENER admin
            ->with('success', 'Evento creado exitosamente!');
    }

    public function show(Evento $evento)
    {
        return view('admin.eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        // Validación
        $validated = $request->validate([
            'Nombre_evento' => 'required|string|max:255',
            'Lugar_evento' => 'required|string|max:255',
            'Descripcion' => 'required|string',
            'Fecha_evento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Procesar imagen si se subió una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($evento->imagen_url) {
                Storage::delete(str_replace('/storage/', '', $evento->imagen_url));
            }
            
            // Guardar nueva imagen
            $imagePath = $request->file('imagen')->store('eventos', 'public');
            $validated['imagen_url'] = '/storage/' . $imagePath;
        } else {
            // Mantener la imagen actual si no se sube nueva
            $validated['imagen_url'] = $evento->imagen_url;
        }

        // Actualizar el evento
        $evento->update($validated);

        return redirect()->route('admin.eventos.index') // MANTENER admin
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        // Eliminar la imagen si existe
        if ($evento->imagen_url) {
            Storage::delete(str_replace('/storage/', '', $evento->imagen_url));
        }
        
        $evento->delete();
        
        return redirect()->route('admin.eventos.index') // MANTENER admin
            ->with('success', 'Evento eliminado correctamente.');
    }

    // MÉTODOS PÚBLICOS (para usuarios normales - SOLO LECTURA)
    public function publicindex()
    {
        $eventos = Evento::where('Fecha_evento', '>=', now())
                        ->orderBy('Fecha_evento', 'asc')
                        ->get();

        return view('public.eventos.index', compact('eventos'));
    }

    public function publicshow($id)
    {
        $evento = Evento::findOrFail($id);
        return view('public.eventos.show', compact('evento'));
    }
}