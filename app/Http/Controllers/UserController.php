<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('can:usuarios.index')->only('index');
        $this->middleware('can:usuarios.create')->only('create');
        $this->middleware('can:usuarios.edit')->only('edit','update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/users.users', [
            'cantidad' => User::all()->count()
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
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'user' => new User
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
        $tipo_estado = $request->input('tipo_estado');
        $user = User::where('email', $email)->get();
        if ($user->count() > 0) {
            return redirect("/usuarios?error=user_exists");
        }
        if ($tipo_estado <1 || $tipo_estado >2){
            $tipo_estado = 2;
        }
        $usuario = new User;
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->password = $password;
        $usuario->tipo_estado_id = $tipo_estado;
        $usuario->roles()->sync($request->roles);
        $usuario->syncPermissions($request->permissions);
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
        return view('admin/users.form', [
            'user' => User::find($id),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
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
        $usuario = User::find($id);
        $name = $request->input('nombre');
        $email = $request->input('correo');
        $tipo_estado = $request->input('tipo_estado');
        $user = User::where('email', $email)->where('email','<>',$usuario->email)->get();

        if ($user->count() > 0) {
            return redirect('/usuarios?error=user_exists');
        }

        if ($tipo_estado <1 || $tipo_estado >2){
            $tipo_estado = 2;
        }
        $usuario->syncPermissions($request->permissions);
        $usuario->roles()->sync($request->roles);
        $usuario->name = $name;
        $usuario->email = $email;
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
        $usuario = User::find($id);
        if ($usuario == null) {
            return abort(404);
        }
        $usuario->delete();
        return redirect("/usuarios?ok=delete");
    }
}
