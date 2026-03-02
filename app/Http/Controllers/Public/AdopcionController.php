<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\SolicitudAdopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdopcionController extends Controller
{
    /**
     * Proceso de adopción - paso 1: información
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
     * Formulario de solicitud para una mascota específica
     */
    public function solicitar($id)
    {
        $mascota = Mascota::findOrFail($id);

        if ($mascota->estado !== 'En adopcion') {
            return redirect()->route('public.mascotas.show', $id)
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
            'nombre_solicitante' => 'required|string|max:255',
            'apellido_solicitante' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'experiencia_mascotas' => 'required|string',
            'tipo_vivienda' => 'required|string|in:casa,apartamento,finca,otro',
            'motivo_adopcion' => 'required|string',
            'compromiso_cuidado' => 'accepted',
            'compromiso_esterilizacion' => 'accepted',
            'compromiso_seguimiento' => 'accepted',
        ]);

        $mascota = Mascota::find($request->mascota_id);

        if ($mascota->estado !== 'En adopcion') {
            return back()->with('error', 'Esta mascota ya no está disponible');
        }

        DB::beginTransaction();

        try {
            $solicitud = SolicitudAdopcion::create([
                'mascota_id' => $request->mascota_id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'nombre_solicitante' => $request->nombre_solicitante,
                'apellido_solicitante' => $request->apellido_solicitante,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'experiencia_mascotas' => $request->experiencia_mascotas,
                'tipo_vivienda' => $request->tipo_vivienda,
                'motivo_adopcion' => $request->motivo_adopcion,
                'compromiso_cuidado' => $request->has('compromiso_cuidado'),
                'compromiso_esterilizacion' => $request->has('compromiso_esterilizacion'),
                'compromiso_seguimiento' => $request->has('compromiso_seguimiento'),
                'estado' => 'Pendiente',
            ]);

            DB::commit();

            return redirect()->route('public.adopciones.solicitud-exitosa', $solicitud->id)
                            ->with('success', 'Solicitud enviada con éxito');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al enviar la solicitud: ' . $e->getMessage());
        }
    }

    /**
     * Página de confirmación de solicitud
     */
    public function solicitudExitosa($id)
    {
        $solicitud = SolicitudAdopcion::with('mascota')->findOrFail($id);
        return view('public.adopciones.exito', compact('solicitud'));
    }
}
