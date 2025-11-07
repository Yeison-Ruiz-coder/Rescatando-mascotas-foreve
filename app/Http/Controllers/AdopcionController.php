<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Usuario;
use App\Models\Mascota;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index()
    {
        $adopciones = Adopcion::with(['usuario', 'mascota'])->get();
        return view('adopciones.index', compact('adopciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $mascotas = Mascota::where('estado', 'En adopcion')->get();
        return view('adopciones.create', compact('usuarios', 'mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Lugar_adopcion' => 'required|string|max:255',
            'Fecha_adopcion' => 'required|date',
            'estado' => 'required|in:Aprobado,En proceso,Rechazado',
            'usuario_id' => 'required|exists:usuarios,id',
            'mascota_id' => 'required|exists:mascotas,id'
        ]);

        Adopcion::create($request->all());

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción creada exitosamente.');
    }

    public function show($id)
    {
        $adopcion = Adopcion::with(['usuario', 'mascota'])->findOrFail($id);
        return view('adopciones.show', compact('adopcion'));
    }

    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $usuarios = Usuario::all();
        $mascotas = Mascota::all();
        return view('adopciones.edit', compact('adopcion', 'usuarios', 'mascotas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Lugar_adopcion' => 'required|string|max:255',
            'Fecha_adopcion' => 'required|date',
            'estado' => 'required|in:Aprobado,En proceso,Rechazado',
            'usuario_id' => 'required|exists:usuarios,id',
            'mascota_id' => 'required|exists:mascotas,id'
        ]);

        $adopcion = Adopcion::findOrFail($id);
        $adopcion->update($request->all());

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $adopcion->delete();

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción eliminada exitosamente.');
    }
}