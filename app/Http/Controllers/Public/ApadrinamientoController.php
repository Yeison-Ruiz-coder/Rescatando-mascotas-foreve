<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Apadrinamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApadrinamientoController extends Controller
{
    /**
     * Listado de mascotas disponibles para apadrinar
     */
    public function index(Request $request)
    {
        $query = Mascota::with('fundacion')
                       ->whereIn('estado', ['En adopcion', 'Rescatada', 'En acogida']);

        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }

        $mascotas = $query->paginate(12);

        return view('public.apadrinamientos.index', compact('mascotas'));
    }

    /**
     * Planes de apadrinamiento
     */
    public function planes()
    {
        $planes = [
            ['nombre' => 'Básico', 'monto' => 20000, 'beneficios' => ['Certificado digital', 'Foto de la mascota']],
            ['nombre' => 'Estándar', 'monto' => 50000, 'beneficios' => ['Certificado', 'Fotos mensuales', 'Actualizaciones']],
            ['nombre' => 'Premium', 'monto' => 100000, 'beneficios' => ['Certificado', 'Fotos mensuales', 'Visitas virtuales', 'Nombre en placa']],
            ['nombre' => 'Corporativo', 'monto' => 200000, 'beneficios' => ['Reconocimiento en web', 'Informes trimestrales', 'Visitas presenciales']],
        ];

        return view('public.apadrinamientos.planes', compact('planes'));
    }

    /**
     * Iniciar proceso de apadrinamiento para una mascota
     */
    public function iniciar($mascotaId)
    {
        $mascota = Mascota::findOrFail($mascotaId);

        if (!in_array($mascota->estado, ['En adopcion', 'Rescatada', 'En acogida'])) {
            return redirect()->route('public.mascotas.show', $mascotaId)
                            ->with('error', 'Esta mascota no está disponible para apadrinamiento');
        }

        return view('public.apadrinamientos.iniciar', compact('mascota'));
    }

    /**
     * Procesar pago de apadrinamiento
     */
    public function procesarPago(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'monto_mensual' => 'required|numeric|min:5000',
            'frecuencia' => 'required|in:unica,mensual,trimestral,anual',
            'mensaje_apoyo' => 'nullable|string',
            'metodo_pago' => 'required|in:nequi,bancolombia,pse,tarjeta',
        ]);

        DB::beginTransaction();

        try {
            $apadrinamiento = Apadrinamiento::create([
                'user_id' => auth()->id(),
                'mascota_id' => $request->mascota_id,
                'monto_mensual' => $request->monto_mensual,
                'frecuencia' => $request->frecuencia,
                'fecha_inicio' => now(),
                'mensaje_apoyo' => $request->mensaje_apoyo,
                'estado' => 'activo',
            ]);

            // Aquí iría la lógica de procesamiento de pago real
            // Por ahora simulamos éxito

            DB::commit();

            return redirect()->route('public.apadrinamientos.confirmacion', $apadrinamiento->id)
                            ->with('success', '¡Apadrinamiento activado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar el apadrinamiento: ' . $e->getMessage());
        }
    }

    /**
     * Confirmación de apadrinamiento
     */
    public function confirmacion($id)
    {
        $apadrinamiento = Apadrinamiento::with(['mascota', 'usuario'])->findOrFail($id);

        // Verificar que pertenezca al usuario autenticado
        if ($apadrinamiento->user_id !== auth()->id()) {
            abort(403);
        }

        return view('public.apadrinamientos.confirmacion', compact('apadrinamiento'));
    }
}
