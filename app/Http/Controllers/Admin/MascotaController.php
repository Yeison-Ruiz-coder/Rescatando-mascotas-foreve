<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use App\Models\Raza;
use App\Models\Fundacion;
use App\Models\TipoVacuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    /**
     * Listado de mascotas (admin)
     */
    public function index(Request $request)
    {
        $query = Mascota::with('fundacion', 'razas');

        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }

        if ($request->filled('fundacion_id')) {
            $query->where('fundacion_id', $request->fundacion_id);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre_mascota', 'like', '%' . $request->buscar . '%');
        }

        $mascotas = $query->latest()->paginate(15);

        $fundaciones = Fundacion::all();
        $estados = ['En adopcion', 'Adoptado', 'Rescatada', 'En acogida'];
        $especies = Mascota::distinct('especie')->pluck('especie');

        return view('admin.mascotas.index', compact('mascotas', 'fundaciones', 'estados', 'especies'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $fundaciones = Fundacion::all();
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();

        return view('admin.mascotas.create', compact('fundaciones', 'razas', 'vacunas'));
    }

    /**
     * Guardar mascota
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_mascota' => 'required|string|max:255',
            'especie' => 'required|string',
            'edad_aprox' => 'nullable|integer|min:0|max:30',
            'genero' => 'required|in:Macho,Hembra,Desconocido',
            'estado' => 'required|in:En adopcion,Adoptado,Rescatada,En acogida',
            'descripcion' => 'nullable|string',
            'foto_principal' => 'nullable|image|max:2048',
            'galeria_fotos.*' => 'nullable|image|max:2048',
            'fundacion_id' => 'required|exists:fundaciones,id',
            'apto_con_ninos' => 'boolean',
            'apto_con_otros_animales' => 'boolean',
            'condiciones_especiales' => 'nullable|string',
            'razas' => 'array',
            'vacunas' => 'array',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except(['foto_principal', 'galeria_fotos', 'razas', 'vacunas']);

            // Foto principal
            if ($request->hasFile('foto_principal')) {
                $path = $request->file('foto_principal')->store('mascotas', 'public');
                $data['foto_principal'] = $path;
            }

            // Galería
            if ($request->hasFile('galeria_fotos')) {
                $galeria = [];
                foreach ($request->file('galeria_fotos') as $foto) {
                    $galeria[] = $foto->store('mascotas/galeria', 'public');
                }
                $data['galeria_fotos'] = json_encode($galeria);
            }

            $mascota = Mascota::create($data);

            // Sincronizar razas
            if ($request->has('razas')) {
                $mascota->razas()->sync($request->razas);
            }

            // Sincronizar vacunas
            if ($request->has('vacunas')) {
                $vacunasData = [];
                foreach ($request->vacunas as $vacunaId) {
                    $vacunasData[$vacunaId] = ['fecha_aplicacion' => now()];
                }
                $mascota->vacunas()->sync($vacunasData);
            }

            DB::commit();

            return redirect()->route('admin.mascotas.index')
                ->with('success', 'Mascota creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear mascota: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar mascota
     */
    public function show($id)
    {
        $mascota = Mascota::with(['fundacion', 'razas', 'vacunas', 'historialMedico', 'adopciones'])
            ->findOrFail($id);

        return view('admin.mascotas.show', compact('mascota'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $mascota = Mascota::with('razas', 'vacunas')->findOrFail($id);
        $fundaciones = Fundacion::all();
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();

        $razasSeleccionadas = $mascota->razas->pluck('id')->toArray();
        $vacunasSeleccionadas = $mascota->vacunas->pluck('id')->toArray();

        return view('admin.mascotas.edit', compact(
            'mascota',
            'fundaciones',
            'razas',
            'vacunas',
            'razasSeleccionadas',
            'vacunasSeleccionadas'
        ));
    }

    /**
     * Actualizar mascota
     */
    public function update(Request $request, $id)
    {
        $mascota = Mascota::findOrFail($id);

        $request->validate([
            'nombre_mascota' => 'required|string|max:255',
            'especie' => 'required|string',
            'edad_aprox' => 'nullable|integer|min:0|max:30',
            'genero' => 'required|in:Macho,Hembra,Desconocido',
            'estado' => 'required|in:En adopcion,Adoptado,Rescatada,En acogida',
            'descripcion' => 'nullable|string',
            'foto_principal' => 'nullable|image|max:2048',
            'galeria_fotos.*' => 'nullable|image|max:2048',
            'fundacion_id' => 'required|exists:fundaciones,id',
            'apto_con_ninos' => 'boolean',
            'apto_con_otros_animales' => 'boolean',
            'condiciones_especiales' => 'nullable|string',
            'razas' => 'array',
            'vacunas' => 'array',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except(['foto_principal', 'galeria_fotos', 'razas', 'vacunas']);

            // Procesar foto principal
            if ($request->hasFile('foto_principal')) {
                if ($mascota->foto_principal) {
                    Storage::disk('public')->delete($mascota->foto_principal);
                }
                $path = $request->file('foto_principal')->store('mascotas', 'public');
                $data['foto_principal'] = $path;
            }

            // 👇 CORREGIDO: Procesar galería de fotos
            if ($request->hasFile('galeria_fotos')) {
                // Obtener galería actual (ya es array por el casts)
                $galeria = $mascota->galeria_fotos ?? [];

                // Asegurar que sea array
                if (!is_array($galeria)) {
                    $galeria = [];
                }

                // Agregar nuevas fotos
                foreach ($request->file('galeria_fotos') as $foto) {
                    $galeria[] = $foto->store('mascotas/galeria', 'public');
                }

                // Asignar el array directamente (el casts lo convierte a JSON al guardar)
                $data['galeria_fotos'] = $galeria; // 👈 IMPORTANTE: asignar array, NO json_encode
            }

            $mascota->update($data);

            // Sincronizar razas
            if ($request->has('razas')) {
                $mascota->razas()->sync($request->razas);
            }

            // Sincronizar vacunas
            if ($request->has('vacunas')) {
                $vacunasData = [];
                foreach ($request->vacunas as $vacunaId) {
                    $vacunasData[$vacunaId] = ['fecha_aplicacion' => now()];
                }
                $mascota->vacunas()->sync($vacunasData);
            }

            DB::commit();

            return redirect()->route('admin.mascotas.index')
                ->with('success', 'Mascota actualizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Eliminar mascota
     */
    public function destroy(Mascota $mascota)
    {
        // Eliminar foto principal
        if ($mascota->foto_principal) {
            if (Storage::disk('public')->exists($mascota->foto_principal)) {
                Storage::disk('public')->delete($mascota->foto_principal);
            }
        }

        // Eliminar fotos de galería
        if ($mascota->galeria_fotos) {
            // Ya viene como array por el casts
            $galeria = $mascota->galeria_fotos;

            if (is_array($galeria)) {
                foreach ($galeria as $foto) {
                    if (!empty($foto) && Storage::disk('public')->exists($foto)) {
                        Storage::disk('public')->delete($foto);
                    }
                }
            }
        }

        $mascota->delete();

        return redirect()->route('admin.mascotas.index')
            ->with('success', 'Mascota eliminada exitosamente.');
    }
}
