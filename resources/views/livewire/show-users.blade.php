<div>
    <div class="flex relative mt-1">
        <div class="flex-none mr-10">
            <a href="/usuarios/create" type="button"
                class="focus:outline-none text-white text-sm py-3 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Agregar
                usuario</a>
        </div>

        <input type="text" id="password"
            class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
            placeholder="Buscar" wire:model="search" type="search">
    </div>
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Correo</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Tipo</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-3 text-center uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($lista as $user)
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
                                {{ $user->tipo->descripcionTipo }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $user->estado->descripcionEstado }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex item-center justify-center">
                                <!--div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </div-->
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="/usuarios/{{ $user->id }}/edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="/usuarios/{{ $user->id }}/delete"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                                <form id="delete-form-{{ $user->id }}" action="/usuarios/{{ $user->id }}"
                                    method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    {{ $lista->links() }}
</div>
