<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickest') }}
        </h2>
    </x-slot>

   @livewire('search-tickets')
</x-app-layout>
