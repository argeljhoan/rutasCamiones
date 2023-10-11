<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}?v2">
    <link rel="stylesheet" href="{{ asset('css/AsignarVehiculo.css') }}?v2">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Vehículos') }}
        </h2>
    </x-slot>

    <div class="mt-5 container">
        <div style="display: flex; flex-direction: column; align-items: flex-end;">
            <a class="btn btn-primary"
                style="font-size: 14px; width: 170px; display: flex; flex-direction: row; gap: 10px; align-items: center;"
                href="{{ route('Vehiculos.Registro') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="fill: rgba(0, 0, 0, 1); transform: ; msFilter:;">
                    <path
                        d="m20.772 10.155-1.368-4.104A2.995 2.995 0 0 0 16.559 4H7.441a2.995 2.995 0 0 0-2.845 2.051l-1.368 4.104A2 2 0 0 0 2 12v5c0 .738.404 1.376 1 1.723V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2h12v2a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-2.277A1.99 1.99 0 0 0 22 17v-5a2 2 0 0 0-1.228-1.845zM7.441 6h9.117c.431 0 .813.274.949.684L18.613 10H5.387l1.105-3.316A1 1 0 0 1 7.441 6zM5.5 16a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 5.5 16zm13 0a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 18.5 16z">
                    </path>
                </svg> Nuevo Vehículo
            </a>
        </div>
        @php
            $idcamion = 0; // Define el valor inicial de idcamion
        @endphp
        <script>
            window.idcamion = {!! json_encode($idcamion) !!}; // Pasa la variable de Blade a JavaScript
        </script>
        @if ($camiones->isEmpty())
            <div class="alert alert-info mt-3">
                No hay vehículos registrados.
            </div>
        @else
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
                            <th>Estado</th>
                            <th>Asignar Conductor</th>
                            <th>Cambiar Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($camiones as $camion)
                            <tr>
                                <td class="activar">{{ $camion->id }}</td>
                                <td class="activar">{{ $camion->matricula }}</td>
                                <td class="activar">{{ $camion->tipo_camion->name }}</td>
                                <td class="activar">{{ $camion->marca }}</td>
                                <td class="activar">{{ $camion->modelo }}</td>
                                <td class="activar">{{ $camion->color }}</td>
                                @if (isset($camion->conductor))
                                    <td class="activar">{{ $camion->conductor->name }}</td>
                                @else
                                    <td>---------</td>
                                @endif

                                <td class="activar">{{ $camion->estado->name }}</td>
                                <td class="hidden" data-foto="{{ asset('img/' . $camion->profile_photo_path) }}">
                                    {{ $camion->profile_photo_path }}</td>
                                <td class="hidden" id="miVariable" data-camion="{{ $tipos }}"></td>
                                <td class="hidden" id="miEstados" data-estado="{{ $estados }}"></td>
                                <td class="hidden" id="miConductores" data-conductor="{{ json_encode($conductores) }}">
                                </td>
                                <td><button class="btn btn-primary" onclick="Asignar()">Asignar</button></td>
                                <td><button class="btn btn-primary" onclick="Cambiar()">Cambiar</button></td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (Session::has('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div id="error-message" class="alert alert-primary">
                    {{ Session::get('success') }}
                </div>
            @endif

            @foreach ($camiones as $camion)
                <div id="edit" class="editarContenedor hidden">
                    <div class="borderedit ">
                        <div class='text-end'>
                            <button class='btn-close' id="closeUserDetails" style="color: red;"></button>
                        </div>
                        <form id ="formeditar" class="mt-3" method="POST" data-action="{{ route('Vehiculos.Actualizar',$camion) }} "
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div id="editar" class="hidden"></div>
                        </form>
                    </div>
                </div>

                <div id="asignar" class="hidden">
                    <form id="formasignar" method="POST"   data-action="{{ route('Vehiculos.Asignar',$camion) }}" 
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div id="infoAsignar" class="hidden"></div>
                    </form>
                </div>


                <div id="cambiar" class="hidden">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div id="infoestado" class="hidden"></div>
                    </form>
                </div>
            @endforeach
            <script src="{{ asset('js/editarVehiculo.js') }}?v3"></script>
            <script src="{{ asset('js/AsignarVehiculo.js') }}?v4"></script>
            <script src="{{ asset('js/cambiarEstado.js') }}?v1"></script>

        @endif
    </div>

</x-app-layout>
