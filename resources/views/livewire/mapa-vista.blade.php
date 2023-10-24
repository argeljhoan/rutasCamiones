<div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h1><strong>Ruta del Vehiculo: </strong> {{ $matricula }}</h1>
        </x-slot>

        <x-slot name="content">
            <div id="mapaModal" class="mapaModal">

            </div>
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>

    <div class="px-4 py-4">
        <x-input class="w-full" placeholder="Buscar por Matricula, Marca o Nombre del Conductor" type="text"
            wire:model='searchRutas'> </x-input>
    </div>


    @if ($camiones->isEmpty())

        <div class=" alert alert-info mt-3">
            No Existen Vehiculos con esa Informacion.
        </div>
    @else
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">


                <div class="table-responsive">

                    <table class="mt-3 table border-primary table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Id</th>
                                <th>Matrícula</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Conductor</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>Ver Ruta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($camiones as $camion)
                                <tr>
                                    <td>{{ $camion->id }}</td>
                                    <td>{{ $camion->matricula }}</td>
                                    <td>{{ $camion->tipo_camion->name }}</td>
                                    <td>{{ $camion->marca }}</td>
                                    <td>{{ $camion->modelo }}</td>
                                    <td>{{ $camion->color->name }}</td>
                                    <td>{{ $camion->conductor->name }}</td>
                                    @if (!$camion->mapas->isEmpty())
                                        @foreach ($camion->mapas as $mapa)
                                            <td>{{ $mapa->latitud }}</td>
                                            <td>{{ $mapa->longitud }}</td>
                                        @endforeach
                                    @else
                                        <td>-------------</td>
                                        <td>-------------</td>
                                    @endif
                                    <td><button class="btn btn-primary"
                                            wire:click="modal({{ $camion }}) ">Ver</button></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $camiones->links() }}
                </div>






            </div>


        </div>
    @endif

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
    <script src="{{ asset('js/mapsRutas.js') }}"></script>

    <script>
        window.intervalId = '';

        function detenerIntervalo() {
            clearInterval(intervalId);

        }

        window.onload = function() {


            Livewire.on('abrirModal', (camion, coordenadas, codigo) => {
                window.codigo = [];

                console.log(coordenadas, 'coordenadas de las rutas por camion');

                for (const coordenada of coordenadas) {

                    console.log(coordenada)

                    window.codigo.push({ // Agrega el objeto al array
                        'lat': coordenada.latitud,
                        'long': coordenada.longitud,
                        'codigo': codigo
                    });


                }


                detenerIntervalo();
                setTimeout(function() {
                    initMapGestion()

                }, 2000);

                window.intervalId = setInterval(function() {
                    console.log('ajaxRutas');
                    var rutaCoordenadas = "{{ URL::route('Rutas.Coordenadas', ':camion') }}";
                    rutaCoordenadas = rutaCoordenadas.replace(':camion', camion.id);
                    // var rutaCoordenadas = "{{ URL::route('Rutas.Camion', $camion) }}";
                    $.ajax({
                        type: 'GET',
                        url: rutaCoordenadas,
                        success: function(response) {
                            console.log(response);
                            window.codigo = [];
                            for (const coordenada of response) {

                                console.log(coordenada,'ajax');

                                window.codigo.push({ // Agrega el objeto al array
                                    'lat': coordenada.latitud,
                                    'long': coordenada.longitud,
                                    'codigo': coordenada.camion.color.codigo
                                });


                            }

                            MarcadoresRutas()

                            // Puedes procesar los datos recibidos y actualizar tu página web
                        },
                        error: function(xhr, status, error) {
                            // Maneja cualquier error que ocurra durante la consulta
                            console.log('Error:', error);
                        }
                    });

                }, 60000);




            });

        }
    </script>
</div>
