<div>

<div class="row">
            <div class="col-12 col-md-4 text-center">
                <span>Fecha de consulta: <b> </b> </span>
                <div class="form-group">
                    <strong>{{Carbon\Carbon::now()->format('Y-m-d')}}</strong>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center">
                <span>Cantidad de ventas Registradas: <b> </b> </span>
                <div class="form-group">
                    <strong>{{$ventas->count()}}</strong>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center">
            @foreach ($ventas as $venta)
                <span>Total de ingresos: <b> </b> </span>
                <div class="form-group">
                    <strong> {{ $venta->totalIva }}</strong>
                </div>
                   @endforeach
            </div>
        </div>
    <div class="flex relative mt-1">
        <input type="text" id="password" class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" placeholder="Buscar" wire:model="search" type="search">
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
                    @canany(['ventas.edit', 'ventas.destroy'])
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                    @endcanany
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
                            {{ $venta->totalNeto }}
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $venta->iva }}
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $venta->totalIva }}
                        </div>
                    </td>
                    <!-- Boton : VerDetalleVenta -->
                    @canany(['ventas.edit', 'ventas.destroy'])
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <a href="{{ route('ventas.show', $venta->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                            <!-- Boton : EditarVenta -->
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <a href="{{route('ventas.edit',$venta->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                            <!-- Boton : EliminarVenta -->
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <a wire:click="$emit('ventas',{{ $venta->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-red-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                            <form id="delete-form-{{ $venta->id }}" action="/ventas/{{ $venta->id }}" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </div>
                    </td>
                    @endcanany
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