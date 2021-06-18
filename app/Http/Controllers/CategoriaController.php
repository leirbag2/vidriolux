<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:categorias.index')->only('index');
        $this->middleware('can:categorias.create')->only('create');
        $this->middleware('can:categorias.edit')->only('edit', 'update');
        $this->middleware('can:categorias.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categorias.categorias');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.form', [
            'is_editing' => false,
            'categoria' => new Categorias()
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
        $nombreCategoria = $request->input('categoria');
        $categoria = Categorias::where('nombreCategoria', $nombreCategoria)->get();
        if ($categoria->count() > 0) {
            return redirect()->back()->with('error', 'El nombre ingresado ya existe en los registros');
        }
        $categoria = new Categorias;
        $categoria->nombreCategoria = $nombreCategoria;
        $categoria->save();
        return redirect()->back()->with('info', 'Se agrego la categoría correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('categorias.form', [
            'is_editing' => true,
            'categoria' => Categorias::find($id)
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
        $nombreCategoria = $request->input('categoria');
        $categoria = Categorias::where('nombreCategoria', $nombreCategoria)->where('id','<>',Categorias::find($id)->id)->get();
        if ($categoria->count() > 0) {
            return redirect()->back()->with('error', 'El nombre de la categoría ingresada ya existe en los registros');
        }
        $categoria = Categorias::find($id);
        $categoria->nombreCategoria = $nombreCategoria;
        $categoria->save();
        return redirect()->back()->with('info', 'Se modificó la categoría correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categorias::find($id);
        $categoria->delete();
        return redirect()->back()->with('info', 'Se eliminó la categoría correctamente');
    }
}
