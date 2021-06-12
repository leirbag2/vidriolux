<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\VentaController;


class VentaController extends Controller
{


 //Define los permisos para acceder a cada ruta
 public function __construct()
 {
     $this->middleware('can:detalleVentas.destroy')->only('destroy');
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
     * Eliminar la venta Seleccionada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Ventas::find($id);
        if ($venta == null) {
            return abort(404);
        }
        $venta->delete();
        return redirect("/detalleVentas")->with('info', 'Se eliminó la venta correctamente');
    }

}
