<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoVacuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoVacunaController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoVacuna::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nombre_vacuna', 'like', "%{$request->search}%");
        }

        $tiposVacunas = $query->orderBy('nombre_vacuna')->paginate(20);

        return view('admin.tipos-vacunas.index', compact('tiposVacunas'));
    }

    public function create()
    {
        return view('admin.tipos-vacunas.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_vacuna' => 'required|string|max:255|unique:tipos_vacunas',
            'frecuencia_dias' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        TipoVacuna::create($request->all());

        return redirect()->route('admin.tipos-vacunas.index')
            ->with('success', 'Tipo de vacuna creado exitosamente.');
    }

    public function show(TipoVacuna $tiposVacuna) // Nota: el nombre es tiposVacuna
    {
        $tiposVacuna->load('mascotas');

        $totalAplicaciones = $tiposVacuna->mascotas()->count();
        $mascotasConEstaVacuna = $tiposVacuna->mascotas()->distinct('mascota_id')->count('mascota_id');

        return view('admin.tipos-vacunas.show', compact('tiposVacuna', 'totalAplicaciones', 'mascotasConEstaVacuna'));
    }

    public function edit(TipoVacuna $tiposVacuna)
    {
        return view('admin.tipos-vacunas.edit', compact('tiposVacuna'));
    }

    public function update(Request $request, TipoVacuna $tiposVacuna)
    {
        $validator = Validator::make($request->all(), [
            'nombre_vacuna' => 'required|string|max:255|unique:tipos_vacunas,nombre_vacuna,' . $tiposVacuna->id,
            'frecuencia_dias' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tiposVacuna->update($request->all());

        return redirect()->route('admin.tipos-vacunas.index')
            ->with('success', 'Tipo de vacuna actualizado exitosamente.');
    }

    public function destroy(TipoVacuna $tiposVacuna)
    {
        // Verificar si tiene mascotas asociadas
        if ($tiposVacuna->mascotas()->exists()) {
            return redirect()->route('admin.tipos-vacunas.index')
                ->with('error', 'No se puede eliminar el tipo de vacuna porque tiene mascotas asociadas.');
        }

        $tiposVacuna->delete();

        return redirect()->route('admin.tipos-vacunas.index')
            ->with('success', 'Tipo de vacuna eliminado exitosamente.');
    }

    public function recomendadas()
    {
        $vacunasRecomendadas = [
            'Perro' => [
                ['nombre' => 'Múltiple (Canigen o similar)', 'frecuencia' => 'Anual'],
                ['nombre' => 'Rabia', 'frecuencia' => 'Anual'],
                ['nombre' => 'Tos de las perreras', 'frecuencia' => 'Anual'],
                ['nombre' => 'Leptospirosis', 'frecuencia' => 'Anual'],
            ],
            'Gato' => [
                ['nombre' => 'Trivalente (Feligen o similar)', 'frecuencia' => 'Anual'],
                ['nombre' => 'Rabia', 'frecuencia' => 'Anual'],
                ['nombre' => 'Leucemia felina', 'frecuencia' => 'Anual'],
            ],
        ];

        return view('admin.tipos-vacunas.recomendadas', compact('vacunasRecomendadas'));
    }
}
