<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TipoUsuario;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = User::all();
        $cantidad = $lista->count();
        return view('admin/users.users', [
            'lista' => $lista,
            'cantidad' => $cantidad
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/users.form', [
            'is_editing' => false,
            'user' => new User,
            'listaTipo' => TipoUsuario::all()
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
        $name = $request->input('nombre');
        $email = $request->input('correo');
        $password = Hash::make($request->input('password', 'P@ssw0rd'));
        $tipo_usuario = $request->input('tipo_usuario');
        $tipo_estado = $request->input('tipo_estado');
        $user = User::where('email', $email)->get();
        if ($user->count() > 0) {
            return redirect("/usuarios?error=user_exists");
        }
        if ($tipo_usuario <1 || $tipo_usuario >3){
            $tipo_usuario = null;
        }
        if ($tipo_estado <1 || $tipo_estado >2){
            $tipo_estado = 2;
        }
        $usuario = new User;
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->password = $password;
        $usuario->tipo_usuario_id = $tipo_usuario;
        $usuario->tipo_estado_id = $tipo_estado;
        $usuario->save();
        return redirect("/usuarios?ok=create");
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
        $user = User::find($id);
        return view('admin/users.form', [
            'user' => $user,
            'is_editing' => true,
            'listaTipo' => TipoUsuario::all()
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
        $usuario = User::find($id);
        $name = $request->input('nombre');
        $email = $request->input('correo');
        $tipo_usuario = $request->input('tipo_usuario');
        $tipo_estado = $request->input('tipo_estado');
        $user = User::where('email', $email)->where('email','<>',$usuario->email)->get();

        if ($user->count() > 0) {
            return redirect('/usuarios?error=user_exists');
        }

        if ($tipo_usuario <1 || $tipo_usuario >3){
            $tipo_usuario = null;
        }
        if ($tipo_estado <1 || $tipo_estado >2){
            $tipo_estado = 2;
        }
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->tipo_usuario_id = $tipo_usuario;
        $usuario->tipo_estado_id = $tipo_estado;
        $usuario->save();
        return redirect('/usuarios?ok=update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
