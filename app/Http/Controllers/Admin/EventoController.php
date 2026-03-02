<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Listado de eventos
     */
    public function index(Request $request)
    {
        $query = Evento::query();

        if ($request->filled('desde')) {
            $query->whereDate('fecha_evento', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('fecha_evento', '<=', $request->hasta);
        }

        $eventos = $query->orderBy('fecha_evento', 'asc')->paginate(15);

        return view('admin.eventos.index', compact('eventos'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('admin.eventos.create');
    }

    /**
     * Guardar evento
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'lugar_evento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_evento' => 'required|date',
            'imagen_url' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('imagen_url');
        $data['creado_por_id'] = auth()->id();

        if ($request->hasFile('imagen_url')) {
            $path = $request->file('imagen_url')->store('eventos', 'public');
            $data['imagen_url'] = $path;
        }

        Evento::create($data);

        return redirect()->route('admin.eventos.index')
                        ->with('success', 'Evento creado');
    }

    /**
     * Mostrar evento
     */
    public function show($id)
    {
        $evento = Evento::with('creadoPor')->findOrFail($id);
        return view('admin.eventos.show', compact('evento'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    /**
     * Actualizar evento
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'lugar_evento' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_evento' => 'required|date',
            'imagen_url' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('imagen_url');

        if ($request->hasFile('imagen_url')) {
            if ($evento->imagen_url) {
                Storage::disk('public')->delete($evento->imagen_url);
            }
            $path = $request->file('imagen_url')->store('eventos', 'public');
            $data['imagen_url'] = $path;
        }

        $evento->update($data);

        return redirect()->route('admin.eventos.show', $id)
                        ->with('success', 'Evento actualizado');
    }

    /**
     * Eliminar evento
     */
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        if ($evento->imagen_url) {
            Storage::disk('public')->delete($evento->imagen_url);
        }

        $evento->delete();

        return redirect()->route('admin.eventos.index')
                        ->with('success', 'Evento eliminado');
    }

    /**
     * Vista de calendario
     */
    public function calendar()
    {
        return view('admin.eventos.calendar');
    }

    /**
     * Datos para calendario (JSON)
     */
    public function calendarData()
    {
        $eventos = Evento::all()->map(function ($evento) {
            return [
                'id' => $evento->id,
                'title' => $evento->nombre_evento,
                'start' => $evento->fecha_evento,
                'url' => route('admin.eventos.show', $evento->id),
                'description' => $evento->descripcion,
            ];
        });

        return response()->json($eventos);
    }
}
