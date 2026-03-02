<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolicitudAdopcion;
use App\Models\Adopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudAdopcionController extends Controller
{
    /**
     * Listado de solicitudes
     */
    public function index(Request $request)
    {
        $query = SolicitudAdopcion::with('mascota', 'usuario', 'revisor');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('mascota_id')) {
            $query->where('mascota_id', $request->mascota_id);
        }

        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre_solicitante', 'like', '%' . $request->buscar . '%')
                  ->orWhere('apellido_solicitante', 'like', '%' . $request->buscar . '%')
                  ->orWhere('email', 'like', '%' . $request->buscar . '%');
            });
        }

        $solicitudes = $query->latest()->paginate(20);

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Mostrar solicitud
     */
    public function show($id)
    {
        $solicitud = SolicitudAdopcion::with(['mascota', 'usuario', 'revisor'])
                                      ->findOrFail($id);

        return view('admin.solicitudes.show', compact('solicitud'));
    }

    /**
     * Formulario de edición (solo notas y estado)
     */
    public function edit($id)
    {
        $solicitud = SolicitudAdopcion::findOrFail($id);
        return view('admin.solicitudes.edit', compact('solicitud'));
    }

    /**
     * Actualizar solicitud (notas)
     */
    public function update(Request $request, $id)
    {
        $solicitud = SolicitudAdopcion::findOrFail($id);

        $request->validate([
            'notas_administrador' => 'nullable|string',
        ]);

        $solicitud->update([
            'notas_administrador' => $request->notas_administrador,
        ]);

        return redirect()->route('admin.solicitudes.show', $id)
                        ->with('success', 'Notas actualizadas');
    }

    /**
     * Actualizar estado de solicitud
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En revisión,Aprobada,Rechazada',
            'razon_rechazo' => 'required_if:estado,Rechazada|nullable|string',
        ]);

        $solicitud = SolicitudAdopcion::findOrFail($id);

        DB::beginTransaction();

        try {
            $solicitud->estado = $request->estado;
            $solicitud->revisado_por = auth()->id();

            if ($request->estado === 'Rechazada') {
                $solicitud->razon_rechazo = $request->razon_rechazo;
            }

            $solicitud->save();

            // Si se aprueba, crear registro de adopción
            if ($request->estado === 'Aprobada') {
                Adopcion::create([
                    'solicitud_id' => $solicitud->id,
                    'user_id' => $solicitud->user_id ?? null,
                    'mascota_id' => $solicitud->mascota_id,
                    'fundacion_id' => $solicitud->mascota->fundacion_id,
                    'administrador_id' => auth()->id(),
                    'estado' => 'en_proceso',
                    'fecha_adopcion' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.solicitudes.show', $id)
                            ->with('success', 'Estado actualizado');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar estado');
        }
    }

    /**
     * Eliminar solicitud
     */
    public function destroy($id)
    {
        $solicitud = SolicitudAdopcion::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('admin.solicitudes.index')
                        ->with('success', 'Solicitud eliminada');
    }
}
