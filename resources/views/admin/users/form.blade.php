<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $is_editing ? 'Modificar' : 'Agregar' }}&nbsp;Usuario
                        </h2>
                        <!-- FORMULARIO -->
                        {!! Form::model($user, ['route' => [$is_editing ? 'usuarios.update' : 'usuarios.store', $user], 'method' => $is_editing ? 'PUT' : 'POST']) !!}
                        <div class="mt-5">
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 md:space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Nombre<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Nombre"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="nombre" id="user_name"
                                        value="{{ $user->name }}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Correo<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Correo"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="correo" id="user_mail"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Tipo de usuario</label>
                                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-2 text-xs" id="tipos">
                                        @foreach ($roles as $rol)
                                            <label class="inline-flex items-center">
                                                <div id="{{ $rol->name }}" estado="">
                                                    {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'block bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4']) !!}
                                                </div>
                                                <span class="ml-2">{{ $rol->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <p class="text-sm text-red-500 hidden mt-3" id="error">Por favor, completa
                                        este campo.</p>
                                </div>
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Estado<abbr
                                            title="obligatorio">*</abbr></label>
                                    <select
                                        class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full "
                                        required="required" name="tipo_estado" id="tipo_estado">
                                        <option value="1" {{ $user->tipo_estado_id == 1 ? 'selected' : '' }}>
                                            Habilitado</option>
                                        <option value="2" {{ $user->tipo_estado_id == 2 ? 'selected' : '' }}>
                                            Deshabilitado</option>
                                    </select>
                                    <p class="text-sm text-red-500 hidden mt-3" id="error">Por favor, completa
                                        este campo.</p>
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Permisos</label>
                                    <div class="grid sm:grid-cols-3 md:grid-cols-4 gap-2 text-xs">
                                        @foreach ($permissions as $permission)
                                            <label class="inline-flex items-center">
                                                {!! Form::checkbox('permissions[]', $permission->id, $user->hasPermissionTo($permission->id), ['class' => 'block bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4', 'id' => $permission->id]) !!}
                                                <span class="ml-2">{{ $permission->description }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-red-500 text-right my-3">Los campos obligatorios están
                                marcados con un asterisco <abbr title="Campo obligatorio">*</abbr></p>
                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <a href="/usuarios"
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                    Cancelar </a>
                                {!! Form::submit('Guardar', ['class' => 'mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <!-- FIN FORMULARIO -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        admin = document.getElementById("Administrador").addEventListener("click", activarAdmin);
        document.getElementById("Bodeguero").addEventListener("click", activarBodeguero);
        document.getElementById("Vendedor").addEventListener("click", activarVendedor);
        var checkboxes = document.getElementsByName('permissions[]');
        var permisosBodeguero = (@json($roles[1]->permissions));
        var permisosVendedor = @json($roles[2]->permissions);
        var tipos = document.getElementById('tipos');
        var admin = document.getElementById("Administrador");
        var bodeguero = document.getElementById("Bodeguero");
        var vendedor = document.getElementById("Vendedor");
        for (var i = 0; i < 3; i++) {
            if (tipos.children[i].children[0].children[0].getAttribute('checked') == "checked") {
                tipos.children[i].children[0].setAttribute('estado', "selected");
            } else {
                tipos.children[i].children[0].setAttribute('estado', "unselected");
            }
        }

        function activarAdmin() {

            if (admin.getAttribute('estado') == "unselected") {
                activar();
                admin.setAttribute('estado', "selected");
            } else {
                desactivar();
                admin.setAttribute('estado', "unselected");
            }
            reset();
        }

        function activarBodeguero() {
            var checked;
            if (bodeguero.getAttribute('estado') == "unselected") {
                bodeguero.setAttribute('estado', "selected");
                checked = true;
            } else {
                bodeguero.setAttribute('estado', "unselected");
                checked = false;
            }
            for (var i in permisosBodeguero) {
                for (var j in checkboxes) {
                    if (checkboxes[j].id == permisosBodeguero[i].id) {
                        checkboxes[j].checked = checked;
                    }
                }
            }
            reset();
        }

        function activarVendedor() {
            var checked;
            if (vendedor.getAttribute('estado') == "unselected") {
                vendedor.setAttribute('estado', "selected");
                checked = true;
            } else {
                vendedor.setAttribute('estado', "unselected");
                checked = false;

            }
            for (var i in permisosVendedor) {
                for (var j in checkboxes) {
                    if (checkboxes[j].id == permisosVendedor[i].id) {
                        checkboxes[j].checked = checked;
                    }
                }
            }
            reset();
        }

        function reset() {

            if (admin.getAttribute('estado') == "unselected" && bodeguero.getAttribute('estado') == "unselected" && vendedor.getAttribute('estado') == "unselected"){
                desactivar();
            }

            if (vendedor.getAttribute('estado') == "selected") {
                for (var i in permisosVendedor) {
                    for (var j in checkboxes) {
                        if (checkboxes[j].id == permisosVendedor[i].id) {
                            checkboxes[j].checked = true;
                        }
                    }
                }

                //vendedor.setAttribute('estado', "unselected");
            }
            if (bodeguero.getAttribute('estado') == "selected") {

                for (var i in permisosBodeguero) {
                    for (var j in checkboxes) {
                        if (checkboxes[j].id == permisosBodeguero[i].id) {
                            checkboxes[j].checked = true;
                        }
                    }
                }
                //bodeguero.setAttribute('estado', "unselected");
            }
        }

        function desactivar() {
            for (var i in checkboxes) {
                checkboxes[i].checked = '';
            }
        }

        function activar() {
            for (var i in checkboxes) {
                checkboxes[i].checked = 'checked';
            }
        }

    </script>
</x-app-layout>
