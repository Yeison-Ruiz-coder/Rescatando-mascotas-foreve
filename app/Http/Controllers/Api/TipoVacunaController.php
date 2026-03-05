<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoVacuna;
use Illuminate\Http\Request;

class TipoVacunaController extends Controller
{
    public function index()
    {
        $tiposVacunas = TipoVacuna::orderBy('nombre_vacuna')->get();

        return response()->json($tiposVacunas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_vacuna' => 'required|string|max:255',
            'frecuencia_dias' => 'nullable|integer'
        ]);

        $tipoVacuna = TipoVacuna::create($request->all());

        return response()->json($tipoVacuna, 201);
    }

    public function update(Request $request, $id)
    {
        $tipoVacuna = TipoVacuna::findOrFail($id);
        $tipoVacuna->update($request->all());

        return response()->json([
            "message" => "Actualizado correctamente"
        ]);
    }

    public function destroy($id)
    {
        $tipoVacuna = TipoVacuna::findOrFail($id);
        $tipoVacuna->delete();

        return response()->json([
            "message" => "Eliminado correctamente"
        ]);
    }
}
