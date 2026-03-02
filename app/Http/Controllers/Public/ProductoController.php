<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Mostrar lista de productos públicos
     */
    public function index(Request $request)
    {
        $query = Producto::where('estado', 'disponible')
                        ->where('stock', '>', 0);

        // Filtro por categoría
        if ($request->has('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtro por búsqueda
        if ($request->has('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Ordenar
        switch ($request->get('orden', 'reciente')) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'nombre':
                $query->orderBy('nombre', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::where('activa', true)->get();

        return view('public.productos.index', compact('productos', 'categorias'));
    }

    /**
     * Mostrar detalle de un producto
     */
    public function show($id)
    {
        $producto = Producto::with('vendedor', 'categoria')
                           ->where('estado', 'disponible')
                           ->findOrFail($id);

        // Productos relacionados (misma categoría)
        $relacionados = Producto::where('categoria_id', $producto->categoria_id)
                                ->where('id', '!=', $producto->id)
                                ->where('estado', 'disponible')
                                ->limit(4)
                                ->get();

        return view('public.productos.show', compact('producto', 'relacionados'));
    }

    /**
     * Productos por categoría
     */
    public function porCategoria($categoriaId)
    {
        $categoria = Categoria::findOrFail($categoriaId);

        $productos = Producto::where('categoria_id', $categoriaId)
                            ->where('estado', 'disponible')
                            ->where('stock', '>', 0)
                            ->paginate(12);

        return view('public.productos.categoria', compact('productos', 'categoria'));
    }
}
