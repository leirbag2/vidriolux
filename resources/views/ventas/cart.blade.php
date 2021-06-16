<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center mb-5">
                        Carro
                    </h2>
                    @if (session('info'))
                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500">
                        {{session('info')}}
                    </div>
                    @endif
                    <div class="text-gray-500">
                        @if($cart)
                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Código</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Disponible</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($productos as $producto)
                                    <tr class="hover:bg-gray-100 {{$producto['Cantidad'] > $producto['item']->stock ? 'bg-red-200' :''}}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$producto['item']->codigo}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$producto['item']->nombreProducto}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{number_format($producto['item']->precioNeto,0,',','.')}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$producto['item']->stock}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$producto['Cantidad']}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{number_format(($producto['item']->precioNeto * $producto['Cantidad']),0,',','.')}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 text-center">
                                                <a href="/cart/destroy?id={{$producto['item']->id}}" class="mb-2 md:mb-0 bg-red-400
                             px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-500">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                Total
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                {{$cart->Cantidad}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                {{ $cart->PrecioTotal }}
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </x-table>
                        <div class="grid grid-cols-2">
                            <div class="">
                                <a href="/cart/store" class="mb-2 md:mb-0 bg-green-400
                             px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">
                                    Realizar venta
                                </a>
                            </div>
                            <div class="">
                                <a href="/cart/deleteAll" class="mb-2 md:mb-0 bg-red-400
                             px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-500">
                                    Vaciar carro
                                </a>
                            </div>
                        </div>
                        @else
                        <h2 class="text-xl text-gray-800 leading-tight mb-5">
                            No hay productos agregados
                        </h2>
                        @endif
                        <!-- end table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>