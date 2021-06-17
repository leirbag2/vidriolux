<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Cart;
use App\Models\Ventas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('ventas/reporte');
    }
}
