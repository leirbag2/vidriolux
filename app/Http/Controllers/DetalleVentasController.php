<?php

namespace App\Http\Controllers;
use App\Models\Ventas;
use App\Models\DetalleVentas;
use Illuminate\Http\Request;


class DetalleVentasController extends Controller
{

    public function show($id)
    {
      $venta = Ventas::find($id);
      $detalleVentas = $venta->detalle;
      return view('detalleventas/detalleventas' ,compact('detalleVentas','venta')); 
    }

}
