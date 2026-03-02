<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Lista de pedidos del usuario
     */
    public function index()
    {
        $pedidos = Pedido::where('comprador_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        return view('public.pedidos.index', compact('pedidos'));
    }

    /**
     * Página de checkout
     */
    public function checkout()
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('public.carrito.index')
                            ->with('error', 'Tu carrito está vacío');
        }

        // Calcular totales
        $subtotal = 0;
        $items = [];
        $vendedores = [];

        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
            $items[] = $item;
            $vendedores[$item['vendedor_id']] = $item['vendedor_nombre'];
        }

        // Si hay múltiples vendedores, mostrar advertencia
        $multiplesVendedores = count($vendedores) > 1;

        return view('public.pedidos.checkout', compact('carrito', 'subtotal', 'items', 'multiplesVendedores'));
    }

    /**
     * Procesar pedido
     */
    public function procesar(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'notas' => 'nullable|string',
        ]);

        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío');
        }

        DB::beginTransaction();

        try {
            // Agrupar items por vendedor
            $itemsPorVendedor = [];
            foreach ($carrito as $item) {
                $vendedorId = $item['vendedor_id'];
                if (!isset($itemsPorVendedor[$vendedorId])) {
                    $itemsPorVendedor[$vendedorId] = [];
                }
                $itemsPorVendedor[$vendedorId][] = $item;
            }

            $pedidosCreados = [];

            // Crear un pedido por cada vendedor
            foreach ($itemsPorVendedor as $vendedorId => $items) {
                $subtotal = 0;
                foreach ($items as $item) {
                    $subtotal += $item['precio'] * $item['cantidad'];
                }

                $pedido = Pedido::create([
                    'comprador_id' => auth()->id(),
                    'vendedor_id' => $vendedorId,
                    'items' => $items,
                    'subtotal' => $subtotal,
                    'total' => $subtotal, // Sin impuestos por ahora
                    'estado' => 'pendiente',
                    'direccion_envio' => $request->direccion_envio,
                    'telefono_contacto' => $request->telefono_contacto,
                    'notas' => $request->notas,
                ]);

                // Actualizar stock
                foreach ($items as $item) {
                    $producto = Producto::find($item['id']);
                    $producto->stock -= $item['cantidad'];

                    if ($producto->stock == 0) {
                        $producto->estado = 'agotado';
                    }

                    $producto->save();
                }

                $pedidosCreados[] = $pedido->id;
            }

            // Limpiar carrito
            Session::forget('carrito');

            DB::commit();

            if (count($pedidosCreados) === 1) {
                return redirect()->route('public.pedidos.show', $pedidosCreados[0])
                                ->with('success', 'Pedido realizado con éxito');
            } else {
                return redirect()->route('public.pedidos.index')
                                ->with('success', 'Tus pedidos han sido realizados con éxito');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar detalle de pedido
     */
    public function show($id)
    {
        $pedido = Pedido::with('vendedor')
                       ->where('comprador_id', auth()->id())
                       ->findOrFail($id);

        return view('public.pedidos.show', compact('pedido'));
    }

    /**
     * Cancelar pedido (solo si está pendiente)
     */
    public function cancelar(Request $request, $id)
    {
        $pedido = Pedido::where('comprador_id', auth()->id())
                       ->where('estado', 'pendiente')
                       ->findOrFail($id);

        DB::transaction(function () use ($pedido) {
            // Restaurar stock
            foreach ($pedido->items as $item) {
                $producto = Producto::find($item['id']);
                if ($producto) {
                    $producto->stock += $item['cantidad'];
                    $producto->estado = 'disponible';
                    $producto->save();
                }
            }

            $pedido->estado = 'cancelado';
            $pedido->save();
        });

        return redirect()->route('public.pedidos.index')
                        ->with('success', 'Pedido cancelado');
    }
}
