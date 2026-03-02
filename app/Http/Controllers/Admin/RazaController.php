<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RazaController extends Controller
{
    public function index(Request $request)
    {
        $query = Raza::query();

        if ($request->has('especie') && $request->especie != '') {
            $query->where('especie', $request->especie);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nombre_raza', 'like', "%{$search}%");
        }

        $razas = $query->orderBy('especie')->orderBy('nombre_raza')->paginate(20);

        // Estadísticas por especie
        $stats = [
            'total' => Raza::count(),
            'perros' => Raza::where('especie', 'Perro')->count(),
            'gatos' => Raza::where('especie', 'Gato')->count(),
            'otros' => Raza::whereNotIn('especie', ['Perro', 'Gato'])->orWhereNull('especie')->count(),
        ];

        return view('admin.razas.index', compact('razas', 'stats'));
    }

    public function create()
    {
        $especies = ['Perro', 'Gato', 'Conejo', 'Ave', 'Hamster', 'Reptil', 'Otro'];

        return view('admin.razas.create', compact('especies'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_raza' => 'required|string|max:255|unique:razas',
            'especie' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Raza::create($request->all());

        return redirect()->route('admin.razas.index')
            ->with('success', 'Raza creada exitosamente.');
    }

    public function show(Raza $raza)
    {
        // Contar mascotas de esta raza
        $totalMascotas = $raza->mascotas()->count();
        $mascotasAdoptadas = $raza->mascotas()->where('estado', 'Adoptado')->count();
        $mascotasDisponibles = $raza->mascotas()->where('estado', 'En adopcion')->count();

        return view('admin.razas.show', compact('raza', 'totalMascotas', 'mascotasAdoptadas', 'mascotasDisponibles'));
    }

    public function edit(Raza $raza)
    {
        $especies = ['Perro', 'Gato', 'Conejo', 'Ave', 'Hamster', 'Reptil', 'Otro'];

        return view('admin.razas.edit', compact('raza', 'especies'));
    }

    public function update(Request $request, Raza $raza)
    {
        $validator = Validator::make($request->all(), [
            'nombre_raza' => 'required|string|max:255|unique:razas,nombre_raza,' . $raza->id,
            'especie' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $raza->update($request->all());

        return redirect()->route('admin.razas.index')
            ->with('success', 'Raza actualizada exitosamente.');
    }

    public function destroy(Raza $raza)
    {
        // Verificar si tiene mascotas asociadas
        if ($raza->mascotas()->exists()) {
            return redirect()->route('admin.razas.index')
                ->with('error', 'No se puede eliminar la raza porque tiene mascotas asociadas.');
        }

        $raza->delete();

        return redirect()->route('admin.razas.index')
            ->with('success', 'Raza eliminada exitosamente.');
    }

    public function porEspecie($especie)
    {
        $razas = Raza::where('especie', $especie)
            ->orderBy('nombre_raza')
            ->get(['id', 'nombre_raza']);

        return response()->json($razas);
    }
}
