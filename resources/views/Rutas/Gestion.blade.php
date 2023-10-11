<x-maps>

{{-- @livewire('maps-contenedor') --}}
{{-- <x-maps-google :centerPoint="['lat' => 52.16, 'long' => 5]"></x-maps-google>  --}}
<x-slot name="header">
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Rutas') }}
  </h2>
</x-slot>
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    {{-- <x-maps-google :zoomLevel="2"></x-maps-google> --}}
    @livewire('mapa-vista',['latitud'=>'7.8939100','longitud'=>'-72.5078200'])
  </div>
</div>





</x-maps>
