<?php
// app/Http/Controllers/Public/AdopcionController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdopcionController extends Controller
{
    /**
     * Listado de mascotas en adopción
     */
    public function index()
    {
        $mascotas = Mascota::where('estado', 'En adopcion')
            ->with('fundacion')
            ->latest()
            ->paginate(9);

        return view('public.adopciones.index', compact('mascotas'));
    }

    /**
     * Mostrar detalle de mascota para adopción
     */
    public function show($id)
    {
        $mascota = Mascota::with(['fundacion', 'razas'])->findOrFail($id);

        if ($mascota->estado !== 'En adopcion') {
            return redirect()->route('public.adopciones.index')
                ->with('error', 'Esta mascota no está disponible para adopción');
        }

        return view('public.adopciones.show', compact('mascota'));
    }

    /**
     * Formulario de solicitud para una mascota específica
     */
    public function solicitar($id)
    {
        $mascota = Mascota::with(['fundacion', 'razas'])->findOrFail($id);

        if ($mascota->estado !== 'En adopcion') {
            return redirect()->route('public.adopciones.index')
                ->with('error', 'Esta mascota no está disponible para adopción');
        }

        return view('public.adopciones.solicitar', compact('mascota'));
    }

    /**
     * Guardar solicitud de adopción
     */
    public function solicitarStore(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'documento_identidad' => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'experiencia_mascotas' => 'required|string',
            'tipo_vivienda' => 'required|string',
            'motivo_adopcion' => 'required|string|min:20',
            'compromiso_cuidado' => 'accepted',
            'compromiso_esterilizacion' => 'accepted',
            'compromiso_seguimiento' => 'accepted',
        ], [
            'compromiso_cuidado.accepted' => 'Debes aceptar el compromiso de cuidado responsable',
            'compromiso_esterilizacion.accepted' => 'Debes aceptar el compromiso de esterilización',
            'compromiso_seguimiento.accepted' => 'Debes aceptar el compromiso de seguimiento',
            'motivo_adopcion.min' => 'El motivo de adopción debe tener al menos 20 caracteres',
        ]);

        $mascota = Mascota::find($request->mascota_id);

        if ($mascota->estado !== 'En adopcion') {
            return back()->with('error', 'Esta mascota ya no está disponible para adopción');
        }

        DB::beginTransaction();

        try {
            // Crear solicitud unificada
            $solicitud = Solicitud::create([
                'tipo_solicitud' => 'adopcion',
                'contenido' => $request->motivo_adopcion,
                'fecha_solicitud' => now(),
                'estado' => 'pendiente',
                'user_id' => auth()->check() ? auth()->id() : null,
                'nombre_solicitante' => $request->nombre,
                'email_solicitante' => $request->email,
                'telefono_solicitante' => $request->telefono,
                'solicitable_id' => $request->mascota_id,
                'solicitable_type' => 'App\Models\Mascota',
            ]);

            // Guardar datos adicionales específicos de adopción en el campo JSON
            $solicitud->setDatosAdopcion([
                'apellido_solicitante' => $request->apellido,
                'documento_identidad' => $request->documento_identidad,
                'direccion' => $request->direccion,
                'experiencia_mascotas' => $request->experiencia_mascotas,
                'tipo_vivienda' => $request->tipo_vivienda,
                'compromiso_cuidado' => $request->has('compromiso_cuidado'),
                'compromiso_esterilizacion' => $request->has('compromiso_esterilizacion'),
                'compromiso_seguimiento' => $request->has('compromiso_seguimiento'),
            ])->save();

            DB::commit();

            return redirect()->route('public.adopciones.solicitud-exitosa', $solicitud->id)
                ->with('success', '¡Solicitud enviada con éxito! La fundación revisará tu solicitud y te contactará pronto.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear solicitud de adopción: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'Error al enviar la solicitud. Por favor intenta nuevamente.');
        }
    }

    /**
     * Página de confirmación de solicitud
     */
    public function solicitudExitosa($id)
    {
        $solicitud = Solicitud::with('solicitable')->findOrFail($id);

        if ($solicitud->tipo_solicitud !== 'adopcion') {
            abort(404);
        }

        return view('public.adopciones.exito', compact('solicitud'));
    }

    /**
     * Verificar disponibilidad de mascota (AJAX)
     */
    public function verificarDisponibilidad($id)
    {
        $mascota = Mascota::find($id);

        if (!$mascota) {
            return response()->json([
                'disponible' => false,
                'mensaje' => 'Mascota no encontrada'
            ], 404);
        }

        return response()->json([
            'disponible' => $mascota->estado === 'En adopcion',
            'estado' => $mascota->estado,
            'nombre' => $mascota->nombre_mascota
        ]);
    }


    /**
     * Mostrar solicitudes del usuario actual
     */
    public function misSolicitudes(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para ver tus solicitudes');
        }

        $solicitudes = Solicitud::where('user_id', $user->id)
            ->where('tipo_solicitud', 'adopcion')
            ->with('solicitable')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.adopciones.mis-solicitudes', compact('solicitudes'));
    }

    /**
     * Mostrar solicitudes en proceso (aprobadas pero no completadas)
     */
    public function enProceso(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para ver tus procesos');
        }

        $solicitudes = Solicitud::where('user_id', $user->id)
            ->where('tipo_solicitud', 'adopcion')
            ->whereIn('estado', ['aprobada', 'en_revision'])
            ->with('solicitable')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.adopciones.en-proceso', compact('solicitudes'));
    }
    /**
     * Mostrar detalle de una solicitud específica
     */
    public function solicitudDetalle($id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $solicitud = Solicitud::where('id', $id)
            ->where('user_id', $user->id)
            ->where('tipo_solicitud', 'adopcion')
            ->with(['solicitable', 'revisor'])
            ->firstOrFail();

        return view('public.adopciones.solicitud-detalle', compact('solicitud'));
    }
}
