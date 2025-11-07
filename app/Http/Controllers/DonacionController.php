<?php

namespace App\Http\Controllers;

use App\Models\Donacion;
use App\Models\Usuario;
use App\Models\Fundacion;
use Illuminate\Http\Request;

class DonacionController extends Controller
{
    public function index()
    {
        $donaciones = Donacion::with(['usuario', 'fundacion'])->get();
        return view('donaciones.index', compact('donaciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $fundaciones = Fundacion::all();
        return view('donaciones.create', compact('usuarios', 'fundaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor_donacion' => 'required|numeric|min:0',
            'Fecha_donacion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id',
            'fundacion_id' => 'required|exists:fundaciones,id'
        ]);

        Donacion::create($request->all());

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación creada exitosamente.');
    }

    public function show($id)
    {
        $donacion = Donacion::with(['usuario', 'fundacion'])->findOrFail($id);
        return view('donaciones.show', compact('donacion'));
    }

    public function edit($id)
    {
        $donacion = Donacion::findOrFail($id);
        $usuarios = Usuario::all();
        $fundaciones = Fundacion::all();
        return view('donaciones.edit', compact('donacion', 'usuarios', 'fundaciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'valor_donacion' => 'required|numeric|min:0',
            'Fecha_donacion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id',
            'fundacion_id' => 'required|exists:fundaciones,id'
        ]);

        $donacion = Donacion::findOrFail($id);
        $donacion->update($request->all());

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->delete();

        return redirect()->route('donaciones.index')
            ->with('success', 'Donación eliminada exitosamente.');
    }
}