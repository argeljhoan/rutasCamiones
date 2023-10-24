<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}?v3">
    <link rel="stylesheet" href="{{ asset('css/AsignarVehiculo.css') }}?v2">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Vehículos') }}
        </h2>
    </x-slot>

    @livewire('search-camiones')

   

</x-app-layout>
