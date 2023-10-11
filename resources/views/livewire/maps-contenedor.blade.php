<div>

    <div class="py-12">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <div class="dividir">
               

                @foreach ($coordenadas as $coordenada)
                    @php
                        $latitud = $coordenada->latitud;
                        $longitud = $coordenada->longitud;
                        
                    @endphp
                    <script>

                    
                        window.latitud = {!! json_encode($latitud) !!}; 
                        window.longitud = {!! json_encode($longitud) !!};
                      //  window.divMapas = document.getElementById("mapaactualizar");
                      
                    </script>
                  
                    <div id="mapaactualizar" class="mapa" >

                        
                    </div>
                @endforeach
                <div class="contenedorConductor">
                    @foreach ($camiones as $camion)
                        <a  class="info"  wire:click="showModal({{$camion}})">
                            <div class="divperfil">
                                <div class="">
                                    {{-- <img class="perfil" src={{ asset('img/' . $camion->conductor->profile_photo_path) }} alt=""> --}}
                                    <img class="perfil" src={{ asset('img/' . $camion->conductor->profile_photo_path) }}
                                        alt="">
                                </div>

                            </div>
                            <div class="conductor">
                                <h3>{{ $camion->conductor->name }}</h3>
                                <span><strong>Telefono: </strong>{{ $camion->conductor->telefono }} </span>
                                <span><strong>Ubicacion: </strong>ff </span>
                            </div>
                            <div class="estado">
                                <h2>Activo</h2>
                            </div>
                        </a>
                          
                    @endforeach
                </div>

            </div>

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

        <script src="{{ asset('js/maps.js') }}?v3"></script>
        <script>
            window.onload = function() {
                var tiempo = 1000;
                Livewire.on('abrirModal', (camion, lat,log) => {

                    window.latitud = lat;
                    window.longitud = log;
                    console.log(latitud);
                    console.log(longitud);


                    setTimeout(function() {
                        initMap();
                       
                    }, 2000);
        
                    setTimeout(function() {
                       Livewire.emit('showModal',camion);
                       
                    }, 60000); 
        
                   
                });
        
            }
        
        </script>
        <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug&callback=initMap&v=weekly">
        </script>
    </div>
   
</div>
