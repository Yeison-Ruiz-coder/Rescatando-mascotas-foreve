<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function index()
    {
        $suscripciones = Suscripcion::with('usuario')->get();
        return view('suscripciones.index', compact('suscripciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('suscripciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:Premiun,Free,Pago_mensual,Pago_semanal',
            'Contenido' => 'required|string',
            'Fecha_suscripcion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        Suscripcion::create($request->all());

        return redirect()->route('suscripciones.index')
            ->with('success', 'Suscripción creada exitosamente.');
    }

    public function show($id)
    {
        $suscripcion = Suscripcion::with('usuario')->findOrFail($id);
        return view('suscripciones.show', compact('suscripcion'));
    }

    public function edit($id)
    {
        $suscripcion = Suscripcion::findOrFail($id);
        $usuarios = Usuario::all();
        return view('suscripciones.edit', compact('suscripcion', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|in:Premiun,Free,Pago_mensual,Pago_semanal',
            'Contenido' => 'required|string',
            'Fecha_suscripcion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        $suscripcion = Suscripcion::findOrFail($id);
        $suscripcion->update($request->all());

        return redirect()->route('suscripciones.index')
            ->with('success', 'Suscripción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $suscripcion = Suscripcion::findOrFail($id);
        $suscripcion->delete();

        return redirect()->route('suscripciones.index')
            ->with('success', 'Suscripción eliminada exitosamente.');
    }
}