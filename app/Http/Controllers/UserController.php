<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //Define los permisos para acceder a cada ruta
    public function __construct()
    {
        $this->middleware('can:usuarios.index')->only('index');
        $this->middleware('can:usuarios.create')->only('create');
        $this->middleware('can:usuarios.edit')->only('edit', 'update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }

    /**
     * Muestra la tabla de todos los usuarios
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
     * Crea un nuevo usuario
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
     * Guarda el usuario creado en la base de datos
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
            return redirect("/usuarios")->with('info', 'El correo ingresado ya existe en los registros');
        }
        if ($tipo_estado < 1 || $tipo_estado > 2) {
            $tipo_estado = 2;
        }
        $usuario = new User;
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->password = $password;
        $usuario->tipo_estado_id = $tipo_estado;
        $usuario->save();
        $usuario->roles()->sync($request->roles);
        $usuario->syncPermissions($request->permissions);
        return redirect("/usuarios")->with('info', 'Se creó el usuario correctamente');
    }

    /**
     * Muestra el formulario para editar un usuario seleccionado
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
     * Actualiza el usuario seleccionado
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
        $user = User::where('email', $email)->where('email', '<>', $usuario->email)->get();

        if ($user->count() > 0) {
            return redirect('/usuarios')->with('info', 'El correo ingresado ya existe en los registros');
        }

        if ($tipo_estado < 1 || $tipo_estado > 2) {
            $tipo_estado = 2;
        }
        $usuario->name = $name;
        $usuario->email = $email;
        $usuario->tipo_estado_id = $tipo_estado;
        $usuario->save();
        $usuario->roles()->sync($request->roles);
        if ($request->roles != null) {
            $usuario->syncPermissions($request->permissions);
        } else {
            $usuario->syncPermissions(null);
        }
        return redirect('/usuarios')->with('info', 'El usuario se modificó correctamente');
    }
    /**
     * Elimina el usuario seleccionado.
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
        return redirect("/usuarios")->with('info', 'Se eliminó el usuario correctamente');
    }
}
