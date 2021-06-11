<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial;
use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
class HistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:historial.index')->only('index');
        $this->middleware('can:historial.create')->only('create');
        $this->middleware('can:historial.edit')->only('edit', 'update');
        $this->middleware('can:historial.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bodeguero/historial.historial', [
            'cantidad' => Historial::all()->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bodeguero/historial.form', [
            'is_editing' => false,
            'historial' => new Historial
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $codigo = $request->input('codigo');
        $producto = Productos::where('codigo',$codigo)->orWhere('id',$codigo)->first();
        $cantidad = $request->input('cantidad');
        $tipo = $request->input('tipo');
        
        if ($tipo < 1 || $tipo > 2) {
            $tipo = 1;
        }
        if ($cantidad <= 0) {
            return redirect('/historial')->with('info', 'La cantidad debe ser mayor a 0');
        }
        if ($tipo==2) {
            $cantidad*=-1;
        }

        $historial = new Historial;
        $historial->users_id = Auth::id();
        $historial->productos_id = $producto->id;
        $historial->cantidad = $cantidad;
        $historial->save();
        return redirect('/historial')->with('info', 'El registro se modificó correctamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('bodeguero/historial.form', [
            'historial' => Historial::find($id),           
            'is_editing' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $historial = Historial::find($id);
        $name = $request->input('nombre');
        $cantidad = $request->input('cantidad');
        $tipo = $request->input('tipo');
        

       

        if ($tipo < 1 || $tipo > 2) {
            $tipo = 1;
        }
        if ($cantidad <= 0) {
            return redirect('/historial')->with('info', 'La cantidad debe ser mayor a 0');
        }
        if ($tipo==2) {
            $cantidad*=-1;
        }

    
        $historial->cantidad = $cantidad;
        $historial->save();


        
        return redirect('/historial')->with('info', 'El registro se modificó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historial = Historial::find($id);
        if ($historial == null) {
            return abort(404);
        }
        $historial->delete();
        return redirect("/historial")->with('info', 'Se eliminó el registro correctamente');
    }
}
