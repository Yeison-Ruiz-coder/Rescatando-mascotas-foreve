<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    // Muestra una lista de todas las razas (Admin Index)
    public function index()
    {
        $razas = Raza::all();
        return view('razas.index', compact('razas'));
    }

    // Muestra el formulario para crear una nueva raza
    public function create()
    {
        return view('razas.create');
    }

    // Almacena una nueva raza en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_raza' => 'required|unique:razas,nombre_raza|max:255',
            'especie' => 'nullable|string|max:255',
        ]);

        Raza::create($request->all());

        return redirect()->route('razas.index')
                         ->with('success', 'Raza creada exitosamente.');
    }

    // Muestra el detalle de una raza específica (Opcional para datos maestros)
    public function show(Raza $raza)
    {
        return view('razas.show', compact('raza'));
    }

    // Muestra el formulario para editar una raza
    public function edit(Raza $raza)
    {
        return view('razas.edit', compact('raza'));
    }

    // Actualiza la raza en la base de datos
    public function update(Request $request, Raza $raza)
    {
        $request->validate([
            'nombre_raza' => 'required|unique:razas,nombre_raza,' . $raza->id . '|max:255',
            'especie' => 'nullable|string|max:255',
        ]);

        $raza->update($request->all());

        return redirect()->route('razas.index')
                         ->with('success', 'Raza actualizada exitosamente.');
    }

    // Elimina una raza
    public function destroy(Raza $raza)
    {
        $raza->delete();

        return redirect()->route('razas.index')
                         ->with('success', 'Raza eliminada correctamente.');
    }
}