<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $is_editing ? 'Editar' : 'Nuevo' }}&nbsp;Usuario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <!-- FORMULARIO -->
                        <form action="{{ $is_editing ? '/usuarios/' . $user->id : '/usuarios' }}" method="POST">
                            @csrf
                            <input name="_method" type="hidden" value="{{ $is_editing ? 'PUT' : 'POST' }}">
                            <div class="mt-5">
                                <div class="form">
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
                                            <label class="font-semibold text-gray-600 py-2">Tipo de usuario<abbr
                                                    title="obligatorio">*</abbr></label>
                                            <select
                                                class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full "
                                                required="required" name="tipo_usuario" id="tipo_usuario">
                                                <option value="0">Seleccione un tipo de usuario</option>
                                                @foreach ($listaTipo as $tipo)
                                                    <option value="{{ $tipo->id }}"
                                                        {{ $user->tipo_usuario_id == $tipo->id ? 'selected' : '' }}>
                                                        {{ $tipo->descripcionTipo }}</option>
                                                @endforeach
                                            </select>
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
                                    <p class="text-xs text-red-500 text-right my-3">Los campos obligatorios están
                                        marcados con un asterisco <abbr title="Campo obligatorio">*</abbr></p>
                                    <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                        <a href="/usuarios"
                                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                            Cancelar </a>
                                        <button type="submit"
                                            class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- FIN FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
