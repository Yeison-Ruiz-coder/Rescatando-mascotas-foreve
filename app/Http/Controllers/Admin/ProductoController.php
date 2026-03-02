<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('vendedor');

        // Filtros
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('stock_minimo') && $request->stock_minimo) {
            $query->where('stock', '<=', 5);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        $productos = $query->orderBy('created_at', 'desc')->paginate(15);

        // Estadísticas
        $stats = [
            'total' => Producto::count(),
            'disponibles' => Producto::where('estado', 'disponible')->count(),
            'agotados' => Producto::where('estado', 'agotado')->count(),
            'ocultos' => Producto::where('estado', 'oculto')->count(),
            'stock_total' => Producto::sum('stock'),
            'valor_inventario' => Producto::selectRaw('sum(stock * precio) as total')->value('total') ?? 0,
        ];

        // Vendedores para filtro
        $vendedores = User::whereIn('tipo', ['fundacion', 'veterinaria'])
            ->whereHas('productos')
            ->orderBy('nombre')
            ->get();

        return view('admin.productos.index', compact('productos', 'stats', 'vendedores'));
    }

    public function create()
    {
        $vendedores = User::whereIn('tipo', ['fundacion', 'veterinaria'])
            ->where('estado', 'activo')
            ->orderBy('nombre')
            ->get();

        return view('admin.productos.create', compact('vendedores'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'estado' => 'required|in:disponible,agotado,oculto',
            'imagen_url' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('imagen_url');

        // Subir imagen
        if ($request->hasFile('imagen_url')) {
            $path = $request->file('imagen_url')->store('productos', 'public');
            $data['imagen_url'] = $path;
        }

        Producto::create($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        $producto->load('vendedor');

        return view('admin.productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $vendedores = User::whereIn('tipo', ['fundacion', 'veterinaria'])
            ->where('estado', 'activo')
            ->orderBy('nombre')
            ->get();

        return view('admin.productos.edit', compact('producto', 'vendedores'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'estado' => 'required|in:disponible,agotado,oculto',
            'imagen_url' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('imagen_url');

        // Subir nueva imagen
        if ($request->hasFile('imagen_url')) {
            // Eliminar imagen anterior
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }
            $path = $request->file('imagen_url')->store('productos', 'public');
            $data['imagen_url'] = $path;
        }

        $producto->update($data);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        // Verificar si tiene pedidos asociados
        if ($producto->pedidos()->exists()) {
            return redirect()->route('admin.productos.index')
                ->with('error', 'No se puede eliminar el producto porque tiene pedidos asociados.');
        }

        // Eliminar imagen
        if ($producto->imagen_url) {
            Storage::disk('public')->delete($producto->imagen_url);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    public function cambiarEstado(Request $request, Producto $producto)
    {
        $request->validate([
            'estado' => 'required|in:disponible,agotado,oculto'
        ]);

        $producto->update(['estado' => $request->estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente'
        ]);
    }

    public function actualizarStock(Request $request, Producto $producto)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $producto->update(['stock' => $request->stock]);

        // Actualizar estado automáticamente si stock es 0
        if ($request->stock == 0 && $producto->estado == 'disponible') {
            $producto->update(['estado' => 'agotado']);
        } elseif ($request->stock > 0 && $producto->estado == 'agotado') {
            $producto->update(['estado' => 'disponible']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Stock actualizado correctamente',
            'nuevo_estado' => $producto->fresh()->estado
        ]);
    }

    public function stockBajo()
    {
        $productos = Producto::with('vendedor')
            ->where('stock', '<=', 5)
            ->where('estado', '!=', 'oculto')
            ->orderBy('stock')
            ->get();

        return view('admin.productos.stock-bajo', compact('productos'));
    }
}
