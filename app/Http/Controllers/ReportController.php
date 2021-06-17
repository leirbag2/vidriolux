<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Cart;
use App\Models\Ventas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('ventas/reporte', []);
    }



    public function reportes_dia()
    {
        $ventas = Ventas::whereDate('fechaVenta', Carbon::today())->get();
        $total = $ventas->sum('totalIva');
        return view('ventas/reporte', compact('ventas', 'total'));
    }

    public function reportes_mes()
    { }
}
