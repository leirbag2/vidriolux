<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Cart;
use App\Models\Ventas;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->session()->get('cart'));
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

        $id = $request->get('id');
        $producto = Productos::find($id);
        $cantidad = $request->input('cantidad') != null ? ($request->input('cantidad') > 0 ? $request->input('cantidad') : 1): 1;
        $precioVenta = $request->input('venta');
        $producto->precioVenta = $precioVenta;
        $oldCart =  $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        if ($cart->disponible($producto, $producto->id, $cantidad)) {
            $cart->add($producto, $producto->id, $cantidad);
            $request->session()->put('cart', $cart);
            return redirect('ventas/create')->with('info', 'Agregado correctamente al carrito');
        }
        return redirect()->back()->with('error', 'No hay suficiente');
    }

    public function store(Request $request)
    {
        $cart = $request->session()->get('cart');
        $numFactura = $request->input('num_factura');
        if (Ventas::where('numFactura', $numFactura)->get()->count() > 0) {
            return redirect()->back()->with('error', 'El número de factura ingresado ya existe en los registros');
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
            $precioCompra += ($producto['item']->precioNeto + $producto['item']->precioIva) * $producto['Cantidad'];
        }
        $venta->precioCompra = $precioCompra;
        $venta->save();
        foreach ($cart->items as $producto) {
            $venta->productos()
                ->attach(
                    $producto['item']->id,
                    [
                        'cantidad' => $producto['Cantidad'],
                        'subtotal' => $producto['Cantidad'] * ($producto['item']->precioVenta),
                        'precioCompra' => ($producto['item']->precioNeto + $producto['item']->precioIva),
                        'precioVenta' => $producto['item']->precioVenta
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
