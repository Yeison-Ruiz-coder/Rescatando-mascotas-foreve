<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Redirige a productos (por compatibilidad)
     */
    public function index()
    {
        return redirect()->route('public.productos.index');
    }

    /**
     * Redirige a detalle de producto (por compatibilidad)
     */
    public function show($id)
    {
        return redirect()->route('public.productos.show', $id);
    }

    /**
     * Tienda por vendedor (fundación/veterinaria)
     */
    public function porVendedor($vendedorId)
    {
        $productos = Producto::where('user_id', $vendedorId)
                            ->where('estado', 'disponible')
                            ->where('stock', '>', 0)
                            ->paginate(12);

        $vendedor = \App\Models\User::find($vendedorId);

        return view('public.tienda.vendedor', compact('productos', 'vendedor'));
    }
}
