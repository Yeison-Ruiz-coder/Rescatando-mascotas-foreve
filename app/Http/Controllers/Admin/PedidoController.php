<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::with(['comprador', 'vendedor']);

        // Filtros
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        if ($request->has('comprador_id') && $request->comprador_id != '') {
            $query->where('comprador_id', $request->comprador_id);
        }

        if ($request->has('vendedor_id') && $request->vendedor_id != '') {
            $query->where('vendedor_id', $request->vendedor_id);
        }

        if ($request->has('fecha_inicio') && $request->fecha_inicio != '') {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        if ($request->has('fecha_fin') && $request->fecha_fin != '') {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('direccion_envio', 'like', "%{$search}%")
                  ->orWhere('telefono_contacto', 'like', "%{$search}%");
            });
        }

        $pedidos = $query->orderBy('created_at', 'desc')->paginate(15);

        // Estadísticas
        $stats = [
            'total' => Pedido::count(),
            'pendientes' => Pedido::where('estado', 'pendiente')->count(),
            'pagados' => Pedido::where('estado', 'pagado')->count(),
            'enviados' => Pedido::where('estado', 'enviado')->count(),
            'entregados' => Pedido::where('estado', 'entregado')->count(),
            'cancelados' => Pedido::where('estado', 'cancelado')->count(),
            'ingresos_totales' => Pedido::whereIn('estado', ['pagado', 'enviado', 'entregado'])->sum('total'),
        ];

        // Datos para filtros
        $compradores = User::whereHas('pedidosComprados')->orderBy('nombre')->get();
        $vendedores = User::whereHas('pedidosVendidos')->orderBy('nombre')->get();

        return view('admin.pedidos.index', compact('pedidos', 'stats', 'compradores', 'vendedores'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load(['comprador', 'vendedor']);

        // Decodificar items
        $items = json_decode($pedido->items, true);

        return view('admin.pedidos.show', compact('pedido', 'items'));
    }

    public function edit(Pedido $pedido)
    {
        $pedido->load(['comprador', 'vendedor']);
        $items = json_decode($pedido->items, true);

        $estados = ['pendiente', 'pagado', 'enviado', 'entregado', 'cancelado'];

        return view('admin.pedidos.edit', compact('pedido', 'items', 'estados'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $validator = Validator::make($request->all(), [
            'estado' => 'required|in:pendiente,pagado,enviado,entregado,cancelado',
            'direccion_envio' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'notas' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pedido->update($request->all());

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido actualizado exitosamente.');
    }

    public function destroy(Pedido $pedido)
    {
        // Solo permitir eliminar pedidos pendientes o cancelados
        if (!in_array($pedido->estado, ['pendiente', 'cancelado'])) {
            return redirect()->route('admin.pedidos.index')
                ->with('error', 'Solo se pueden eliminar pedidos pendientes o cancelados.');
        }

        $pedido->delete();

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido eliminado exitosamente.');
    }

    public function cambiarEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,pagado,enviado,entregado,cancelado'
        ]);

        $pedido->update(['estado' => $request->estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente'
        ]);
    }

    public function reporte(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'vendedor_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $query = Pedido::whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin])
            ->whereIn('estado', ['pagado', 'enviado', 'entregado']);

        if ($request->filled('vendedor_id')) {
            $query->where('vendedor_id', $request->vendedor_id);
        }

        $pedidos = $query->with(['comprador', 'vendedor'])->get();

        $totalVentas = $pedidos->sum('total');
        $promedioVenta = $pedidos->avg('total');
        $cantidadPedidos = $pedidos->count();

        // Agrupar por vendedor
        $porVendedor = $pedidos->groupBy(function($item) {
            return $item->vendedor->nombre ?? 'Sin Vendedor';
        })->map(function($grupo) {
            return [
                'cantidad' => $grupo->count(),
                'total' => $grupo->sum('total')
            ];
        });

        // Agrupar por día
        $porDia = $pedidos->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        })->map(function($grupo) {
            return [
                'cantidad' => $grupo->count(),
                'total' => $grupo->sum('total')
            ];
        });

        // 👇 CORREGIDO: Usar compact para pasar todas las variables
        return view('admin.pedidos.reporte', compact(
            'pedidos',
            'totalVentas',
            'promedioVenta',
            'cantidadPedidos',
            'porVendedor',
            'porDia'
        )) // Cierra el compact aquí
        ->with('fecha_inicio', $request->fecha_inicio) // 👈 Pasar fechas por separado
        ->with('fecha_fin', $request->fecha_fin);
    }
}
