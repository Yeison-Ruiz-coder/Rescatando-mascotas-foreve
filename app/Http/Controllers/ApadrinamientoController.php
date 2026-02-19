<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Apadrinamiento;
use Illuminate\Http\Request;

class ApadrinamientoController extends Controller
{
    /**
     * Mostrar planes al público
     */
    public function planes()
    {
        $mascotas = Mascota::where('estado', 'disponible')
            ->with('fundacion')
            ->get();

        return view('public.apadrinamientos.planes', compact('mascotas'));
    }

    /**
     * Iniciar proceso de apadrinamiento
     */
    public function iniciar($mascotaId)
    {
        if (!auth()->check()) {
            session(['apadrinamiento_pendiente' => $mascotaId]);
            return redirect()->route('login')
                ->with('info', 'Inicia sesión para apadrinar');
        }

        $mascota = Mascota::findOrFail($mascotaId);
        return view('public.apadrinamientos.pago', compact('mascota'));
    }

    /**
     * Procesar pago
     */
    public function procesarPago(Request $request)
    {
        // Lógica de pago...
        // Crear apadrinamiento en estado 'pendiente'
    }

    /**
     * Confirmación
     */
    public function confirmacion($id)
    {
        $apadrinamiento = Apadrinamiento::with('mascota')
            ->where('usuario_id', auth()->id())
            ->findOrFail($id);

        return view('public.apadrinamientos.confirmacion', compact('apadrinamiento'));
    }
}
