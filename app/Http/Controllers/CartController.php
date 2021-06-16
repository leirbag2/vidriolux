<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Cart;
use App\Models\Ventas;
use Illuminate\Http\Request;

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
        $cantidad = $request->get('cantidad');
        $oldCart =  $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($producto, $producto->id, $cantidad);
        $request->session()->put('cart', $cart);
        return redirect('ventas/create')->with('info', 'Agregado correctamente al carrito');
    }

    public function store(Request $request)
    {
        $cart = $request->session()->get('cart');
        //dd($cart);
        $numFactura = $request->input('numFactura');
        $venta = new Ventas;
        $venta->users_id = auth()->id();
        $venta->fechaVenta = date("Y-m-d H:i:s");
        $venta->numFactura = rand(1, 1000);
        $venta->totalNeto = $cart->PrecioTotal;
        $venta->iva = $cart->PrecioTotal * 0.19;
        $venta->totalIva = $cart->PrecioTotal * 1.19;
        $venta->save();
        foreach ($cart->items as $producto) {
            $venta->productos()
                ->attach(
                    $producto['item']->id,
                    [
                        'cantidad' => $producto['Cantidad'],
                        'subtotal' => $producto['Cantidad'] * $producto['item']->precioNeto
                    ]
                );
        }
        $request->session()->forget('cart');
        return redirect('ventas/create')->with('info', 'Venta realizada correctamente');
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $oldCart =  $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        if($cart->Cantidad > 0){
            $request->session()->put('cart', $cart);
            return redirect('/cart');
        }else{
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
