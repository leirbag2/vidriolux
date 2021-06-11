<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('info'))
                    <div class="mt-8 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500">
                        {{session('info')}}
                    </div>
                    @endif
                    <div class="text-gray-500">               
                        @livewire('show-historial')
                        <!-- end table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>