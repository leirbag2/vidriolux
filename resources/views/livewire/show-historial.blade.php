<div>
    <div class="flex relative mt-1">
        @can('historial.create')
            <div class="flex-none mr-10">
                <a href="/historial/create" type="button"
                    class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                    Ingreso/Retiro de producto de bodega
                </a>
            </div>
        @endcan
    </div>
    @if ($error)
        <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500 mb-5">
            Las fecha inicial debe ser menor a la fecha final
        </div>
    @endif
    <div class="mt-8 md:flex md:flex-row md:space-x-4">
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
            <span>Usuario:</span>
            <input type="text"
                class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                placeholder="Buscar usuario" wire:model="usuario">
        </div>
        <div>
            <span>Producto:</span>
            <input type="text"
                class="appearance-none block w-full h-10 px-4 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
                placeholder="Buscar producto" wire:model="producto">
        </div>
    </div>
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Fecha</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Codigo</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Tipo</th>
                    @canany(['historial.edit', 'historial.destroy'])
                        <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                    @endcanany
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listaHistorial as $historial)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $historial->created_at }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $historial->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $historial->producto->codigo }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $historial->producto->nombreProducto }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ abs($historial->cantidad) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $historial->cantidad > 0 ? 'Ingreso' : 'Retiro' }}
                            </div>
                        </td>
                        @canany(['historial.edit', 'historial.destroy'])
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex item-center justify-center">
                                    @can('historial.edit')
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a href="{{ route('historial.edit', $historial) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="stroke-current text-green-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('historial.destroy')
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <a wire:click="$emit('historial',{{ $historial->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="stroke-current text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </div>
                                        <form id="delete-form-{{ $historial->id }}"
                                            action="/historial/{{ $historial->id }}" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    {{ $listaHistorial->links() }}
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('historial', historial => {

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
                        document.getElementById('delete-form-' + historial).submit();
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
