<?php

namespace App\Http\Controllers;

use App\Models\Veterinaria;
use Illuminate\Http\Request;

class VeterinariaController extends Controller
{
    public function index()
    {
        $veterinarias = Veterinaria::all();
        return view('veterinarias.index', compact('veterinarias'));
    }

    public function create()
    {
        return view('veterinarias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_vet' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:veterinarias',
            'Telefono' => 'required|string|unique:veterinarias',
            'Email' => 'required|email|unique:veterinarias'
        ]);

        Veterinaria::create($request->all());

        return redirect()->route('veterinarias.index')
            ->with('success', 'Veterinaria creada exitosamente.');
    }

    public function show($id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        return view('veterinarias.show', compact('veterinaria'));
    }

    public function edit($id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        return view('veterinarias.edit', compact('veterinaria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_vet' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:veterinarias,direccion,' . $id,
            'Telefono' => 'required|string|unique:veterinarias,telefono,' . $id,
            'Email' => 'required|email|unique:veterinarias,email,' . $id
        ]);

        $veterinaria = Veterinaria::findOrFail($id);
        $veterinaria->update($request->all());

        return redirect()->route('veterinarias.index')
            ->with('success', 'Veterinaria actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $veterinaria = Veterinaria::findOrFail($id);
        $veterinaria->delete();

        return redirect()->route('veterinarias.index')
            ->with('success', 'Veterinaria eliminada exitosamente.');
    }
}