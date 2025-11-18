<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Raza;
use App\Models\TipoVacuna;
use App\Models\Fundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    public function index(Request $request)
    {
        // Consulta base con relaciones
        $query = Mascota::with(['razas', 'tiposVacunas']);

        // Filtros
        if ($request->has('especie') && $request->especie != '') {
            $query->where('Especie', $request->especie);
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('raza') && $request->raza != '') {
            $query->where('Raza', 'like', '%' . $request->raza . '%');
        }

        // Paginación
        $mascotas = $query->paginate(12);

        // Datos para filtros
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];
        $estados = ['En adopcion', 'Rescatada', 'Adoptado'];
        $todasRazas = Raza::all();

        return view('mascotas.index', compact('mascotas', 'especies', 'estados', 'todasRazas'));
    }

    public function create()
    {
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];
        $fundaciones = Fundacion::all();

        return view('mascotas.create', compact('razas', 'vacunas', 'especies', 'fundaciones'));
    }

    public function store(Request $request)
    {
        // Validación - CAMBIAR 'Foto' por 'fotos[]'
        $validated = $request->validate([
            'Nombre_mascota' => 'required|string|max:255',
            'Especie' => 'required|string',
            'razas' => 'required|array',
            'razas.*' => 'exists:razas,id',
            'Edad_aprox' => 'required|numeric|min:0|max:30',
            'Genero' => 'required|in:Macho,Hembra',
            'estado' => 'required|in:Adoptado,En adopcion,Rescatada',
            'Lugar_rescate' => 'required|string|max:500',
            'Descripcion' => 'required|string|min:10|max:1000',
            'fotos' => 'required|array|min:1', // ← CAMBIADO
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // ← CAMBIADO
            'vacunas_aplicadas' => 'nullable|array',
            'vacunas_aplicadas.*' => 'exists:tipos_vacunas,id',
            'Fecha_ingreso' => 'required|date',
            'Fecha_salida' => 'nullable|date|after_or_equal:Fecha_ingreso',
            'fundacion_id' => 'nullable|exists:fundaciones,id'
        ]);

        try {
            // Procesar la galería de fotos
            $galeriaFotos = [];
            $fotoPrincipalPath = null;

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $index => $foto) {
                    $fotoPath = $foto->store('mascotas', 'public');

                    // La primera foto será la principal
                    if ($index === 0) {
                        $fotoPrincipalPath = $fotoPath;
                    }

                    $galeriaFotos[] = [
                        'ruta' => $fotoPath,
                        'titulo' => "Foto " . ($index + 1),
                        'orden' => $index,
                        'es_principal' => $index === 0
                    ];
                }
            }

            // Obtener nombres de razas seleccionadas
            $razasSeleccionadas = Raza::whereIn('id', $request->razas)
                ->pluck('nombre_raza')
                ->implode(', ');

            // Obtener nombres de vacunas seleccionadas
            $vacunasSeleccionadas = 'No especificado';
            if ($request->has('vacunas_aplicadas')) {
                $vacunasSeleccionadas = TipoVacuna::whereIn('id', $request->vacunas_aplicadas)
                    ->pluck('nombre_vacuna')
                    ->implode(', ');
            }

            // Crear la mascota
            $mascota = Mascota::create([
                'Nombre_mascota' => $request->Nombre_mascota,
                'Especie' => $request->Especie,
                'Raza' => $razasSeleccionadas,
                'Edad_aprox' => $request->Edad_aprox,
                'Genero' => $request->Genero,
                'estado' => $request->estado,
                'Lugar_rescate' => $request->Lugar_rescate,
                'Descripcion' => $request->Descripcion,
                'Foto' => $fotoPrincipalPath, // Primera foto como principal
                'galeria_fotos' => $galeriaFotos, // Array completo de fotos
                'vacunas' => $vacunasSeleccionadas,
                'Fecha_ingreso' => $request->Fecha_ingreso,
                'Fecha_salida' => $request->Fecha_salida,
                'fundacion_id' => $request->fundacion_id
            ]);

            // Sincronizar razas
            if ($request->has('razas')) {
                $mascota->razas()->sync($request->razas);
            }

            return redirect()->route('mascotas.create')
                ->with('success', '¡Mascota registrada exitosamente con ' . count($galeriaFotos) . ' fotos!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar la mascota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Mascota $mascota)
    {
        $mascota->load(['razas', 'tiposVacunas', 'fundacion']);
        return view('mascotas.show', compact('mascota'));
    }

    // MÉTODO EDIT QUE FALTABA
    public function edit(Mascota $mascota)
    {
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];
        $fundaciones = Fundacion::all();

        // Cargar relaciones para pre-seleccionar en el formulario
        $mascota->load(['razas', 'tiposVacunas']);

        return view('mascotas.edit', compact('mascota', 'razas', 'vacunas', 'especies', 'fundaciones'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        // Validación (similar a store pero con Foto opcional)
        $validated = $request->validate([
            'Nombre_mascota' => 'required|string|max:255',
            'Especie' => 'required|string',
            'razas' => 'required|array',
            'razas.*' => 'exists:razas,id',
            'Edad_aprox' => 'required|numeric|min:0|max:30',
            'Genero' => 'required|in:Macho,Hembra',
            'estado' => 'required|in:Adoptado,En adopcion,Rescatada',
            'Lugar_rescate' => 'required|string|max:500',
            'Descripcion' => 'required|string|min:10|max:1000',
            'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vacunas_aplicadas' => 'nullable|array',
            'vacunas_aplicadas.*' => 'exists:tipos_vacunas,id',
            'Fecha_ingreso' => 'required|date',
            'Fecha_salida' => 'nullable|date|after_or_equal:Fecha_ingreso',
            'fundacion_id' => 'nullable|exists:fundaciones,id'
        ]);

        try {
            // Procesar nueva imagen si se proporciona
            if ($request->hasFile('Foto')) {
                // Eliminar imagen anterior si existe
                if ($mascota->Foto && Storage::disk('public')->exists($mascota->Foto)) {
                    Storage::disk('public')->delete($mascota->Foto);
                }
                $fotoPath = $request->file('Foto')->store('mascotas', 'public');
                $validated['Foto'] = $fotoPath;
            }

            // Obtener nombres de razas seleccionadas
            $razasSeleccionadas = Raza::whereIn('id', $request->razas)
                ->pluck('nombre_raza')
                ->implode(', ');
            $validated['Raza'] = $razasSeleccionadas;

            // Obtener nombres de vacunas seleccionadas para el campo vacunas (texto)
            $vacunasSeleccionadas = 'No especificado';
            if ($request->has('vacunas_aplicadas')) {
                $vacunasSeleccionadas = TipoVacuna::whereIn('id', $request->vacunas_aplicadas)
                    ->pluck('nombre_vacuna')
                    ->implode(', ');
            }
            $validated['vacunas'] = $vacunasSeleccionadas;

            // Actualizar mascota
            $mascota->update($validated);

            // Sincronizar relaciones
            if ($request->has('razas')) {
                $mascota->razas()->sync($request->razas);
            }

            // NO sincronizar vacunas como relación many-to-many
            // porque ya las guardamos en el campo de texto 'vacunas'

            return redirect()->route('mascotas.show', $mascota)
                ->with('success', '¡Mascota actualizada exitosamente!');
        } catch (\Exception $e) {
            Log::error('Error al actualizar mascota: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar la mascota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Mascota $mascota)
    {
        try {
            // Eliminar imagen si existe
            if ($mascota->Foto && Storage::disk('public')->exists($mascota->Foto)) {
                Storage::disk('public')->delete($mascota->Foto);
            }

            // Eliminar relaciones many-to-many
            $mascota->razas()->detach();
            $mascota->tiposVacunas()->detach();

            // Eliminar mascota
            $mascota->delete();

            return redirect()->route('mascotas.index')
                ->with('success', 'Mascota eliminada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar mascota: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar la mascota: ' . $e->getMessage());
        }
    }

    public function porEstado($estado)
    {
        $mascotas = Mascota::where('estado', $estado)
            ->with(['razas', 'tiposVacunas'])
            ->paginate(12);

        return view('mascotas.por-estado', compact('mascotas', 'estado'));
    }




    // Metodos publicos para que los usaurios puedan navegar por mascotas

    public function publicIndex(Request $request)
    {
        // Solo mascotas en adopción
        $query = Mascota::where('estado', 'En adopcion')->with('fundacion');

        // Filtros simples
        if ($request->has('especie') && $request->especie != '') {
            $query->where('Especie', $request->especie);
        }

        if ($request->has('genero') && $request->genero != '') {
            $query->where('Genero', $request->genero);
        }

        $mascotas = $query->orderBy('created_at', 'desc')->paginate(12);
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];

        return view('mascotas.public-index', compact('mascotas', 'especies'));
    }

    public function publicShow($id)
    {
        $mascota = Mascota::where('estado', 'En adopcion')
            ->with('fundacion')
            ->findOrFail($id);

        return view('mascotas.public-show', compact('mascota'));
    }
}
