<div>
    <div class="flex relative mt-1">
        @can('ventas.create')
            <div class="flex-none mr-10">
                <a href="/ventas/create" type="button"
                    class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                    Registrar nueva Venta
                </a>
            </div>
        @endcan
    </div>
    @if ($error)
        <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
            Las fecha inicial debe ser menor a la fecha final
        </div>
    @endif
    <div class="lg:flex lg:flex-row lg:space-x-4 mt-4">
        <div>
            <span>Fecha Inicial:</span>
            <input class="appearance-none block w-full border rounded-lg h-10 px-4 border-gray-200" type="date"
                name="fecha_inicial" id="fecha_inicial" wire:model="fechaIn">
        </div>
        <div>
            <span>Fecha Final:</span>
            <input class="appearance-none block w-full border rounded-lg h-10 px-4 border-gray-200" type="date"
                name="fecha_fin" id="fecha_fin" wire:model="fechaFin">
        </div>
        @if (auth()->user()->hasRole('Administrador'))
            <div>
                <span>Vendedor:</span>
                <input type="text"
                    class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                    placeholder="Buscar vendedor" wire:model="vendedor">
            </div>
        @endif
        <div>
            <span>Número factura:</span>
            <input type="text"
                class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                placeholder="Buscar factura" wire:model="search">
        </div>
        <div class="w-40">
            <span>Estado de venta:</span>
            <select
                class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                wire:model="estado">
                <option value="1">Realizado</option>
                <option value="2">Anulado</option>
            </select>
        </div>
    </div>
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Vendedor</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">N° Factura</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Fecha de Venta</th>
                    @if (auth()->user()->hasRole('Administrador'))
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Compra</th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Neto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Iva</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Iva</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Nota de credito</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($ventas as $venta)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $venta->usuario->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $venta->numFactura }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $venta->fechaVenta }}
                            </div>
                        </td>
                        @if (auth()->user()->hasRole('Administrador'))
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($venta->precioCompra, 0, ',', '.') }}
                                </div>
                            </td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                ${{ number_format($venta->totalNeto, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                ${{ number_format($venta->iva, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                ${{ number_format($venta->totalIva, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $venta->estado->estado }}
                            </div>
                        </td>
                        <!-- Boton : VerDetalleVenta -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex item-center justify-center">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="{{ route('ventas.show', $venta->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="stroke-current text-blue-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                                <!-- Boton : EditarVenta -->
                                @can('ventas.edit')
                                    @if ($venta->estado_venta_id == 1)
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('ventas.edit', $venta->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="stroke-current text-green-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    {{ $ventas->links() }}
</div>
