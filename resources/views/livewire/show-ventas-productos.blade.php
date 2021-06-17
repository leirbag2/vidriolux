<div>
    <div class="flex flex-row items-center">
        <input type="text" class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300
    focus:outline-none focus:border-blue-500 transition-colors" placeholder="Buscar" wire:model="search" type="search">
        <a href="/cart" class="mb-2 md:mb-0 bg-blue-500 px-5 py-2 ml-2 text-center whitespace-nowrap
    text-sm shadow-sm font-medium tracking-wider border text-white rounded-full hover:shadow-lg hover:bg-blue-600">
            Ver Carrito</a>
    </div>

    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Código</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Producto</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Categoria</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Precio Compra</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Precio Venta</th>
                    <th scope="col" class="px-6 py-3 text-right uppercase tracking-wider">Cantidad</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $producto)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            {{ $producto->codigo }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            {{ $producto->nombreProducto }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            {{ $producto->stock }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            {{ $producto->nombreCategoria != null ? $producto->nombreCategoria : 'Sin categoria' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            ${{ number_format(($producto->precioNeto + $producto->precioIva), 0, ',', '.')  }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-center text-gray-900">
                            <input class="w-40 text-grey-darker border
                            border-gray-200 rounded-lg h-10 px-4" type="number" name="precioVenta" id="precio-venta-{{$producto->id}}" value="{{ $producto->precioIva + $producto->precioNeto}}">
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-right text-gray-900">
                            <input class=" w-20 text-grey-darker border border-gray-200 rounded-lg h-10 px-4" min="1" max="{{ $producto->stock }}" type="number" id="cantidad-{{ $producto->id }}" name="cantidad" value="">
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="mt-0 text-center md:space-x-3 md:block flex flex-col-reverse">
                            <a wire:click="$emit('add',{{ $producto->id }})" class="cursor-pointer mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm
                            shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Agregar
                            </a>
                        </div>
                        <form action="/cart/add" id="add-form-{{ $producto->id }}" method="GET">
                            @csrf
                            <input type="hidden" id="add-{{ $producto->id }}" name="cantidad" value="">
                            <input type="hidden" id="venta-{{ $producto->id }}" name="venta" value="">
                            <input type="hidden" name="id" value="{{ $producto->id }}">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    </form>
    @push('js')
    <script>
        Livewire.on('add', id => {
            var cantidad = document.getElementById('cantidad-' + id).value;
            var venta = document.getElementById('precio-venta-' + id).value;
            document.getElementById('add-' + id).setAttribute("value", cantidad);
            document.getElementById('venta-' + id).setAttribute("value", venta);
            document.getElementById('add-form-' + id).submit();;
        });
    </script>
    @endpush
    {{ $productos->links() }}
</div>