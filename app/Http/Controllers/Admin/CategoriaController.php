<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'like', "%{$request->search}%");
        }

        $categorias = $query->withCount('productos')
            ->orderBy('nombre')
            ->paginate(20);

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:categorias',
            'descripcion' => 'nullable|string',
            'categoria_padre_id' => 'nullable|exists:categorias,id',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Categoria::create($request->all());

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function show(Categoria $categoria)
    {
        $categoria->load('productos', 'categoriasHijas', 'categoriaPadre');

        return view('admin.categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        $categorias = Categoria::where('id', '!=', $categoria->id)
            ->orderBy('nombre')
            ->get();

        return view('admin.categorias.edit', compact('categoria', 'categorias'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string',
            'categoria_padre_id' => 'nullable|exists:categorias,id',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Evitar que se asigne a sí misma como padre
        if ($request->categoria_padre_id == $categoria->id) {
            return redirect()->back()
                ->with('error', 'Una categoría no puede ser padre de sí misma.')
                ->withInput();
        }

        $categoria->update($request->all());

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria)
    {
        // Verificar si tiene productos
        if ($categoria->productos()->exists()) {
            return redirect()->route('admin.categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        // Verificar si tiene subcategorías
        if ($categoria->categoriasHijas()->exists()) {
            return redirect()->route('admin.categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene subcategorías asociadas.');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }

    public function toggleActivo(Categoria $categoria)
    {
        $categoria->update([
            'activo' => !$categoria->activo
        ]);

        return response()->json([
            'success' => true,
            'activo' => $categoria->activo
        ]);
    }

    public function arbol()
    {
        $categorias = Categoria::with('categoriasHijas')
            ->whereNull('categoria_padre_id')
            ->orderBy('nombre')
            ->get();

        return view('admin.categorias.arbol', compact('categorias'));
    }
}
