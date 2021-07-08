<div>
    <div class="flex relative mt-1">
        @can('productos.create')
            <div class="flex-none mr-10">
                <a href="/productos/create" type="button"
                    class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                    Agregar producto
                </a>
            </div>
        @endcan
        <input type="text"
            class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
            placeholder="Buscar" wire:model="search" type="search">
    </div>
    @if ($productos->count() > 0)
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Codigo</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Descripción</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio Compra</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio Neto</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio + IVA</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Categoria</th>
                        @canany(['productos.edit', 'productos.destroy'])
                            <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($productos as $producto)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $producto->codigo }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->nombreProducto }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->descripcionProducto }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->stock }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($producto->precioCompra, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($producto->precioNeto, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($producto->precioIva, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->categoria != null ? $producto->categoria->nombreCategoria : 'Sin categoria' }}
                                </div>
                            </td>

                            @canany(['productos.edit', 'productos.destroy'])
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $producto->estado->descripcionEstado }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex item-center justify-center">

                                        @can('productos.edit')
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ route('productos.edit', $producto) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="stroke-current text-green-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-table>
        {{ $productos->links() }}
    @else
        <h2 class="mt-4 font-bold">¡No hay resultados!</h2>
    @endif
</div>
