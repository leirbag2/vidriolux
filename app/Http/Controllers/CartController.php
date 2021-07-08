<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Cart;
use App\Models\Ventas;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ventas.index')->only('index');
    }

    public function index(Request $request)
    {
        if (!$request->session()->get('cart')) {
            return view('ventas.cart', ['cart' => null]);
        }

        return view('ventas.cart', [
            'productos' => $request->session()->get('cart')->items,
            'cart' => $request->session()->get('cart')
        ]);
    }

    public function add(Request $request)
    {
        $cantidad = $request->input('cantidad');
        if ($request->input('cantidad') <= 0) {
            return redirect()->back()->with('error', 'La cantidad debe ser mayor a 0');
        }
        $id = $request->get('id');
        $producto = Productos::find($id);
        $producto->precioIva = $request->input('venta');
        $oldCart =  $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        if ($cart->disponible($producto, $producto->id, $cantidad)) {
            $cart->add($producto, $producto->id, $cantidad);
            $request->session()->put('cart', $cart);
            return redirect('ventas/create')->with('info', 'Agregado correctamente al carrito');
        }
        return redirect()->back()->with('error', 'No hay suficiente stock');
    }

    public function store(Request $request)
    {
        $numFactura = $request->input('num_factura');
        if (Ventas::where('numFactura', $numFactura)->where('estado_venta_id',1)->get()->count() > 0) {
            return redirect()->back()->with('error', 'El número de factura ingresado ya existe en los registros');
        }
        $cart = $request->session()->get('cart');
        foreach ($cart->items as $p) {
            if (Productos::find($p['item']->id)->stock < $p['Cantidad']){
                return redirect('cart')->with('error', 'No hay stock suficiente del producto '.$p['item']->nombreProducto);
            }
        }
        $venta = new Ventas;
        $venta->users_id = auth()->id();
        $venta->fechaVenta = date("Y-m-d H:i:s");
        $venta->numFactura = $numFactura;
        $venta->totalIva = $cart->PrecioTotal;
        $venta->iva = ($cart->PrecioTotal / 1.19) * 0.19;
        $venta->totalNeto = $cart->PrecioTotal / 1.19;
        $precioCompra = 0;
        foreach ($cart->items as $producto) {
            $precioCompra += $producto['item']->precioCompra * $producto['Cantidad'];
        }
        $venta->precioCompra = $precioCompra;
        $venta->save();
        foreach ($cart->items as $producto) {
            $venta->productos()
                ->attach(
                    $producto['item']->id,
                    [
                        'cantidad' => $producto['Cantidad'],
                        'subtotal' => $producto['Cantidad'] * $producto['item']->precioIva,
                        'precioCompra' => $producto['item']->precioCompra,
                        'precioVenta' => $producto['item']->precioIva
                    ]
                );
        }
        $request->session()->forget('cart');
        return redirect('ventas')->with('info', 'Venta realizada correctamente');
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $oldCart =  $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        if ($cart->Cantidad > 0) {
            $request->session()->put('cart', $cart);
            return redirect('/cart');
        } else {
            $request->session()->forget('cart');
        }
        return redirect('/ventas/create');
    }

    public function deleteAll(Request $request)
    {
        $request->session()->forget('cart');
        return redirect('ventas/create');
    }
}
