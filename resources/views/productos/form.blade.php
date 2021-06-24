<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-6 text-gray-500">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $is_editing ? 'Modificar' : 'Agregar' }}&nbsp;Producto
                        </h2>
                        <!-- FORMULARIO -->
                        {!! Form::model($producto, ['route' => [$is_editing ? 'productos.update' : 'productos.store', $producto], 'method' => $is_editing ? 'PUT' : 'POST']) !!}
                        <div class="mt-5">
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                @if (session('error'))
                                    <div
                                        class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('info'))
                                    <div
                                        class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 mb-5">
                                        {{ session('info') }}
                                    </div>
                                @endif
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="mb-3 md:space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Codigo<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Codigo"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="codigo" value="{{ $producto->codigo }}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                                <div class="mb-3 md:space-y-2 w-full text-xs">
                                    <label class="font-semibold text-gray-600 py-2">Nombre<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Nombre"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="text" name="nombre"
                                        value="{{ $producto->nombreProducto }}">
                                    <p class="text-red text-xs hidden">Please fill out this field.</p>
                                </div>
                            </div>
                            <div class="mb-3 md:space-y-2 w-full text-xs">
                                <div class="flex-auto w-full mb-1 text-xs space-y-2">
                                    <label class="font-semibold text-gray-600 py-2">Descripción</label>
                                    <textarea name="description" class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block
                                    bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4"
                                        spellcheck="false">{{ $producto->descripcionProducto }}</textarea>
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Precio Compra<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Precio Compra"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        type="number" name="precioCompra" required
                                        value="{{ $producto->precioCompra }}">
                                </div>
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Precio Neto<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Precio neto "
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="number" name="precio" min="0" id="precio"
                                        value="{{ $producto->precioNeto }}">
                                </div>
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Precio + Iva<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Precio + IVA" id="precioIva"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        type="number" name="precio" disabled value="{{ $producto->precioIva }}">
                                </div>
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Cantidad<abbr
                                            title="obligatorio">*</abbr></label>
                                    <input placeholder="Cantidad"
                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                                        required="required" type="number" name="cantidad"
                                        value="{{ $producto->stock }}">
                                </div>
                            </div>
                            <div class="md:flex md:flex-row md:space-x-4 w-full text-xs">
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Categoria</label>
                                    <select
                                        class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full "
                                        name="categoria">
                                        <option value="0" {{ $producto->categoria == null ? 'selected' : '' }}>
                                            Seleccione una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                {{ $producto->categoria != null ? ($categoria->id == $producto->categorias_id ? 'selected' : '') : '' }}>
                                                {{ $categoria->nombreCategoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full flex flex-col mb-3">
                                    <label class="font-semibold text-gray-600 py-2">Estado<abbr
                                            title="obligatorio">*</abbr></label>
                                    <select
                                        class="block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 md:w-full "
                                        required="required" name="tipo_estado" id="tipo_estado">
                                        <option value="1" {{ $producto->tipo_estado_id == 1 ? 'selected' : '' }}>
                                            Habilitado</option>
                                        <option value="2" {{ $producto->tipo_estado_id == 2 ? 'selected' : '' }}>
                                            Deshabilitado</option>
                                    </select>
                                    <p class="text-sm text-red-500 hidden mt-3" id="error">Por favor, completa
                                        este campo.</p>
                                </div>
                            </div>

                            <p class="text-xs text-red-500 text-right my-3">Los campos obligatorios están
                                marcados con un asterisco <abbr title="Campo obligatorio">*</abbr></p>
                            <div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
                                <a href="/productos"
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                    Cancelar </a>
                                {!! Form::submit('Guardar', ['class' => 'mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("precio").addEventListener('keyup', (event) => {
            var precio = document.getElementById("precio").value;
            precio *= 1.19;
            document.getElementById("precioIva").setAttribute("value", Math.round(precio));
        });
    </script>
</x-app-layout>
