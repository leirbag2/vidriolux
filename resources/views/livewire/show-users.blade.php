<div>
    <div class="flex relative mt-1">
        @can('usuarios.create')
            <div class="flex-none mr-10">
                <a href="/usuarios/create" type="button"
                    class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">
                    Agregar usuario
                </a>
            </div>
        @endcan
        <input type="text"
            class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
            placeholder="Buscar" wire:model="search" type="search">
    </div>
    @if ($users->count() > 0)
        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Correo</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Tipo de usuario</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Estado</th>
                        @canany(['usuarios.edit', 'usuarios.destroy'])
                            <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ count($user->getRoleNames()) > 0 ? $user->getRoleNames()[0] : 'Sin asignar' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->estado->descripcionEstado }}
                                </div>
                            </td>
                            @can('usuarios.edit')
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex item-center justify-center">
                                        @can('usuarios.edit')
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{ route('usuarios.edit', $user) }}">
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
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-table>
        {{ $users->links() }}
    @else
        <h2 class="mt-4 font-bold">¡No hay resultados!</h2>
    @endif
</div>
