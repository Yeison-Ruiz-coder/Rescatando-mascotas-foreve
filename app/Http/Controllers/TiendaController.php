<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index()
    {
        $tiendas = Tienda::all();
        return view('admin.tiendas.index', compact('tiendas'));
    }

    public function create()
    {
        return view('admin.tiendas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_tienda' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:tiendas',
            'Telefono' => 'required|string|unique:tiendas',
            'Email' => 'required|email|unique:tiendas'
        ]);

        Tienda::create($request->all());

        return redirect()->route('admin.tiendas.index')
            ->with('success', 'Tienda creada exitosamente.');
    }

    public function show($id)
    {
        $tienda = Tienda::findOrFail($id);
        return view('admin.tiendas.show', compact('tienda'));
    }

    public function edit($id)
    {
        $tienda = Tienda::findOrFail($id);
        return view('admin.tiendas.edit', compact('tienda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_tienda' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:tiendas,direccion,' . $id,
            'Telefono' => 'required|string|unique:tiendas,telefono,' . $id,
            'Email' => 'required|email|unique:tiendas,email,' . $id
        ]);

        $tienda = Tienda::findOrFail($id);
        $tienda->update($request->all());

        return redirect()->route('admin.tiendas.index')
            ->with('success', 'Tienda actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $tienda = Tienda::findOrFail($id);
        $tienda->delete();

        return redirect()->route('admin.tiendas.index')
            ->with('success', 'Tienda eliminada exitosamente.');
    }

    public function ventas($id = null)
    {
        if ($id) {
            $tienda = Tienda::with('ventas')->findOrFail($id);
            return view('admin.tiendas.ventas', compact('tienda'));
        }
        // si no se especifica tienda, podríamos mostrar una página genérica
        // por ahora simplemente mostramos la vista sin variable para que el menú funcione
        return view('admin.tiendas.ventas');
    }

    public function inventario($id = null)
    {
        if ($id) {
            $tienda = Tienda::with('inventario')->findOrFail($id);
            return view('admin.tiendas.inventario', compact('tienda'));
        }
        return view('admin.tiendas.inventario');
    }
}
