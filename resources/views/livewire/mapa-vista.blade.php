<div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">

            <h1>{{ $matricula }}</h1>
            <h1>{{ $latitudModal }}</h1>
            <h1>{{ $longitudModal }}</h1>
        </x-slot>

        <x-slot name="content">
            <div id="mapaModal" class="mapa">

            </div>
        </x-slot>

        <x-slot name="footer">
            <div>hola</div>
        </x-slot>
    </x-dialog-modal>


</div>
{{-- //<script src="{{ asset('js/MapsModal.js')}}?v1"></script> --}}
<script>
    window.onload = function() {
        var tiempo = 1000;
        Livewire.on('abrirModal', (camion, coordenadas) => {

            setTimeout(function() {
                initMap();
               
            }, 2000);

            setTimeout(function() {
               Livewire.emit('showModal',camion);
               
            }, 60000); 

           
        });

    }

</script>
{{-- <script async
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug&callback=initMap&v=weekly">
</script> --}}
