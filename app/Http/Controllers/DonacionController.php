<?php
// app/Http/Controllers/DonacionController.php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Models\Fundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonacionController extends Controller
{
    /**
     * Ver donaciones públicas
     */
    public function index()
    {
        $donaciones = Donacion::with('fundacion')
            ->where('publica', true)
            ->latest()
            ->paginate(20);

        return view('public.donaciones.index', compact('donaciones'));
    }

    /**
     * Formulario para donar (público)
     */
    public function create()
    {
        $fundaciones = Fundacion::all();
        return view('public.donaciones.create', compact('fundaciones'));
    }

    /**
     * Guardar donación (usuario autenticado)
     */
    public function store(Request $request)
    {
        $request->validate([
            'valor_donacion' => 'required|numeric|min:1000',
            'fundacion_id' => 'required|exists:fundaciones,id',
            'comprobante' => 'required|image|max:2048'
        ]);

        $donacion = Donacion::create([
            'valor_donacion' => $request->valor_donacion,
            'Fecha_donacion' => now(),
            'usuario_id' => Auth::id(),
            'fundacion_id' => $request->fundacion_id,
            'estado' => 'pendiente',
            'publica' => $request->has('publica')
        ]);

        if ($request->hasFile('comprobante')) {
            $path = $request->file('comprobante')->store('comprobantes', 'public');
            $donacion->update(['comprobante' => $path]);
        }

        return redirect()->route('donaciones.show', $donacion)
            ->with('success', '¡Gracias por tu donación!');
    }

    /**
     * Ver recibo de UNA donación (solo dueño)
     */
    public function show($id)
    {
        $donacion = Donacion::with(['usuario', 'fundacion'])->findOrFail($id);

        // Verificar que sea el dueño
        if (Auth::id() !== $donacion->usuario_id) {
            abort(403, 'No puedes ver donaciones de otros usuarios');
        }

        return view('public.donaciones.show', compact('donacion'));
    }
}
