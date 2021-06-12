<div>
    <input type="text" class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" placeholder="Buscar" wire:model="search" type="search">
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Código</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Categoria</th>
                </tr>
            </thead>
            {{$fecha}}
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $producto)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{$producto->id}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{$producto->codigo}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{$producto->nombreProducto}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{$producto->stock}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{$producto->categoria != null ? $producto->categoria->nombreCategoria:'Sin categoria'}}
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    {{ $productos->links() }}
</div>
