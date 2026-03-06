<?php
// app/Http/Controllers/Admin/SolicitudController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\Mascota;
use App\Models\Adopcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SolicitudController extends Controller
{
    /**
     * Listado de solicitudes con filtros mejorados
     */
    public function index(Request $request)
    {
        $query = Solicitud::with(['usuario', 'revisor', 'solicitable'])
            ->orderBy('fecha_solicitud', 'desc');

        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $request->tipo_solicitud);
        }

        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre_solicitante', 'like', '%' . $request->buscar . '%')
                  ->orWhere('email_solicitante', 'like', '%' . $request->buscar . '%')
                  ->orWhere('telefono_solicitante', 'like', '%' . $request->buscar . '%')
                  ->orWhereHas('usuario', function ($userQuery) use ($request) {
                      $userQuery->where('nombre', 'like', '%' . $request->buscar . '%')
                               ->orWhere('apellidos', 'like', '%' . $request->buscar . '%')
                               ->orWhere('email', 'like', '%' . $request->buscar . '%');
                  });
            });
        }

        $solicitudes = $query->paginate(20);

        $estadisticas = [
            'pendientes' => Solicitud::where('estado', 'pendiente')->count(),
            'en_revision' => Solicitud::where('estado', 'en_revision')->count(),
            'aprobadas' => Solicitud::where('estado', 'aprobada')->count(),
            'rechazadas' => Solicitud::where('estado', 'rechazada')->count(),
            'total' => Solicitud::count(),
        ];

        return view('admin.solicitud.index', compact('solicitudes', 'estadisticas'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        // Usar 'nombre' para usuarios
        $usuarios = User::orderBy('nombre')->get();

        // CORREGIDO: Usar 'nombre_mascota' en lugar de 'nombre'
        $mascotas = Mascota::where('estado', 'En adopcion')
            ->orderBy('nombre_mascota')
            ->get();

        return view('admin.solicitud.create', compact('usuarios', 'mascotas'));
    }

    /**
     * Guardar nueva solicitud
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_solicitud' => 'required|in:adopcion,rescate,apadrinamiento,donacion,otro',
            'contenido' => 'required|string|min:10',
            'user_id' => 'nullable|exists:users,id',
            'nombre_solicitante' => 'required_without:user_id|string|max:255',
            'email_solicitante' => 'required_without:user_id|email|max:255',
            'telefono_solicitante' => 'nullable|string|max:20',
            'solicitable_id' => 'required',
            'solicitable_type' => 'required|string',

            // Datos específicos de adopción (si aplica)
            'datos_adopcion' => 'nullable|array',
            'datos_adopcion.apellido_solicitante' => 'nullable|string|max:255',
            'datos_adopcion.experiencia_mascotas' => 'nullable|string',
            'datos_adopcion.tipo_vivienda' => 'nullable|string',
            'datos_adopcion.motivo_adopcion' => 'nullable|string',
            'datos_adopcion.direccion' => 'nullable|string',
            'datos_adopcion.compromiso_cuidado' => 'nullable|boolean',
            'datos_adopcion.compromiso_esterilizacion' => 'nullable|boolean',
            'datos_adopcion.compromiso_seguimiento' => 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            $solicitud = Solicitud::create([
                'tipo_solicitud' => $request->tipo_solicitud,
                'contenido' => $request->contenido,
                'fecha_solicitud' => now(),
                'estado' => 'pendiente',
                'user_id' => $request->user_id,
                'nombre_solicitante' => $request->nombre_solicitante,
                'email_solicitante' => $request->email_solicitante,
                'telefono_solicitante' => $request->telefono_solicitante,
                'solicitable_id' => $request->solicitable_id,
                'solicitable_type' => $request->solicitable_type,
            ]);

            // Guardar datos adicionales según el tipo
            if ($request->tipo_solicitud === 'adopcion' && $request->has('datos_adopcion')) {
                $solicitud->setDatosAdopcion($request->datos_adopcion)->save();
            }

            DB::commit();

            return redirect()->route('admin.solicitudes.show', $solicitud)
                ->with('success', 'Solicitud creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear solicitud: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Error al crear la solicitud. Por favor intenta nuevamente.');
        }
    }

    /**
     * Mostrar detalle de solicitud
     */
    public function show($id)
    {
        $solicitud = Solicitud::with(['usuario', 'revisor', 'solicitable'])
            ->findOrFail($id);

        return view('admin.solicitud.show', compact('solicitud'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $usuarios = User::orderBy('nombre')->get();

        // CORREGIDO: Usar 'nombre_mascota' en lugar de 'nombre'
        $mascotas = Mascota::where('estado', 'En adopcion')
            ->orderBy('nombre_mascota')
            ->get();

        return view('admin.solicitud.edit', compact('solicitud', 'usuarios', 'mascotas'));
    }

    /**
     * Actualizar solicitud
     */
    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $request->validate([
            'tipo_solicitud' => 'required|in:adopcion,rescate,apadrinamiento,donacion,otro',
            'contenido' => 'required|string|min:10',
            'estado' => 'required|in:pendiente,en_revision,aprobada,rechazada,completada',
            'notas_internas' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $solicitud->update($request->only([
                'tipo_solicitud', 'contenido', 'estado', 'notas_internas'
            ]));

            DB::commit();

            return redirect()->route('admin.solicitudes.show', $solicitud)
                ->with('success', 'Solicitud actualizada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar solicitud: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Error al actualizar la solicitud.');
        }
    }

    /**
     * Actualizar estado de solicitud
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_revision,aprobada,rechazada,completada',
            'razon_rechazo' => 'required_if:estado,rechazada|nullable|string|max:500',
        ]);

        $solicitud = Solicitud::with('solicitable')->findOrFail($id);

        DB::beginTransaction();

        try {
            // Actualizar estado
            $solicitud->estado = $request->estado;
            $solicitud->revisado_por = auth()->id();
            $solicitud->fecha_revision = now();

            if ($request->estado === 'rechazada') {
                $solicitud->razon_rechazo = $request->razon_rechazo;
            }

            $solicitud->save();

            // Si se aprueba una solicitud de adopción, crear registro de adopción
            if ($request->estado === 'aprobada' &&
                $solicitud->tipo_solicitud === 'adopcion' &&
                $solicitud->solicitable_type === 'App\Models\Mascota') {

                Adopcion::create([
                    'solicitud_id' => $solicitud->id,
                    'user_id' => $solicitud->user_id,
                    'mascota_id' => $solicitud->solicitable_id,
                    'fundacion_id' => $solicitud->solicitable->fundacion_id ?? null,
                    'administrador_id' => auth()->id(),
                    'estado' => 'en_proceso',
                    'fecha_adopcion' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.solicitudes.show', $id)
                ->with('success', 'Estado actualizado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar estado: ' . $e->getMessage());

            return back()->with('error', 'Error al actualizar el estado.');
        }
    }

    /**
     * Eliminar solicitud
     */
    public function destroy($id)
    {
        try {
            $solicitud = Solicitud::findOrFail($id);
            $solicitud->delete();

            return redirect()->route('admin.solicitudes.index')
                ->with('success', 'Solicitud eliminada correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar solicitud: ' . $e->getMessage());

            return back()->with('error', 'Error al eliminar la solicitud.');
        }
    }

    /**
     * Obtener datos de mascota para el formulario (AJAX)
     */
    public function getMascotaInfo($id)
    {
        $mascota = Mascota::find($id);

        if (!$mascota) {
            return response()->json(['error' => 'Mascota no encontrada'], 404);
        }

        return response()->json([
            'id' => $mascota->id,
            'nombre' => $mascota->nombre_mascota, // CORREGIDO: usar nombre_mascota
            'estado' => $mascota->estado,
            'disponible' => $mascota->estado === 'En adopcion'
        ]);
    }
}
