<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reportes.index')->only('index');
    }

    public function index()
    {
        return view('ventas/reporte');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 0de591e93606ca7e61a7056218a7bc4d18d4c1f4
