<div>
    <div class="md:flex md:flex-row md:space-x-4">
        <div>
            <span>Fecha Inicial:</span>
            <input class="appearance-none block w-full rounded-lg h-10 px-4 border-gray-200" type="date"
                name="fecha_inicial" id="fecha_inicial" wire:model="fechaIn">
        </div>
        <div>
            <span>Fecha Final:</span>
            <input class="appearance-none block w-full rounded-lg h-10 px-4 border-gray-200" type="date"
                name="fecha_fin" id="fecha_fin" wire:model="fechaFin">
        </div>
        <div>
            <span>Vendedor:</span>
            <input type="text"
                class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                placeholder="Buscar vendedor" wire:model="vendedor">
        </div>
    </div>
    @if ($error)
        <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
            Las fecha inicial debe ser menor a la fecha final
        </div>
    @endif
    <div
        class="p-5 mt-4 border border-gray-400 rounded-lg shadow max-w-40 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        <div class="mr-8">
            <span>Total de ingresos:</span>
            <div class="text-lg font-bold">
                ${{ number_format($ventasTotal, 0, ',', '.') }}
            </div>
        </div>
        <div class="mr-8">
            <span>Total de ganancias:</span>
            <div class="text-lg font-bold">
                ${{ number_format($ganancias, 0, ',', '.') }}
            </div>
        </div>
        <div class="mr-8">
            <span>Ventas realizadas:</span>
            <div class="text-lg font-bold">
                {{ $all->count() }}
            </div>
        </div>
        <div class="mr-8">
            <span>Mayor venta:</span>
            <div class="text-lg font-bold">
                ${{ number_format($all->max('totalIva'), 0, ',', '.') }}
            </div>
        </div>
        <div class="mr-8">
            <span>Promedio por venta:</span>
            <div class="text-lg font-bold">
                ${{ number_format($all->avg('totalIva'), 0, ',', '.') }}
            </div>
        </div>
    </div>
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Vendedor</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Numero de Factura</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Fecha de Venta</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Precio Compra</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Neto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Iva</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total + Iva</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Ver</th>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($venta->precioCompra, 0, ',', '.') }}
                                </div>
                            </td>
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
                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    {{ $ventas->links() }}
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('ventas', ventas => {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "No podrá revertir el cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + ventas).submit();
                        Swal.fire(
                            '¡Eliminado!',
                            'Se ha eliminado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
