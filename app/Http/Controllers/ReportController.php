<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reportes.index')->only('index');
        $this->middleware('can:ventas.edit')->only('edit','update');
    }
    
    public function index()
    {
        return view('ventas/reporte');
    }

    public function edit($id)
    {
        return view('ventas.reporteEstado', [
            'ventas' => Ventas::find($id),
            'is_editing' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        return redirect('ventas/reporteEstado');
    }
}
