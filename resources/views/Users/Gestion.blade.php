<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/ventana.css') }}?v6">
    <link rel="stylesheet" href="{{ asset('css/ventanaEliminar.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion de Usuarios') }}
        </h2>
    </x-slot>

     @livewire('search-user')
     {{-- , ['users' =>$users] --}}
    <script src="{{ asset('js/ventana.js') }}?v7"></script>
    <script src="{{ asset('js/InformacionInhabilitar.js') }}?v1"></script>
   
</x-app-layout>
