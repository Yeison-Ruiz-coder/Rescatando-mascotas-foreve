<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fundacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Fundacion::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Nombre_1', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('Telefono', 'like', "%{$search}%")
                  ->orWhere('Direccion', 'like', "%{$search}%");
            });
        }

        if ($request->has('recibe_voluntarios') && $request->recibe_voluntarios != '') {
            $query->where('recibe_voluntarios', $request->recibe_voluntarios);
        }

        $fundaciones = $query->orderBy('Nombre_1')->paginate(15);

        return view('admin.fundaciones.index', compact('fundaciones'));
    }

    public function create()
    {
        $usuariosFundacion = User::where('tipo', 'fundacion')
            ->whereDoesntHave('fundacion')
            ->orderBy('nombre')
            ->get();

        return view('admin.fundaciones.create', compact('usuariosFundacion'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_1' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:fundaciones',
            'Telefono' => 'required|string|unique:fundaciones',
            'Email' => 'required|email|unique:fundaciones',
            'registro_sanitario' => 'nullable|string|max:255',
            'capacidad_maxima' => 'nullable|integer|min:1',
            'necesidades_actuales' => 'nullable|array',
            'horario_atencion' => 'nullable|string',
            'recibe_voluntarios' => 'boolean',
            'user_id' => 'nullable|exists:users,id', // Relación con usuario tipo fundacion
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Convertir necesidades a JSON
        if (isset($data['necesidades_actuales'])) {
            $data['necesidades_actuales'] = json_encode($data['necesidades_actuales']);
        }

        $fundacion = Fundacion::create($data);

        // Si se seleccionó un usuario, asociarlo
        if ($request->filled('user_id')) {
            $user = User::find($request->user_id);
            // Aquí podrías crear una relación si existe una tabla pivote
            // Por ahora, asumimos que el usuario ya es de tipo fundacion
        }

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación creada exitosamente.');
    }

    public function show(Fundacion $fundacion)
    {
        // Cargar relaciones
        $fundacion->load(['mascotas', 'rescates', 'donaciones', 'adopciones']);

        // Estadísticas
        $stats = [
            'mascotas_activas' => $fundacion->mascotas()->whereIn('estado', ['En adopcion', 'Rescatada', 'En acogida'])->count(),
            'adopciones_realizadas' => $fundacion->adopciones()->count(),
            'rescates_gestionados' => $fundacion->rescates()->count(),
            'total_donaciones' => $fundacion->donaciones()->sum('valor_donacion'),
        ];

        return view('admin.fundaciones.show', compact('fundacion', 'stats'));
    }

    public function edit(Fundacion $fundacion)
    {
        return view('admin.fundaciones.edit', compact('fundacion'));
    }

    public function update(Request $request, Fundacion $fundacion)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_1' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:fundaciones,Direccion,' . $fundacion->id,
            'Telefono' => 'required|string|unique:fundaciones,Telefono,' . $fundacion->id,
            'Email' => 'required|email|unique:fundaciones,Email,' . $fundacion->id,
            'registro_sanitario' => 'nullable|string|max:255',
            'capacidad_maxima' => 'nullable|integer|min:1',
            'necesidades_actuales' => 'nullable|array',
            'horario_atencion' => 'nullable|string',
            'recibe_voluntarios' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if (isset($data['necesidades_actuales'])) {
            $data['necesidades_actuales'] = json_encode($data['necesidades_actuales']);
        }

        $fundacion->update($data);

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación actualizada exitosamente.');
    }

    public function destroy(Fundacion $fundacion)
    {
        // Verificar relaciones
        if ($fundacion->mascotas()->exists() ||
            $fundacion->adopciones()->exists() ||
            $fundacion->rescates()->exists()) {
            return redirect()->route('admin.fundaciones.index')
                ->with('error', 'No se puede eliminar la fundación porque tiene registros asociados.');
        }

        $fundacion->delete();

        return redirect()->route('admin.fundaciones.index')
            ->with('success', 'Fundación eliminada exitosamente.');
    }

    public function necesidades(Fundacion $fundacion)
    {
        $necesidades = json_decode($fundacion->necesidades_actuales, true) ?? [];
        return response()->json($necesidades);
    }
}
