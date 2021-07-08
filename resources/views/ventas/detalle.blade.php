<x-app-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center mb-5">
                        Factura: {{ $venta->numFactura }}
                    </h2>
                    <a href="{{url()->previous()}}"
                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                    Atrás</a>
                    <div class="text-gray-500">
                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Código</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                                        @if (auth()->user()->hasRole('Administrador'))
                                            <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio Compra</th>
                                        @endif
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio Venta</th>
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                                        @if (auth()->user()->hasRole('Administrador'))
                                            <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Subtotal Compra</th>
                                        @endif
                                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Subtotal Venta</th>
                                    </tr>
                                </thead>
                                <?php $cantidad = 0; ?>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($detalleVentas as $detalleventa)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalleventa->producto->codigo }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalleventa->producto->nombreProducto }}
                                                </div>
                                            </td>
                                            @if (auth()->user()->hasRole('Administrador'))
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    ${{ number_format($detalleventa->precioCompra, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    ${{ number_format($detalleventa->precioVenta, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalleventa->cantidad }}
                                                </div>
                                            </td>
                                            @if (auth()->user()->hasRole('Administrador'))
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        ${{ number_format(($detalleventa->precioCompra * $detalleventa->cantidad), 0, ',', '.') }}
                                                    </div>
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    ${{ number_format($detalleventa->subtotal, 0, ',', '.') }}
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $cantidad += $detalleventa->cantidad; ?>
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
                                        @if (auth()->user()->hasRole('Administrador'))<td></td>@endif
                                        <td></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                {{ $cantidad }}
                                            </div>
                                        </td>
                                        @if (auth()->user()->hasRole('Administrador'))
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-bold">
                                                    ${{ number_format($venta->precioCompra, 0, ',', '.') }}
                                                </div>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-bold">
                                                ${{ number_format($venta->totalIva, 0, ',', '.') }}
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
