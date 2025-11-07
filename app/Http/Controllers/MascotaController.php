<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Fundacion;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::with('fundacion')->get();
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        $fundaciones = Fundacion::all();
        return view('mascotas.create', compact('fundaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_mascota' => 'required|string|max:255',
            'Raza' => 'required|string|max:255',
            'estado' => 'required|in:Adoptado,En adopcion,Rescatada',
            'Edad_aprox' => 'required|integer|unique:mascotas',
            'Genero' => 'required|string|unique:mascotas',
            'Descripcion' => 'required|string',
            'vacunas' => 'required|string|unique:mascotas',
            'Fecha_ingreso' => 'required|date|unique:mascotas'
        ]);

        Mascota::create($request->all());

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota creada exitosamente.');
    }

    public function show($id)
    {
        $mascota = Mascota::with('fundacion', 'adopciones', 'rescates')->findOrFail($id);
        return view('mascotas.show', compact('mascota'));
    }

    public function edit($id)
    {
        $mascota = Mascota::findOrFail($id);
        $fundaciones = Fundacion::all();
        return view('mascotas.edit', compact('mascota', 'fundaciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_mascota' => 'required|string|max:255',
            'Raza' => 'required|string|max:255',
            'estado' => 'required|in:Adoptado,En adopcion,Rescatada',
            'Descripcion' => 'required|string'
        ]);

        $mascota = Mascota::findOrFail($id);
        $mascota->update($request->all());

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota eliminada exitosamente.');
    }

    public function porEstado($estado)
    {
        $mascotas = Mascota::where('estado', $estado)->get();
        return view('mascotas.por-estado', compact('mascotas', 'estado'));
    }
}