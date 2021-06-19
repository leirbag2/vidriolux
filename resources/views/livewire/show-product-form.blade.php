<div>
    <input type="text"
        class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors"
        placeholder="Buscar" wire:model="search" type="search">
    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal font-bold">
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Código</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Producto</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Categoria</th>
                    @if (!$is_editing)
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Cantidad</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left uppercase tracking-wider">Acción</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $producto)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $producto->codigo }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $producto->nombreProducto }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $producto->stock }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $producto->categoria != null ? $producto->categoria->nombreCategoria : 'Sin categoria' }}
                            </div>
                        </td>
                        @if (!$is_editing)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <input value="1"
                                        class="appearance-none block border border-gray-200 rounded-lg h-10 px-4 w-20"
                                        required="required" type="number" name="cantidad" id="cantidad-{{$producto->id}}" min="1">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <select min="1"
                                        class="appearance-none block w-32 border border-gray-200 rounded-lg h-10 px-4"
                                        required="required" name="tipo" id="tipo-{{$producto->id}}">
                                        <option value="1">
                                            Ingreso</option>
                                        <option value="2">
                                            Retiro</option>
                                    </select>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="mt-0 text-center md:space-x-3 md:block flex flex-col-reverse">
                                    <a wire:click="$emit('add',{{ $producto->id }})"
                                        class="cursor-pointer mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm
                                shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Guardar
                                    </a>
                                </div>
                                <form action="{{route('historial.store')}}" id="add-form-{{ $producto->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="add-{{ $producto->id }}" name="cantidad" value="">
                                    <input type="hidden" id="form-tipo-{{ $producto->id }}" name="tipo" value="">
                                    <input type="hidden" name="id" value="{{ $producto->id }}">
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-table>
    @push('js')
        <script>
            Livewire.on('add', id => {
                var cantidad = document.getElementById('cantidad-' + id).value;
                var tipo = document.getElementById('tipo-' + id).value;
                document.getElementById('add-' + id).setAttribute("value", cantidad);
                document.getElementById('form-tipo-' + id).setAttribute("value", tipo);
                document.getElementById('add-form-' + id).submit();
            });

        </script>
    @endpush
    {{ $productos->links() }}
</div>
