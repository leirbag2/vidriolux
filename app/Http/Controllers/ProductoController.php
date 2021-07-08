<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.create')->only('create');
        $this->middleware('can:productos.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.productos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.form', [
            'is_editing' => false,
            'producto' => new Productos,
            'categorias' => Categorias::all()
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
        $producto = Productos::where('codigo', $codigo)->get();
        if ($producto->count() > 0) {
            return redirect()->back()->with('error', 'El codigo ingresado ya existe en los registros');
        }
        $cantidad = $request->input('cantidad');
        if ($cantidad <= 0) {
            return redirect()->back()->with('error', 'La cantidad ingresada debe ser mayor a 0');
        }
        $categoria = $request->input('categoria');
        $tipo_estado = $request->input('tipo_estado');
        if (!Categorias::find($categoria)) {
            $categoria = null;
        }
        if ($tipo_estado < 1 || $tipo_estado > 2) {
            $tipo_estado = 2;
        }
        $nombre = $request->input('nombre');
        $descripcion = $request->input('description');
        $precio = $request->input('precio');
        $precioCompra = $request->input('precioCompra');
        if($precio < 0 || $precioCompra < 0){
            return redirect()->back()->with('error', 'Los precios deben ser mayor a 0');
        }
        $producto = new Productos;
        $producto->codigo = $codigo;
        $producto->nombreProducto = $nombre;
        $producto->descripcionProducto = $descripcion;
        $producto->precioNeto = $precio;
        $producto->precioIva = $precio * 1.19;
        $producto->precioCompra = $precioCompra;
        $producto->stock = $cantidad;
        $producto->categorias_id = $categoria;
        $producto->tipo_estado_id = $tipo_estado;
        $producto->save();
        return redirect()->back()->with('info', 'Se agregó el producto correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('productos.form', [
            'is_editing' => true,
            'producto' => Productos::find($id),
            'categorias' => Categorias::all()
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

        $codigo = $request->input('codigo');
        $cantidad = $request->input('cantidad');
        if ($cantidad <= 0) {
            return redirect()->back()->with('error', 'La cantidad ingresada debe ser mayor a 0');
        }
        $categoria = $request->input('categoria');
        if (!Categorias::find($categoria)) {
            $categoria = null;
        }
        $producto = Productos::where('codigo', $codigo)->where('id', '<>', Productos::find($id)->id)->get();
        $tipo_estado = $request->input('tipo_estado');
        if ($producto->count() > 0) {
            return redirect()->back()->with('error', 'El codigo ingresado ya existe en los registros');
        }
        if ($tipo_estado < 1 || $tipo_estado > 2) {
            $tipo_estado = 2;
        }
        $precio = $request->input('precio');
        $precioCompra = $request->input('precioCompra');
        if($precio < 0 || $precioCompra < 0){
            return redirect()->back()->with('error', 'Los precios deben ser mayor a 0');
        }
        $nombre = $request->input('nombre');
        $descripcion = $request->input('description');
        $producto = Productos::find($id);
        $producto->codigo = $codigo;
        $producto->nombreProducto = $nombre;
        $producto->descripcionProducto = $descripcion;
        $producto->precioNeto = $precio;
        $producto->precioIva = $precio * 1.19;
        $producto->precioCompra = $precioCompra;
        $producto->stock = $cantidad;
        $producto->categorias_id = $categoria;
        $producto->tipo_estado_id = $tipo_estado;
        $producto->save();
        return redirect()->back()->with('info', 'Se modificó el producto correctamente');
    }
}
