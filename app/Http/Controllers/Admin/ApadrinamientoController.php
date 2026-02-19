<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apadrinamiento;
use App\Models\Mascota;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ApadrinamientoController extends Controller
{
    /**
     * Listar todos los apadrinamientos
     */
    public function index()
    {
        $apadrinamientos = Apadrinamiento::with(['usuario', 'mascota'])
            ->latest()
            ->paginate(15);

        return view('admin.apadrinamientos.index', compact('apadrinamientos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $usuarios = Usuario::all();
        $mascotas = Mascota::where('estado', 'disponible')->get();
        return view('admin.apadrinamientos.create', compact('usuarios', 'mascotas'));
    }

    /**
     * Guardar nuevo apadrinamiento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'monto_mensual' => 'required|numeric|min:10000',
            'frecuencia' => 'required|in:mensual,trimestral,anual',
            'fecha_inicio' => 'required|date'
        ]);

        $validated['estado'] = 'activo';

        Apadrinamiento::create($validated);

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento creado exitosamente');
    }

    /**
     * Ver detalle
     */
    public function show($id)
    {
        $apadrinamiento = Apadrinamiento::with(['usuario', 'mascota.fundacion'])
            ->findOrFail($id);

        return view('admin.apadrinamientos.show', compact('apadrinamiento'));
    }

    /**
     * Editar
     */
    public function edit($id)
    {
        $apadrinamiento = Apadrinamiento::findOrFail($id);
        $usuarios = Usuario::all();
        $mascotas = Mascota::all();

        return view('admin.apadrinamientos.edit', compact('apadrinamiento', 'usuarios', 'mascotas'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'monto_mensual' => 'required|numeric|min:10000',
            'frecuencia' => 'required|in:mensual,trimestral,anual',
            'estado' => 'required|in:activo,cancelado,pendiente'
        ]);

        $apadrinamiento = Apadrinamiento::findOrFail($id);
        $apadrinamiento->update($validated);

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento actualizado');
    }

    /**
     * Cancelar (soft delete)
     */
    public function destroy($id)
    {
        $apadrinamiento = Apadrinamiento::findOrFail($id);
        $apadrinamiento->update(['estado' => 'cancelado']);

        return redirect()->route('admin.apadrinamientos.index')
            ->with('success', 'Apadrinamiento cancelado');
    }

    /**
     * Cambiar estado (ruta adicional)
     */
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate(['estado' => 'required|in:activo,cancelado,pendiente']);

        $apadrinamiento = Apadrinamiento::findOrFail($id);
        $apadrinamiento->update(['estado' => $request->estado]);

        return response()->json(['success' => true]);
    }
}
