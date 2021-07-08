<div>
    <div class="flex relative mt-1">
        @can('categorias.create')
            <div class="flex-none mr-10">
                <a href="/categorias/create" type="button"
                    class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                    Agregar categoria
                </a>
            </div>
        @endcan
        <input type="text"
            class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
            placeholder="Buscar" wire:model="search" type="search">
    </div>
    @if ($categorias->count() > 0)
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Id</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Categoria</th>
                        @canany(['categorias.edit', 'categorias.destroy'])
                            <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($categorias as $categoria)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $categoria->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $categoria->nombreCategoria }}
                                </div>
                            </td>

                            @canany(['categorias.edit', 'categorias.destroy'])

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex item-center justify-center">

                                        @can('categorias.edit')
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ route('categorias.edit', $categoria) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="stroke-current text-green-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('categorias.destroy')
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a wire:click="$emit('deleteCategoria',{{ $categoria->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="stroke-current text-red-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <form id="delete-form-{{ $categoria->id }}"
                                                action="/categorias/{{ $categoria->id }}" method="POST">
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
        {{ $categorias->links() }}
    @else
        <h2 class="mt-4 font-bold">¡No hay resultados!</h2>
    @endif
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deleteCategoria', categoriaId => {

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
                        document.getElementById('delete-form-' + categoriaId).submit();
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
