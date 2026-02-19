<?php

namespace App\Http\Controllers;

use App\Models\Rescate;
use App\Models\Usuario;
use App\Models\Mascota;
use App\Models\Veterinaria;
use App\Models\Tienda;
use App\Models\Fundacion;
use App\Models\Administrador;
use Illuminate\Http\Request;

class RescateController extends Controller
{
    public function index()
    {
        $rescates = Rescate::with([
            'usuario',
            'mascota',
            'veterinaria',
            'tienda',
            'fundacion',
            'administrador'
        ])->get();

        return view('admin.rescates.index', compact('rescates'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $mascotas = Mascota::all();
        $veterinarias = Veterinaria::all();
        $tiendas = Tienda::all();
        $fundaciones = Fundacion::all();
        $administradores = Administrador::all();

        return view('rescates.create', compact(
            'usuarios',
            'mascotas',
            'veterinarias',
            'tiendas',
            'fundaciones',
            'administradores'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Fecha_rescate' => 'required|date',
            'Lugar_rescate' => 'required|string|max:255',
            'Descripcion_rescate' => 'required|string',
            'usuario_id' => 'nullable|exists:usuarios,id',
            'mascota_id' => 'nullable|exists:mascotas,id',
            'veterinaria_id' => 'nullable|exists:veterinarias,id',
            'tienda_id' => 'nullable|exists:tiendas,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
            'administrador_id' => 'nullable|exists:administradores,id'
        ]);

        Rescate::create($request->all());

        return redirect()->route('rescates.index')
            ->with('success', 'Rescate creado exitosamente.');
    }

    public function show($id)
    {
        $rescate = Rescate::with([
            'usuario',
            'mascota',
            'veterinaria',
            'tienda',
            'fundacion',
            'administrador'
        ])->findOrFail($id);

        return view('rescates.show', compact('rescate'));
    }

    public function edit($id)
    {
        $rescate = Rescate::findOrFail($id);
        $usuarios = Usuario::all();
        $mascotas = Mascota::all();
        $veterinarias = Veterinaria::all();
        $tiendas = Tienda::all();
        $fundaciones = Fundacion::all();
        $administradores = Administrador::all();

        return view('rescates.edit', compact(
            'rescate',
            'usuarios',
            'mascotas',
            'veterinarias',
            'tiendas',
            'fundaciones',
            'administradores'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Fecha_rescate' => 'required|date',
            'Lugar_rescate' => 'required|string|max:255',
            'Descripcion_rescate' => 'required|string',
            'usuario_id' => 'nullable|exists:usuarios,id',
            'mascota_id' => 'nullable|exists:mascotas,id',
            'veterinaria_id' => 'nullable|exists:veterinarias,id',
            'tienda_id' => 'nullable|exists:tiendas,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id',
            'administrador_id' => 'nullable|exists:administradores,id'
        ]);

        $rescate = Rescate::findOrFail($id);
        $rescate->update($request->all());

        return redirect()->route('rescates.index')
            ->with('success', 'Rescate actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $rescate = Rescate::findOrFail($id);
        $rescate->delete();

        return redirect()->route('rescates.index')
            ->with('success', 'Rescate eliminado exitosamente.');
    }
}
