<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $is_editing ? 'Modificar' : 'Agregar' }}&nbsp;Registro
                        </h2>
                        <!-- FORMULARIO -->
                        {!! Form::model($historial, ['route' => [$is_editing ? 'historial.update' : 'historial.store', $historial], 'method' => $is_editing ? 'PUT' : 'POST']) !!}
                        <div class="mt-5">
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 md:space-y-2 w-full text-xs">
                                    @if (session('info'))
                                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
                                        {{session('info')}}
                                    </div>
                                    @endif
                                    <label class="font-semibold text-gray-600 py-2">Codigo del Producto<abbr title="obligatorio">*</abbr></label>
                                    <input placeholder="Codigo" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="text" name="codigo" id="codigo" 
                                    value="{{ $is_editing ? $historial->producto->codigo : ''}}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Cantidad<abbr title="obligatorio">*</abbr></label>
                                    <input placeholder="Cantidad" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" required="required" type="number" name="cantidad" id="cantidad" value="{{abs($historial->cantidad )}}">
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Seleccione una opcion<abbr title="obligatorio">*</abbr></label>
                                    <select min="1" class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full " required="required" name="tipo" id="tipo">
                                        <option {{$historial->cantidad > 0 ? 'selected' : ''}} value="1">
                                            Ingreso</option>
                                        <option {{$historial->cantidad < 0 ? 'selected' : ''}} value="2">
                                            Retiro</option>
                                    </select>
                                </div>
                            </div>

                            <p class="text-xs text-red-500 text-right my-3">Los campos obligatorios están
                                marcados con un asterisco <abbr title="Campo obligatorio">*</abbr></p>
                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <a href="/historial" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
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
</x-app-layout>