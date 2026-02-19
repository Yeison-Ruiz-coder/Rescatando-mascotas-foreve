<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();
        return view('admin.administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Apellido_1' => 'required|string|max:255',
            'Fecha_nacimiento' => 'required|date|unique:administradores',
            'Email' => 'required|email|unique:administradores',
            'Password_admin' => 'required|string|min:6',
            'Sueldo_admin' => 'required|numeric'
        ]);

        Administrador::create($request->all());

        return redirect()->route('administradores.index')
            ->with('success', 'Administrador creado exitosamente.');
    }

    public function show($id)
    {
        $administrador = Administrador::findOrFail($id);
        return view('admin.administradores.show', compact('administrador'));
    }

    public function edit($id)
    {
        $administrador = Administrador::findOrFail($id);
        return view('admin.administradores.edit', compact('administrador'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Apellido_1' => 'required|string|max:255',
            'Email' => 'required|email|unique:administradores,email,' . $id,
            'Sueldo_admin' => 'required|numeric'
        ]);

        $administrador = Administrador::findOrFail($id);
        $administrador->update($request->all());

        return redirect()->route('admin.administradores.index')
            ->with('success', 'Administrador actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->delete();

        return redirect()->route('admin.administradores.index')
            ->with('success', 'Administrador eliminado exitosamente.');
    }
}
