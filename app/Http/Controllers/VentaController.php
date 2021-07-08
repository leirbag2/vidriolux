<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentas;
use App\Models\Productos;
use Illuminate\Http\Request;
use App\Models\Ventas;

class VentaController extends Controller
{

    //Define los permisos para acceder a cada ruta
    public function __construct()
    {
        $this->middleware('can:ventas.index')->only('index');
        $this->middleware('can:ventas.destroy')->only('destroy');
        $this->middleware('can:ventas.edit')->only('edit', 'update');
        $this->middleware('can:ventas.create')->only('create');
    }


    /**
     * Muestra la tabla de todos las ventas
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('ventas/ventas', []);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventas.ventasProductos', [
            'is_editing' => false,
            'ventas' => new Ventas
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta =  Ventas::find($id);
        if($venta->estado_venta_id == 2){
            return redirect('/ventas')->with('error', 'No puede modificar una venta anulada');
        }
        return view('ventas.form', [
            'ventas' => $venta,
            'is_editing' => true
        ]);
    }

    /**
     * Actualiza el usuario seleccionado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venta = Ventas::find($id);
        $numFactura = $request->input('numFactura');
        if (Ventas::where('numFactura', $numFactura)->where('numFactura', '<>', $venta->numFactura)->get()->count() > 0) {
            return redirect()->back()->with('info', 'El número de factura ingresado ya existe en los registros');
        }
        $detalle = $venta->detalle;
        $estado = $request->input('estado_venta');
        if ($estado == 1 || $estado == 2) {
            if ($request->input('estado_venta') == 2) {
                foreach ($detalle as $v) {
                    $producto = Productos::find($v->productos_id);
                    $stockActualizado = $producto->stock + $v->cantidad;
                    $producto->stock = $stockActualizado;
                    $producto->save();
                }
            }
            $estado_venta = $request->input('estado_venta');
            $venta->estado_venta_id = $estado_venta;
            $venta->numFactura = $numFactura;
            $venta->save();
        } else {
            return redirect()->back()->with('info', 'Debe ingresar un estado válido');
        }
        return redirect('/ventas')->with('info', 'La factura se modificó correctamente');
    }

    public function show($id)
    {
        $venta = Ventas::find($id);
        $detalleVentas = $venta->detalle;
        return view('ventas/detalle', compact('detalleVentas', 'venta'));
    }
}
