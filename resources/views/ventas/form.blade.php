<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $is_editing ? 'Modificar' : 'Agregar' }}&nbsp;factura: {{ $ventas->numFactura}}
                        </h2>
                        @if (session('info'))
                        <div class="mt-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
                            {{session('info')}}
                        </div>
                        @endif
                        @if (session('ok'))
                        <div class="mt-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 mb-5">
                            {{session('ok')}}
                        </div>
                        @endif
                        <!-- FORMULARIO -->
                        {!! Form::model($ventas, ['route' => [$is_editing ? 'ventas.update' : 'ventas.store', $ventas], 'method' => $is_editing ? 'PUT' : 'POST']) !!}

                        <div class="mt-5 mb-5">
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Numero de Factura<abbr title="obligatorio">*</abbr></label>
                                    <input placeholder="numerofactura" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="text" name="numFactura" id="num_factura"
                                    value="{{ $is_editing ? $ventas->numFactura : ''}}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>

                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Estado de factura<abbr title="obligatorio">*</abbr></label>
                                    <select {{ $ventas->estado_venta_id == 2 ? 'disabled' : '' }}
                                        class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full "
                                        required="required" name="estado_venta" id="estado_venta" onchange="alertarCambioEstado(this.value);">
                                        <option value="1" {{ $ventas->estado_venta_id == 1 ? 'selected' : '' }}>
                                            Realizado</option>
                                        <option value="2" {{ $ventas->estado_venta_id == 2 ? 'selected' : '' }}>
                                            Anulado</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="edicion"></div>
                            
                            <p class="text-xs text-red-500 text-right my-3">Los campos obligatorios están
                                marcados con un asterisco <abbr title="Campo obligatorio">*</abbr></p>

                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <a href="/ventas" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
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

    <script>
        function alertarCambioEstado(){
            var option = document.getElementById('#estado_venta');
            document.getElementById("edicion").innerHTML = "<div class='mt-2 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5'>Una vez anulado el estado de la factura, el estado ya no podra ser modificado</div>";
        }
    </script>

</x-app-layout>