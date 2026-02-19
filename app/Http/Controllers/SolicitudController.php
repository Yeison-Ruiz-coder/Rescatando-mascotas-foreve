<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('usuario')
            ->orderBy('fecha_solicitud', 'desc')
            ->paginate(10);

        // DEBUG: Solo para desarrollo - ver la primera solicitud
        if ($solicitudes->count() > 0 && app()->environment('local')) {
            $primera = $solicitudes->first();
            logger('DEBUG Usuario:', [
                'usuario_id' => $primera->usuario_id,
                'usuario_existe' => !is_null($primera->usuario),
                'campos_usuario' => $primera->usuario ? array_keys($primera->usuario->getAttributes()) : [],
                'email' => $primera->usuario ? $primera->usuario->email : 'null'
            ]);
        }

        return view('admin.solicitud.index', compact('solicitudes'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        // CORREGIDO: Vista en admin.solicitud
        return view('admin.solicitud.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:Para Adoptar,Para Rescatar,Para Apadrinar,Para Donar',
            'contenido' => 'required|string',
            'fecha_solicitud' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id',
            'estado' => 'nullable|in:En Revisión,Aprobada,Rechazada'
        ]);

        Solicitud::create($request->all());

        // CORREGIDO: Ruta en singular
        return redirect()->route('solicitud.index')
            ->with('success', 'Solicitud creada exitosamente.');
    }

    public function show(Solicitud $solicitud)
    {
        $solicitud->load('usuario');
        // CORREGIDO: Vista en admin.solicitud
        return view('admin.solicitud.show', compact('solicitud'));
    }

    public function edit(Solicitud $solicitud)
    {
        $usuarios = Usuario::all();
        // CORREGIDO: Vista en admin.solicitud
        return view('admin.solicitud.edit', compact('solicitud', 'usuarios'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'tipo' => 'required|in:Para Adoptar,Para Rescatar,Para Apadrinar,Para Donar',
            'contenido' => 'required|string',
            'fecha_solicitud' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id',
            'estado' => 'required|in:En Revisión,Aprobada,Rechazada'
        ]);

        $solicitud->update($request->all());

        // CORREGIDO: Ruta en singular
        return redirect()->route('solicitud.show', $solicitud)
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function updateStatus(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'estado' => ['required', 'in:En Revisión,Aprobada,Rechazada'],
        ]);

        try {
            DB::beginTransaction();
            $solicitud->update(['estado' => $request->estado]);
            DB::commit();

            // CORREGIDO: Ruta en singular
            return redirect()->route('solicitud.index')
                ->with('success', 'Estado de la solicitud #' . $solicitud->id . ' actualizado a ' . $solicitud->estado . '.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el estado de la solicitud: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error al cambiar el estado.');
        }
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        // CORREGIDO: Ruta en singular
        return redirect()->route('solicitud.index')
            ->with('success', 'Solicitud eliminada exitosamente.');
    }
}
