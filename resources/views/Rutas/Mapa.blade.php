<x-maps>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapa') }}
        </h2>
    </x-slot>

    @livewire('maps-contenedor', ['coordenadas' => $coordenadas, 'camiones' => $camiones])



    <script>
        // var count = 0;
        // setInterval(function() {
        //     Livewire.emit('actualizarCoordenadas');
        //     count++;
        //     // console.log(count);
        //     console.log('emitir')
        // }, 9000);



        // window.onload = function() {
        //     Livewire.on('CoordenadasActualizadas', (lat, log) => {

        //         console.log(lat ," ", log);

        //     });
        // }
    </script>



</x-maps>
