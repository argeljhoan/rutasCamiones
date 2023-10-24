<div>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <div class="dividir">


                @foreach ($coordenadas as $coordenada)
                    @php
                        $latitud = $coordenada->latitud;
                        $longitud = $coordenada->longitud;
                        $codigoCamion = [];
                    @endphp
                    <script>
                        window.latitud = {!! json_encode($latitud) !!};
                        window.longitud = {!! json_encode($longitud) !!};

                        //  window.divMapas = document.getElementById("mapaactualizar");
                    </script>

                    <div id="mapaactualizar" class="mapa">


                    </div>
                @endforeach
                <div class="contenedorConductor">
                    @foreach ($camiones as $camion)
                        @php

                            // Inicializa el arreglo fuera del bucle

                            foreach ($camion->mapas as $mapa) {
                                $codigoCamion[] = [
                                    'lat' => $mapa->latitud,
                                    'long' => $mapa->longitud,
                                    'codigo' => $camion->color->codigo,
                                ];
                            }

                        @endphp

                        @if (!empty($codigoCamion))
                            <script>
                                window.codigo = [];


                                codigo = codigo.concat(@json($codigoCamion));
                                console.log(codigo)
                            </script>
                        @endif


                        <a class="info" wire:click="showModal({{ $camion }})">
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

                                @php
                                    foreach ($camion->mapas as $mapa) {
                                        if ($mapa->estadoLaboral == 'inactivo') {
                                            $estadoLaboral = '#EF1B0D';
                                            $info = $mapa->estadoLaboral;
                                        } else {
                                            $estadoLaboral = '#28B463';
                                            $info = $mapa->estadoLaboral;
                                        }
                                    }

                                @endphp
                              
                            
                                <h2>{{ $info }}</h2>
                                
                                <div>
                                    <div class="circulo" style="background-color:{{ $estadoLaboral }}"></div>
                                </div>
                             
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>

            <x-dialog-modal wire:model="open">
                <x-slot name="title">

                    <table class="table border-primary table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Id</th>
                                <th>Matrícula</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Conductor</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $idcamion }}</td>
                                <td>{{ $matricula }}</td>
                                <td>{{ $tipo }}</td>
                                <td>{{ $marca }}</td>
                                <td>{{ $modelo }}</td>
                                <td>{{ $color }}</td>
                                <td>{{ $nombreconductor }}</td>
                            </tr>
                        </tbody>
                    </table>


                </x-slot>

                <x-slot name="content">
                    <div id="mapaModal" class="mapaModal">

                    </div>
                </x-slot>

                <x-slot name="footer">

                </x-slot>
            </x-dialog-modal>

        </div>
        <script>
            (g => {
                var h, a, k, p = "The Google Maps JavaScript API",
                    c = "google",
                    l = "importLibrary",
                    q = "__ib__",
                    m = document,
                    b = window;
                b = b[c] || (b[c] = {});
                var d = b.maps || (b.maps = {}),
                    r = new Set,
                    e = new URLSearchParams,
                    u = () => h || (h = new Promise(async (f, n) => {
                        await (a = m.createElement("script"));
                        e.set("libraries", [...r] + "");
                        for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                        e.set("callback", c + ".maps." + q);
                        a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                        d[q] = f;
                        a.onerror = () => h = n(Error(p + " could not load."));
                        a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                        m.head.append(a)
                    }));
                d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                    d[l](f, ...n))
            })
            ({
                key: "AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug",
                v: "beta"
            });
        </script>
        <script src="{{ asset('js/maps.js') }}?v8"></script>
        <script>
            window.intervalId = '';
            window.intervalGestion = '';

            function detenerIntervalo() {
                clearInterval(intervalId);
                
            }





            window.onload = function() {
                Livewire.emit('MapaCamiones');

                Livewire.on('abrirModal', (camion, lat, log, codigo) => {

                    window.latitud = lat;
                    window.longitud = log;
                    window.codigo = codigo;
                    console.log(latitud);
                    console.log(longitud);
                    console.log(codigo);
                    console.log(camion);

                    detenerIntervalo();
                    setTimeout(function() {
                        initMap();
                        initMapGestion()

                    }, 2000);

                    window.intervalId = setInterval(function() {
                        console.log('ajaxIndividual');
                        var rutaCoordenadas = "{{ URL::route('Rutas.Camion', ':camion') }}";
                        rutaCoordenadas = rutaCoordenadas.replace(':camion', camion.id);
                        // var rutaCoordenadas = "{{ URL::route('Rutas.Camion', $camion) }}";
                        $.ajax({
                            type: 'GET',
                            url: rutaCoordenadas,
                            success: function(response) {
                                console.log(response);
                                for (const camion of response.mapas) {

                                    window.latitud = camion.latitud;
                                    window.longitud = camion.longitud;
                                    window.codigo = response.color.codigo;

                                }


                                MarcadoresIndividual();

                                // Puedes procesar los datos recibidos y actualizar tu página web
                            },
                            error: function(xhr, status, error) {
                                // Maneja cualquier error que ocurra durante la consulta
                                console.log('Error:', error);
                            }
                        });

                    }, 60000);




                });


                Livewire.on('mapaRefresh', (camiones) => {

                      clearInterval(intervalGestion);
                    console.log('entrar')

                    let milisegundos1;
                    let milisegundos2;
                    let numerosFechasCamion;
                    let numerosFechasConductor;
                    window.codigo = [];
                    let CamionesAntiguos = [];
                    let ConductoresAntiguos = [];
                    let estados = [];
                    let CamionesNuevos;
                    let ConductoresNuevos;
                    // Inicializa un array vacío

                    for (const camion of camiones) {
                        for (const coordenadas of camion.mapas) {


                            estados.push(coordenadas.estadoLaboral)
                            window.codigo.push({ // Agrega el objeto al array
                                'lat': coordenadas.latitud,
                                'long': coordenadas.longitud,
                                'codigo': camion.color.codigo
                            });
                        }
                        milisegundos1 = new Date(camion.updated_at).getTime();
                        milisegundos2 = new Date(camion.conductor.updated_at).getTime();

                        CamionesAntiguos.push(milisegundos1);
                        ConductoresAntiguos.push(milisegundos2);


                    }

                    setTimeout(function() {

                        initMapGestion()

                    }, 2000);

                   window.intervalGestion = setInterval(function() {

                        
                        console.log('ajax');
                        var rutaCoordenadas = "{{ URL::route('Rutas.Coordenadas') }}";
                        $.ajax({
                            type: 'GET',
                            url: rutaCoordenadas,
                            success: function(response) {
                                // Maneja la respuesta del servidor aquí
                                window.codigo = [];
                                estadosNuevos = [];
                                // Inicializa un array vacío

                                for (const camion of response) {
                                    for (const coordenadas of camion.mapas) {
                                        estadosNuevos.push(coordenadas.estadoLaboral)
                                        window.codigo.push({ // Agrega el objeto al array
                                            'idcamion': camion.id,
                                            'lat': coordenadas.latitud,
                                            'long': coordenadas.longitud,
                                            'codigo': camion.color.codigo
                                        });
                                    }

                                }


                                console.log(CamionesAntiguos);

                                for (const index in response) {


                                 camionesNuevos = new Date(response[index].updated_at).getTime();
                                conductoresNuevos = new Date(response[index].conductor.updated_at).getTime();;


                                    console.log('NuevoCamion',camionesNuevos)
                                    console.log('CamionAntig',CamionesAntiguos[index])

                                    if (camionesNuevos > CamionesAntiguos[index]) {
                                         
                                        console.log(camionesNuevos)
                                        console.log(CamionesAntiguos[index])
                                      //  CamionesAntiguos[index] = camionesNuevos                                  
                                        console.log(response[index].matricula)
                                        Livewire.emit('MapaCamiones');
                                    } else {

                                        if (conductoresNuevos > ConductoresAntiguos[index]) {
                                            //  Livewire.emit('MapaCamiones');
                                            console.log(ConductoresAntiguos[index])
                                            console.log(response[index].conductor.name)
                                            Livewire.emit('MapaCamiones');
                                        } else {

                                            if (estados[index] != estadosNuevos[index]) {
                                                //  Livewire.emit('MapaCamiones');
                                                console.log(estadosNuevos[index])
                                                console.log(response[index].matricula)
                                                Livewire.emit('MapaCamiones');

                                            }


                                        }



                                    }




                                }







                                // console.log(window.codigo);
                                Marcadores();

                                // Puedes procesar los datos recibidos y actualizar tu página web
                            },
                            error: function(xhr, status, error) {
                                // Maneja cualquier error que ocurra durante la consulta
                                console.log('Error:', error);
                            }
                        });



                    }, 30000);


                });

            }
        </script>
        {{-- <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug&callback=initMap&v=weekly">
        </script> --}}

        {{-- <script>(g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })
            ({ key: "AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug", v: "beta" });</script>   --}}
    </div>

</div>
