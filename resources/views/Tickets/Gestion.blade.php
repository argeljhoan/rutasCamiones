<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickest') }}
        </h2>
    </x-slot>

    <div class="mt-5">

        <div style="display: flex; flex-direction: column; align-items: flex-end; width:90%; margin:auto;">

            <a class="btn btn-primary "
                style="font-size: 14px; width: 170px; display: flex ;flex-direction: row ;gap:10px; align-items: center;"
                href="{{ route('Tickets.Registro') }} ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z">
                </path><path d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"></path></svg> Nuevo Tickets
            </a>

        </div>
        
        <!-- Aquí va tu código existente cuando $camion está definido -->
        <!-- ... -->
        @if ($tickets->isEmpty())
        <div class="alert alert-info mt-3">
            No hay Tickets registrados.
        </div>
       @else
        <div class="table-responsive ">
            <table class="mt-3 table  border-primary table-hover"style="width:90%; margin:auto;"  >
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>hora Despacho</th>
                        <th>fecha </th>
                        <th>Procedencia(Mina)</th>
                        <th>Destino</th>
                        <th>Despachador</th>
                        <th>Placa del Vehiculo</th>
                        <th>Conductor</th>
                        <th>Peso Bruto</th>
                        <th>Peso Tara</th>
                        <th>Peso Neto</th>
                        <th>Recibido Por</th>
                        


                    </tr>
                </thead>
                <tbody>
                    
                   @foreach($tickets as $ticket)
                        <tr>
                            <td class="activar">{{$ticket->id}} </td>
                            <td class="activar">{{$ticket->hora}} </td>
                            <td class="activar">{{$ticket->fecha}}</td>
                            <td class="activar">{{$ticket->procedencia}} </td>
                            <td class="activar">{{$ticket->destino}} </td>
                            <td class="activar">{{$ticket->despachador}} </td>
                            <td class="activar">{{$ticket->camion->matricula}}</td>
                            <td class="activar">{{$ticket->camion->conductor->name}}</td>
                            <td class="activar">{{$ticket->pesoBruto}}</td>
                            <td class="activar">{{$ticket->pesoTara}}</td>
                            <td class="activar">{{$ticket->pesoNeto}}</td>
                            <td class="activar">{{$ticket->recibido}}</td>
                            
                        </tr>

                </tbody>
            @endforeach
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



            @endif
    </div>
</x-app-layout>