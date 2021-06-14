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
     $this->middleware('can:ventas.edit')->only('edit','update');
     $this->middleware('can:ventas.create')->only('create');

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
            'ventas' => new Ventas,
              
    
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
        $venta->numFactura = $numFactura;
        $venta->save();
        return redirect('/ventas')->with('info', 'El numero de factura se modificó correctamente');
    }



 /**
     * Muestra la tabla de todos las ventas
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    return view('ventas/ventas' ,[

    ]);
    }


    /**
     * Guarda el usuario creado en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $numFactura = $request->input('numFactura');
        $venta = new Ventas;
        $venta->numFactura = $numFactura;
        $venta->save();
        return redirect("/ventas")->with('info', 'Se creó la facutra correctamente');
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
        $ventas->delete();
        return redirect("/ventas")->with('info', 'Se eliminó la venta correctamente');
    }













    
}