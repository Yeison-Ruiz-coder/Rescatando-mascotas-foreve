<?php

namespace App\Http\Controllers;

use App\Models\Fundacion;
use Illuminate\Http\Request;

class FundacionController extends Controller
{
    public function index()
    {
        $fundaciones = Fundacion::all();
        return view('admin.fundaciones.index', compact('fundaciones'));
    }

    public function create()
    {
        return view('admin.fundaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:fundaciones',
            'Telefono' => 'required|string|unique:fundaciones',
            'Email' => 'required|email|unique:fundaciones'
        ]);

        Fundacion::create($request->all());

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación creada exitosamente.');
    }

    public function show($id)
    {
        $fundacion = Fundacion::findOrFail($id);
        return view('admin.fundaciones.show', compact('fundacion'));
    }

    public function edit($id)
    {
        $fundacion = Fundacion::findOrFail($id);
        return view('admin.fundaciones.edit', compact('fundacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:fundaciones,direccion,' . $id,
            'Telefono' => 'required|string|unique:fundaciones,telefono,' . $id,
            'Email' => 'required|email|unique:fundaciones,email,' . $id
        ]);

        $fundacion = Fundacion::findOrFail($id);
        $fundacion->update($request->all());

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $fundacion = Fundacion::findOrFail($id);
        $fundacion->delete();

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación eliminada exitosamente.');
    }
}
