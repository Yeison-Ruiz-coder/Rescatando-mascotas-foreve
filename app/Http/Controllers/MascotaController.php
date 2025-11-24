<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Raza;
use App\Models\TipoVacuna;
use App\Models\Fundacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Agregar este use

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

        return view('admin.mascotas.index', compact('mascotas', 'especies', 'estados', 'todasRazas'));
    }

    public function create()
    {
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];
        $fundaciones = Fundacion::all();

        return view('admin.mascotas.create', compact('razas', 'vacunas', 'especies', 'fundaciones'));
    }

    public function store(Request $request)
    {
        // Validación corregida - QUITAR mimes específicos
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
            'fotos' => 'required|array|min:1|max:3', // ← CORREGIDO: agregar max:3
            'fotos.*' => 'image|max:2048', // ← CORREGIDO: quitar mimes específicos
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

            return redirect()->route('admin.mascotas.index')
                ->with('success', 'Se guardaron ' . count($galeriaFotos) . ' fotos en la galería.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar la mascota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Mascota $mascota)
    {
        $mascota->load(['razas', 'tiposVacunas', 'fundacion']);

        return view('admin.mascotas.show', compact('mascota'));
    }

    public function edit(Mascota $mascota)
    {
        $razas = Raza::all();
        $vacunas = TipoVacuna::all();
        $especies = ['Perro', 'Gato', 'Conejo', 'Otro'];
        $fundaciones = Fundacion::all();

        // Cargar relaciones para pre-seleccionar en el formulario
        $mascota->load(['razas', 'tiposVacunas']);

        return view('admin.mascotas.edit', compact('mascota', 'razas', 'vacunas', 'especies', 'fundaciones'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        // Validación manual para evitar problemas con arrays de archivos
        $validator = Validator::make($request->all(), [
            'Nombre_mascota' => 'required|string|max:255',
            'Especie' => 'required|string',
            'razas' => 'required|array',
            'razas.*' => 'exists:razas,id',
            'Edad_aprox' => 'required|numeric|min:0|max:30',
            'Genero' => 'required|in:Macho,Hembra',
            'estado' => 'required|in:Adoptado,En adopcion,Rescatada',
            'Lugar_rescate' => 'required|string|max:500',
            'Descripcion' => 'required|string|min:10|max:1000',
            'vacunas_aplicadas' => 'nullable|array',
            'vacunas_aplicadas.*' => 'exists:tipos_vacunas,id',
            'Fecha_ingreso' => 'required|date',
            'Fecha_salida' => 'nullable|date|after_or_equal:Fecha_ingreso',
            'fundacion_id' => 'nullable|exists:fundaciones,id'
        ]);

        // Validar archivos manualmente
        if ($request->hasFile('galeria_fotos')) {
            $archivos = $request->file('galeria_fotos');
            
            if (count($archivos) > 3) {
                $validator->errors()->add('galeria_fotos', 'Máximo 3 imágenes permitidas');
            }
            
            foreach ($archivos as $index => $foto) {
                if (!$foto->isValid()) {
                    $validator->errors()->add('galeria_fotos', 'El archivo ' . ($index + 1) . ' no es válido');
                }
                
                if (!str_starts_with($foto->getMimeType(), 'image/')) {
                    $validator->errors()->add('galeria_fotos', 'Solo se permiten archivos de imagen');
                }
                
                if ($foto->getSize() > 2048 * 1024) {
                    $validator->errors()->add('galeria_fotos', 'Las imágenes no deben exceder 2MB');
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // **PROCESAR NUEVAS FOTOS**
            if ($request->hasFile('galeria_fotos')) {
                $archivos = $request->file('galeria_fotos');

                // **ELIMINAR FOTOS ANTERIORES SI EXISTEN**
                if ($mascota->galeria_fotos && is_array($mascota->galeria_fotos)) {
                    foreach ($mascota->galeria_fotos as $fotoExistente) {
                        if (isset($fotoExistente['ruta']) && Storage::disk('public')->exists($fotoExistente['ruta'])) {
                            Storage::disk('public')->delete($fotoExistente['ruta']);
                        }
                    }
                }

                $galeriaFotos = [];

                foreach ($archivos as $index => $foto) {
                    $fotoPath = $foto->store('mascotas', 'public');

                    $galeriaFotos[] = [
                        'ruta' => $fotoPath,
                        'titulo' => "Foto " . ($index + 1),
                        'orden' => $index,
                        'es_principal' => $index === 0
                    ];
                }

                // **ACTUALIZAR LA GALERÍA**
                $mascota->galeria_fotos = $galeriaFotos;

                // **ACTUALIZAR FOTO PRINCIPAL (primera de la galería)**
                if (count($galeriaFotos) > 0) {
                    $mascota->Foto = $galeriaFotos[0]['ruta'];
                }
            }

            // Actualizar otros campos
            $mascota->Nombre_mascota = $request->Nombre_mascota;
            $mascota->Especie = $request->Especie;
            $mascota->Edad_aprox = $request->Edad_aprox;
            $mascota->Genero = $request->Genero;
            $mascota->estado = $request->estado;
            $mascota->Lugar_rescate = $request->Lugar_rescate;
            $mascota->Descripcion = $request->Descripcion;
            $mascota->Fecha_ingreso = $request->Fecha_ingreso;
            $mascota->Fecha_salida = $request->Fecha_salida;
            $mascota->fundacion_id = $request->fundacion_id;

            // Actualizar razas
            $razasSeleccionadas = Raza::whereIn('id', $request->razas)
                ->pluck('nombre_raza')
                ->implode(', ');
            $mascota->Raza = $razasSeleccionadas;

            // Actualizar vacunas
            $vacunasSeleccionadas = 'No especificado';
            if ($request->has('vacunas_aplicadas')) {
                $vacunasSeleccionadas = TipoVacuna::whereIn('id', $request->vacunas_aplicadas)
                    ->pluck('nombre_vacuna')
                    ->implode(', ');
            }
            $mascota->vacunas = $vacunasSeleccionadas;

            // Sincronizar relaciones
            $mascota->razas()->sync($request->razas);

            $mascota->save();

            return redirect()->route('admin.mascotas.show', $mascota)
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

            return redirect()->route('admin.mascotas.index')
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

        return view('public.mascotas.index', compact('mascotas', 'estado'));
    }

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

        return view('public.mascotas.index', compact('mascotas', 'especies'));
    }

    public function publicShow($id)
    {
        $mascota = Mascota::where('estado', 'En adopcion')
            ->with('fundacion')
            ->findOrFail($id);

        return view('public.mascotas.show', compact('mascota'));
    }
}