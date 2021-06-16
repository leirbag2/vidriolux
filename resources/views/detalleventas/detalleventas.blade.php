<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center mb-5">
                        Factura: {{$venta->numFactura}}
                    </h2>
                    <div class="text-gray-500">
                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                     $total = 0;
                                    @endphp
                                    @foreach ($detalleVentas as $detalleventa)
                                    @php
                                     $total += $detalleventa->producto->precioNeto * $detalleventa->cantidad;
                                    @endphp
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalleventa->producto->nombreProducto }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{  number_format($detalleventa->producto->precioNeto, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalleventa->cantidad }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                ${{ number_format(($detalleventa->producto->precioNeto * $detalleventa->cantidad), 0, ',', '.') }}
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
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                ${{ number_format($total, 0, ',', '.') }}
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </x-table>
                        <!-- end table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>