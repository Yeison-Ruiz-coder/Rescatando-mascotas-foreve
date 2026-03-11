<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\User;
use App\Models\Fundacion;
use App\Models\Solicitud;
use App\Models\SeguimientoAdopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdopcionController extends Controller
{
    /**
     * Constructor - aplicar middleware si es necesario
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * LISTADO DE ADOPCIONES (index)
     * GET /admin/adopciones
     */
    public function index(Request $request)
    {
        $query = Adopcion::with([
            'adoptante',
            'mascota',
            'fundacion',
            'administrador',
            'solicitud'
        ]);

        // Aplicar filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('mascota_id')) {
            $query->where('mascota_id', $request->mascota_id);
        }

        if ($request->filled('usuario_id')) {
            $query->where('user_id', $request->usuario_id);
        }

        if ($request->filled('busqueda')) {
            $busqueda = $request->busqueda;
            $query->where(function($q) use ($busqueda) {
                $q->whereHas('mascota', function($mq) use ($busqueda) {
                    $mq->where('nombre', 'LIKE', "%{$busqueda}%");
                })->orWhere('Lugar_adopcion', 'LIKE', "%{$busqueda}%");
            });
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_adopcion', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_adopcion', '<=', $request->fecha_hasta);
        }

        $adopciones = $query->orderBy('created_at', 'desc')->paginate(15);

        // Datos para los filtros
        $estados = ['en_proceso', 'aprobada', 'completada', 'rechazada', 'cancelada'];
        $mascotas = Mascota::all();
        $usuarios = User::all();

        return view('admin.adopciones.index', compact(
            'adopciones',
            'estados',
            'mascotas',
            'usuarios'
        ));
    }

    /**
     * FORMULARIO DE CREACIÓN (create)
     * GET /admin/adopciones/create
     */
    public function create()
    {
        $mascotas = Mascota::where('estado', 'Disponible')
                           ->orWhere('estado', 'En proceso de adopción')
                           ->get();

        $usuarios = User::where('tipo', 'adoptante')
                        ->orWhere('tipo', 'usuario')
                        ->get();

        $fundaciones = Fundacion::all();

        $solicitudes = Solicitud::where('estado', 'aprobada')
                                ->orWhere('estado', 'en_proceso')
                                ->get();

        $estados = [
            'en_proceso' => 'En Proceso',
            'aprobada' => 'Aprobada',
            'completada' => 'Completada',
            'rechazada' => 'Rechazada',
            'cancelada' => 'Cancelada'
        ];

        return view('admin.adopciones.create', compact(
            'mascotas',
            'usuarios',
            'fundaciones',
            'solicitudes',
            'estados'
        ));
    }

    /**
     * GUARDAR NUEVA ADOPCIÓN (store)
     * POST /admin/adopciones
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_adopcion' => 'nullable|date',
            'estado' => 'required|in:en_proceso,aprobada,completada,rechazada,cancelada',
            'razon_rechazo' => 'nullable|string|max:500',
            'fecha_cierre' => 'nullable|date|after_or_equal:fecha_adopcion',
            'solicitud_id' => 'nullable|exists:solicitudes,id',
            'user_id' => 'required|exists:users,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
        ]);

        DB::beginTransaction();

        try {
            $validated['administrador_id'] = Auth::id();

            if (empty($validated['fecha_adopcion'])) {
                $validated['fecha_adopcion'] = now();
            }

            $adopcion = Adopcion::create($validated);

            // Actualizar estado de la mascota
            $this->actualizarEstadoMascota($adopcion);

            DB::commit();

            return redirect()
                ->route('admin.adopciones.show', $adopcion->id)
                ->with('success', 'Adopción creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Error al crear la adopción: ' . $e->getMessage());
        }
    }

    /**
     * VER DETALLE DE ADOPCIÓN (show)
     * GET /admin/adopciones/{id}
     */
    public function show($id)
    {
        $adopcion = Adopcion::with([
            'adoptante',
            'mascota',
            'fundacion',
            'administrador',
            'solicitud',
            'entrevistas',
            'seguimientos' => function($q) {
                $q->with('realizadoPor')->latest();
            }
        ])->findOrFail($id);

        return view('admin.adopciones.show', compact('adopcion'));
    }

    /**
     * FORMULARIO DE EDICIÓN (edit)
     * GET /admin/adopciones/{id}/edit
     */
    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        $mascotas = Mascota::all();
        $usuarios = User::all();
        $fundaciones = Fundacion::all();
        $solicitudes = Solicitud::all();

        $estados = [
            'en_proceso' => 'En Proceso',
            'aprobada' => 'Aprobada',
            'completada' => 'Completada',
            'rechazada' => 'Rechazada',
            'cancelada' => 'Cancelada'
        ];

        return view('admin.adopciones.edit', compact(
            'adopcion',
            'mascotas',
            'usuarios',
            'fundaciones',
            'solicitudes',
            'estados'
        ));
    }

    /**
     * ACTUALIZAR ADOPCIÓN (update)
     * PUT/PATCH /admin/adopciones/{id}
     */
    public function update(Request $request, $id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $estadoAnterior = $adopcion->estado;

        $validated = $request->validate([
            'fecha_adopcion' => 'nullable|date',
            'estado' => 'required|in:en_proceso,aprobada,completada,rechazada,cancelada',
            'razon_rechazo' => 'nullable|string|max:500',
            'fecha_cierre' => 'nullable|date|after_or_equal:fecha_adopcion',
            'solicitud_id' => 'nullable|exists:solicitudes,id',
            'user_id' => 'required|exists:users,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
        ]);

        DB::beginTransaction();

        try {
            $adopcion->update($validated);

            // Si el estado cambió, actualizar el estado de la mascota
            if ($estadoAnterior !== $adopcion->estado) {
                $this->actualizarEstadoMascota($adopcion);
            }

            DB::commit();

            return redirect()
                ->route('admin.adopciones.show', $id)
                ->with('success', 'Adopción actualizada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la adopción: ' . $e->getMessage());
        }
    }

    /**
     * ELIMINAR ADOPCIÓN (destroy)
     * DELETE /admin/adopciones/{id}
     */
    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        DB::beginTransaction();

        try {
            // Verificar si tiene seguimientos o entrevistas
            if ($adopcion->seguimientos()->count() > 0 || $adopcion->entrevistas()->count() > 0) {
                return back()->with('error', 'No se puede eliminar una adopción que tiene seguimientos o entrevistas.');
            }

            // Si la mascota estaba adoptada, devolverla a disponible
            if ($adopcion->estado === 'completada' && $adopcion->mascota) {
                $adopcion->mascota->update(['estado' => 'Disponible']);
            }

            $adopcion->delete();

            DB::commit();

            return redirect()
                ->route('admin.adopciones.index')
                ->with('success', 'Adopción eliminada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error al eliminar la adopción: ' . $e->getMessage());
        }
    }

    /**
     * MÉTODOS ADICIONALES
     */

    /**
     * Cambiar estado rápido
     */
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:en_proceso,aprobada,completada,rechazada,cancelada',
            'razon_rechazo' => 'required_if:estado,rechazada,cancelada|nullable|string'
        ]);

        $adopcion = Adopcion::findOrFail($id);

        DB::beginTransaction();

        try {
            $adopcion->estado = $request->estado;

            if (in_array($request->estado, ['rechazada', 'cancelada'])) {
                $adopcion->razon_rechazo = $request->razon_rechazo;
                $adopcion->fecha_cierre = now();
            }

            if ($request->estado === 'completada') {
                $adopcion->fecha_cierre = now();
            }

            $adopcion->save();
            $this->actualizarEstadoMascota($adopcion);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Estado actualizado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
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

        if (request()->wantsJson()) {
            return response()->json($seguimientos);
        }

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
        ]);

        $adopcion = Adopcion::findOrFail($id);

        $seguimiento = new SeguimientoAdopcion([
            'adopcion_id' => $id,
            'fecha_seguimiento' => $request->fecha_seguimiento,
            'observaciones' => $request->observaciones,
            'estado_mascota' => $request->estado_mascota,
            'realizado_por' => Auth::id(),
        ]);

        $seguimiento->save();

        return redirect()
            ->back()
            ->with('success', 'Seguimiento registrado correctamente');
    }

    /**
     * Método auxiliar para actualizar estado de mascota
     */
    private function actualizarEstadoMascota($adopcion)
    {
        if (!$adopcion->mascota) {
            return;
        }

        switch ($adopcion->estado) {
            case 'completada':
                $adopcion->mascota->update(['estado' => 'Adoptado']);
                break;
            case 'en_proceso':
            case 'aprobada':
                $adopcion->mascota->update(['estado' => 'En proceso de adopción']);
                break;
            case 'rechazada':
            case 'cancelada':
                $adopcion->mascota->update(['estado' => 'Disponible']);
                break;
        }
    }
}
