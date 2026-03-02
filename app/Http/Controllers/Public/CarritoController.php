<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    /**
     * Mostrar carrito
     */
    public function index()
    {
        $carrito = Session::get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('public.carrito.index', compact('carrito', 'total'));
    }

    /**
     * Agregar producto al carrito
     */
    public function agregar(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:' . $producto->stock
        ]);

        // Verificar disponibilidad
        if ($producto->estado !== 'disponible' || $producto->stock < $request->cantidad) {
            return back()->with('error', 'Producto no disponible en la cantidad solicitada');
        }

        $carrito = Session::get('carrito', []);

        // Si ya existe, actualizar cantidad
        if (isset($carrito[$producto->id])) {
            $nuevaCantidad = $carrito[$producto->id]['cantidad'] + $request->cantidad;

            if ($nuevaCantidad > $producto->stock) {
                return back()->with('error', 'No hay suficiente stock disponible');
            }

            $carrito[$producto->id]['cantidad'] = $nuevaCantidad;
            $mensaje = 'Cantidad actualizada en el carrito';
        } else {
            // Nuevo item
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad,
                'imagen' => $producto->imagen_url,
                'vendedor_id' => $producto->user_id,
                'vendedor_nombre' => $producto->vendedor->nombre
            ];
            $mensaje = 'Producto agregado al carrito';
        }

        Session::put('carrito', $carrito);

        return redirect()->route('public.carrito.index')
                        ->with('success', $mensaje);
    }

    /**
     * Actualizar cantidad de un item
     */
    public function actualizar(Request $request, $productoId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $carrito = Session::get('carrito', []);

        if (isset($carrito[$productoId])) {
            $producto = Producto::find($productoId);

            if ($producto && $producto->stock < $request->cantidad) {
                return back()->with('error', 'Stock insuficiente. Disponible: ' . $producto->stock);
            }

            $carrito[$productoId]['cantidad'] = $request->cantidad;
            Session::put('carrito', $carrito);
        }

        return redirect()->route('public.carrito.index')
                        ->with('success', 'Carrito actualizado');
    }

    /**
     * Eliminar item del carrito
     */
    public function eliminar($productoId)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$productoId])) {
            unset($carrito[$productoId]);
            Session::put('carrito', $carrito);
        }

        return redirect()->route('public.carrito.index')
                        ->with('success', 'Producto eliminado del carrito');
    }
}
