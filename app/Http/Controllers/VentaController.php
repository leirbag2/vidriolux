<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use App\Models\Ventas;

class VentaController extends Controller
{

    //Define los permisos para acceder a cada ruta
    public function __construct()
    {
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
        return view('ventas.form', [
            'ventas' => Ventas::find($id),
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
        if (Ventas::where('numFactura', $numFactura)->get()->count() > 0) {       
            return redirect()->back()->with('info', 'El número de factura ingresado ya existe en los registros');
        }
        $venta->numFactura = $numFactura;
        $venta->save();
        return redirect('/ventas')->with('info', 'El numero de factura se modificó correctamente');
    }

    public function show($id)
    {
        $venta = Ventas::find($id);
        $detalleVentas = $venta->detalle;
        return view('ventas/detalle', compact('detalleVentas', 'venta'));
    }

    /**
     * Eliminar la venta Seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ventas = Ventas::find($id);
        if ($ventas == null) {
            return abort(404);
        }
        $ventas->productos()->sync(null);
        $ventas->delete();
        return redirect("/ventas")->with('info', 'Se eliminó la venta correctamente');
    }
}
