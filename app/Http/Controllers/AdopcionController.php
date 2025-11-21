<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Fundacion;
use App\Models\Mascota;
use Illuminate\Http\Request;
use App\Models\SolicitudAdopcion;


class AdopcionController extends Controller
{
    // En AdopcionController.php - método index() ACTUALIZADO
    public function index(Request $request)
    {
        $query = Adopcion::with(['usuario', 'mascota', 'administrador', 'fundacion']);

        // FILTRO POR ESTADO
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        // FILTRO POR MASCOTA
        if ($request->has('mascota_id') && $request->mascota_id != '') {
            $query->where('mascota_id', $request->mascota_id);
        }

        // FILTRO POR USUARIO
        if ($request->has('usuario_id') && $request->usuario_id != '') {
            $query->where('usuario_id', $request->usuario_id);
        }

        // FILTRO POR FECHA (desde)
        if ($request->has('fecha_desde') && $request->fecha_desde != '') {
            $query->where('Fecha_adopcion', '>=', $request->fecha_desde);
        }

        // FILTRO POR FECHA (hasta)
        if ($request->has('fecha_hasta') && $request->fecha_hasta != '') {
            $query->where('Fecha_adopcion', '<=', $request->fecha_hasta);
        }

        // BÚSQUEDA POR LUGAR
        if ($request->has('busqueda') && $request->busqueda != '') {
            $query->where('Lugar_adopcion', 'like', '%' . $request->busqueda . '%');
        }

        $adopciones = $query->orderBy('created_at', 'desc')->paginate(10);

        // Datos para los filtros
        $estados = ['Aprobado', 'En proceso', 'Rechazado'];
        $mascotas = Mascota::all();
        $usuarios = Usuario::where('tipo', 'Cliente')->get();

        return view('adopciones.index', compact('adopciones', 'estados', 'mascotas', 'usuarios'));
    }

    // En AdopcionController.php - método create() CORREGIDO
    public function create()
    {
        $usuarios = Usuario::where('tipo', 'Cliente')->get();
        $mascotas = Mascota::where('estado', 'En adopcion')->get();
        $administradores = Administrador::all();
        $fundaciones = Fundacion::all();

        return view('adopciones.create', compact('usuarios', 'mascotas', 'administradores', 'fundaciones')); // Agregar fundaciones aquí
    }

    // En AdopcionController.php - método store() ACTUALIZADO
    public function store(Request $request)
    {
        $request->validate([
            'Lugar_adopcion' => 'required|string|max:255',
            'Fecha_adopcion' => 'required|date',
            'estado' => 'required|in:Aprobado,En proceso,Rechazado',
            'usuario_id' => 'required|exists:usuarios,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'administrador_id' => 'nullable|exists:administradores,id',
            'fundacion_id' => 'nullable|exists:fundaciones,id', // AGREGAR ESTA LÍNEA
            'razon_rechazo' => 'nullable|string|max:500',
            'fecha_cierre' => 'nullable|date'
        ]);

        Adopcion::create($request->all());

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción creada exitosamente.');
    }

    // En AdopcionController.php - método show() ACTUALIZADO
    public function show($id)
    {
        $adopcion = Adopcion::with(['usuario', 'mascota', 'administrador', 'fundacion'])->findOrFail($id);
        return view('adopciones.show', compact('adopcion'));
    }

    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $usuarios = Usuario::where('tipo', 'Cliente')->get();
        $mascotas = Mascota::where('estado', 'En adopcion')->get();
        $administradores = Administrador::all();
        $fundaciones = Fundacion::all(); // Agregar fundaciones

        return view('adopciones.edit', compact('adopcion', 'usuarios', 'mascotas', 'administradores', 'fundaciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Lugar_adopcion' => 'required|string|max:255',
            'Fecha_adopcion' => 'required|date',
            'estado' => 'required|in:Aprobado,En proceso,Rechazado',
            'usuario_id' => 'required|exists:usuarios,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'administrador_id' => 'nullable|exists:administradores,id',
            'razon_rechazo' => 'nullable|string|max:500',
            'fecha_cierre' => 'nullable|date'
        ]);

        $adopcion = Adopcion::findOrFail($id);
        $adopcion->update($request->all());

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $adopcion->delete();

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción eliminada exitosamente.');
    }


    // Funciones publicas

    public function solicitar($id)
{
    
    $mascota = Mascota::where('estado', 'En adopcion')->findOrFail($id);
    
    // Verificar que la mascota se está encontrando
    if (!$mascota) {
        abort(404, 'Mascota no encontrada');
    }
    
    return view('adopciones.solicitar', compact('mascota'));
}


    public function solicitarStore(Request $request) // ← QUITAR el ", $id"
    {
        // Validar los datos
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'experiencia_mascotas' => 'required|string|max:255',
            'tipo_vivienda' => 'required|string|max:255',
            'motivo_adopcion' => 'required|string|max:1000',
            'compromiso_cuidado' => 'required',
            'compromiso_esterilizacion' => 'required',
            'compromiso_seguimiento' => 'required',
        ]);

        // Verificar que la mascota esté disponible
        $mascota = Mascota::where('estado', 'En adopcion')->findOrFail($request->mascota_id);

        // Crear la solicitud
        SolicitudAdopcion::create([
            'mascota_id' => $request->mascota_id,
            'nombre_solicitante' => $request->nombre,
            'apellido_solicitante' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'experiencia_mascotas' => $request->experiencia_mascotas,
            'tipo_vivienda' => $request->tipo_vivienda,
            'motivo_adopcion' => $request->motivo_adopcion,
            'compromiso_cuidado' => $request->has('compromiso_cuidado'),
            'compromiso_esterilizacion' => $request->has('compromiso_esterilizacion'),
            'compromiso_seguimiento' => $request->has('compromiso_seguimiento'),
            'estado' => 'Pendiente',
            'administrador_id' => null,
        ]);

        return redirect()->route('public.mascotas.index')
            ->with('success', '¡Solicitud de adopción enviada exitosamente! Te contactaremos en 2-3 días.');
    }
}
