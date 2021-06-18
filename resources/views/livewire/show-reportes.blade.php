<div>
    <div class="flex flex-row">
        <div class="mr-4">
            <span>Fecha Inicial:</span>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="date" name="fecha_inicial" id="fecha_inicial" wire:model="fechaIn">
        </div>
        <div>
            <span>Fecha Final:</span>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4" type="date" name="fecha_fin" id="fecha_fin" wire:model="fechaFin">
        </div>
    </div>
    <div class="">
        <span>Total de ingresos:</span>
        <div class="text-lg font-bold">
            ${{number_format($ventasTotal, 0, ',', '.')}}
        </div>
    </div>
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Vendedor</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Numero de Factura</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Fecha de Venta</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Neto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Iva</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Total Iva</th>
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
                            ${{ number_format($venta->totalIva, 0, ',', '.')}}
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