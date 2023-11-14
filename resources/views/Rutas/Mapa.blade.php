<x-maps>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapa') }}
        </h2>
    </x-slot>

    @livewire('maps-contenedor', ['coordenadas' => $coordenadas, 'camiones' => $camiones])



    <script></script>



</x-maps>
