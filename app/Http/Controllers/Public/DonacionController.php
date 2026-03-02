<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Donacion;
use App\Models\Fundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonacionController extends Controller
{
    /**
     * Listado de donaciones públicas (solo las públicas)
     */
    public function index()
    {
        $donaciones = Donacion::with('usuario', 'fundacion')
                              ->where('publica', true)
                              ->latest()
                              ->paginate(15);

        $totalDonaciones = Donacion::sum('valor_donacion');
        $totalDonantes = Donacion::distinct('user_id')->count('user_id');

        return view('public.donaciones.index', compact('donaciones', 'totalDonaciones', 'totalDonantes'));
    }

    /**
     * Formulario de donación
     */
    public function create()
    {
        $fundaciones = Fundacion::all();
        $montosSugeridos = [20000, 50000, 100000, 200000, 500000];

        return view('public.donaciones.create', compact('fundaciones', 'montosSugeridos'));
    }

    /**
     * Guardar donación
     */
    public function store(Request $request)
    {
        $request->validate([
            'valor_donacion' => 'required|numeric|min:1000',
            'fundacion_id' => 'required|exists:fundaciones,id',
            'publica' => 'boolean',
            'metodo_pago' => 'required|in:nequi,bancolombia,pse,tarjeta',
        ]);

        DB::beginTransaction();

        try {
            $donacion = Donacion::create([
                'user_id' => auth()->id(),
                'fundacion_id' => $request->fundacion_id,
                'valor_donacion' => $request->valor_donacion,
                'publica' => $request->has('publica'),
                'fecha_donacion' => now(),
            ]);

            // Aquí iría la lógica de procesamiento de pago real

            DB::commit();

            return redirect()->route('public.donaciones.show', $donacion->id)
                            ->with('success', '¡Gracias por tu donación!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la donación');
        }
    }

    /**
     * Detalle de donación
     */
    public function show($id)
    {
        $donacion = Donacion::with('usuario', 'fundacion')->findOrFail($id);

        // Solo mostrar si es pública o es del usuario
        if (!$donacion->publica && $donacion->user_id !== auth()->id()) {
            abort(404);
        }

        return view('public.donaciones.show', compact('donacion'));
    }
}
