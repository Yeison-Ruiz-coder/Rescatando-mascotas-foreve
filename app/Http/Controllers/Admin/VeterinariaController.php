<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Veterinaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VeterinariaController extends Controller
{
    public function index(Request $request)
    {
        $query = Veterinaria::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Nombre_vet', 'like', "%{$search}%")
                  ->orWhere('Email', 'like', "%{$search}%")
                  ->orWhere('Telefono', 'like', "%{$search}%")
                  ->orWhere('Direccion', 'like', "%{$search}%");
            });
        }

        if ($request->has('urgencias_24h') && $request->urgencias_24h != '') {
            $query->where('urgencias_24h', $request->urgencias_24h);
        }

        $veterinarias = $query->orderBy('Nombre_vet')->paginate(15);

        return view('admin.veterinarias.index', compact('veterinarias'));
    }

    public function create()
    {
        $serviciosDisponibles = [
            'consulta_general' => 'Consulta General',
            'vacunacion' => 'Vacunación',
            'cirugia' => 'Cirugía',
            'urgencias' => 'Urgencias',
            'hospitalizacion' => 'Hospitalización',
            'laboratorio' => 'Laboratorio',
            'imagenes' => 'Imágenes (Rayos X, Ecografía)',
            'odontologia' => 'Odontología',
            'peluqueria' => 'Peluquería/Estética',
            'farmacia' => 'Farmacia',
            'nutricion' => 'Nutrición',
        ];

        return view('admin.veterinarias.create', compact('serviciosDisponibles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_vet' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:veterinarias',
            'Telefono' => 'required|string|unique:veterinarias',
            'Email' => 'required|email|unique:veterinarias',
            'servicios' => 'nullable|array',
            'urgencias_24h' => 'boolean',
            'convenios' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Convertir arrays a JSON
        if (isset($data['servicios'])) {
            $data['servicios'] = json_encode($data['servicios']);
        }

        if (isset($data['convenios'])) {
            $data['convenios'] = json_encode($data['convenios']);
        }

        Veterinaria::create($data);

        return redirect()->route('admin.veterinarias.index')
            ->with('success', 'Veterinaria creada exitosamente.');
    }

    public function show(Veterinaria $veterinaria)
    {
        // Cargar relaciones
        $veterinaria->load(['rescates', 'historialMedico']);

        // Decodificar JSON
        $servicios = json_decode($veterinaria->servicios, true) ?? [];
        $convenios = json_decode($veterinaria->convenios, true) ?? [];

        // Estadísticas
        $stats = [
            'rescates_atendidos' => $veterinaria->rescates()->count(),
            'consultas_realizadas' => $veterinaria->historialMedico()->count(),
        ];

        return view('admin.veterinarias.show', compact('veterinaria', 'servicios', 'convenios', 'stats'));
    }

    public function edit(Veterinaria $veterinaria)
    {
        $serviciosDisponibles = [
            'consulta_general' => 'Consulta General',
            'vacunacion' => 'Vacunación',
            'cirugia' => 'Cirugía',
            'urgencias' => 'Urgencias',
            'hospitalizacion' => 'Hospitalización',
            'laboratorio' => 'Laboratorio',
            'imagenes' => 'Imágenes (Rayos X, Ecografía)',
            'odontologia' => 'Odontología',
            'peluqueria' => 'Peluquería/Estética',
            'farmacia' => 'Farmacia',
            'nutricion' => 'Nutrición',
        ];

        $serviciosSeleccionados = json_decode($veterinaria->servicios, true) ?? [];
        $convenios = json_decode($veterinaria->convenios, true) ?? [];

        return view('admin.veterinarias.edit', compact('veterinaria', 'serviciosDisponibles', 'serviciosSeleccionados', 'convenios'));
    }

    public function update(Request $request, Veterinaria $veterinaria)
    {
        $validator = Validator::make($request->all(), [
            'Nombre_vet' => 'required|string|max:255',
            'Direccion' => 'required|string|unique:veterinarias,Direccion,' . $veterinaria->id,
            'Telefono' => 'required|string|unique:veterinarias,Telefono,' . $veterinaria->id,
            'Email' => 'required|email|unique:veterinarias,Email,' . $veterinaria->id,
            'servicios' => 'nullable|array',
            'urgencias_24h' => 'boolean',
            'convenios' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        if (isset($data['servicios'])) {
            $data['servicios'] = json_encode($data['servicios']);
        }

        if (isset($data['convenios'])) {
            $data['convenios'] = json_encode($data['convenios']);
        }

        $veterinaria->update($data);

        return redirect()->route('admin.veterinarias.index')
            ->with('success', 'Veterinaria actualizada exitosamente.');
    }

    public function destroy(Veterinaria $veterinaria)
    {
        // Verificar relaciones
        if ($veterinaria->rescates()->exists() || $veterinaria->historialMedico()->exists()) {
            return redirect()->route('admin.veterinarias.index')
                ->with('error', 'No se puede eliminar la veterinaria porque tiene registros asociados.');
        }

        $veterinaria->delete();

        return redirect()->route('admin.veterinarias.index')
            ->with('success', 'Veterinaria eliminada exitosamente.');
    }
}
