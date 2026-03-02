<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adopcion;
use App\Models\SeguimientoAdopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdopcionController extends Controller
{
    /**
     * Listado de adopciones
     */
    public function index(Request $request)
    {
        $query = Adopcion::with(['adoptante', 'mascota', 'fundacion', 'administrador']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fundacion_id')) {
            $query->where('fundacion_id', $request->fundacion_id);
        }

        $adopciones = $query->latest()->paginate(20);
        $estados = ['Pendiente', 'En revisión', 'Aprobada', 'Rechazada', 'Completada'];
        $mascotas = \App\Models\Mascota::all();
        $usuarios = \App\Models\User::all();

        return view('admin.adopciones.index', compact('adopciones', 'estados', 'mascotas', 'usuarios'));
    }

    /**
     * Mostrar adopción
     */
    public function show($id)
    {
        $adopcion = Adopcion::with(['adoptante', 'mascota', 'fundacion', 'administrador', 'solicitud', 'seguimientos'])
                           ->findOrFail($id);

        return view('admin.adopciones.show', compact('adopcion'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        return view('admin.adopciones.edit', compact('adopcion'));
    }

    /**
     * Actualizar adopción
     */
    public function update(Request $request, $id)
    {
        $adopcion = Adopcion::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:en_proceso,aprobada,completada,rechazada,cancelada',
            'fecha_adopcion' => 'nullable|date',
            'fecha_cierre' => 'nullable|date',
            'razon_rechazo' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $adopcion->update($request->all());

            // Si se completa, actualizar estado de la mascota
            if ($request->estado === 'completada') {
                $adopcion->mascota->update(['estado' => 'Adoptado']);
            }

            DB::commit();

            return redirect()->route('admin.adopciones.show', $id)
                            ->with('success', 'Adopción actualizada');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar');
        }
    }

    /**
     * Ver seguimientos de una adopción
     */
    public function seguimientos($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $seguimientos = SeguimientoAdopcion::where('adopcion_id', $id)
                                          ->with('realizadoPor')
                                          ->latest()
                                          ->get();

        return view('admin.adopciones.seguimientos', compact('adopcion', 'seguimientos'));
    }

    /**
     * Agregar seguimiento
     */
    public function storeSeguimiento(Request $request, $id)
    {
        $request->validate([
            'fecha_seguimiento' => 'required|date',
            'observaciones' => 'required|string',
            'estado_mascota' => 'required|in:excelente,bueno,regular,preocupante',
            'foto_url' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['adopcion_id'] = $id;
        $data['realizado_por'] = auth()->id();

        if ($request->hasFile('foto_url')) {
            $data['foto_url'] = $request->file('foto_url')->store('seguimientos', 'public');
        }

        SeguimientoAdopcion::create($data);

        return back()->with('success', 'Seguimiento registrado');
    }
}
