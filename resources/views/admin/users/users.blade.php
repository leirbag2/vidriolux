<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl text-center">
                        Administración de usuarios
                    </div>
                    @if (isset($_GET['error']) && $_GET['error']=='user_exists')
                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-red-500">
                        El rut, correo o celular ya se encuentra registrado
                    </div>
                    @endif
                    @if (isset($_GET['ok']) && $_GET['ok']=='create')
                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500">
                        Usuario creado correctamente
                    </div>
                    @endif
                    @if (isset($_GET['ok']) && $_GET['ok']=='update')
                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500">
                        Usuario modificado correctamente
                    </div>
                    @endif
                    @if (isset($_GET['ok']) && $_GET['ok']=='delete')
                    <div class="mt-8 focus:outline-none text-red-500 border border-red-500 text-sm py-2.5 px-5 rounded-md">
                        Usuario eliminado correctamente
                    </div>
                    @endif
                    <div class="mt-8">
                        <a href="/usuarios/create" type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Agregar usuario</a>
                    </div>
                    <div class="mt-6 text-gray-500">
                        @if ($cantidad >= 1)
                        <div class="w-full">
                            @livewire('show-users')
                        </div>
                        <span>Cantidad de usuarios: {{ $cantidad }}</span>
                        <!-- end table -->
                        @else
                        <h1>¡No hay usuarios!</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
