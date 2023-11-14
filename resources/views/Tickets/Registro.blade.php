<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion de Tickets') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Registro de Tickets') }}</div>
                        <div class="card-body">
                            <form class="mt-3" method="POST" action="{{ route('Tickets.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">

                                    <label for="radicado"
                                        class="col-md-3 col-form-label text-md-start">{{ __('# Radicado') }}</label>
                                    <div class="col-md-8">
                                        <input id="radicado" type="text"
                                            class="form-control @error('radicado') is-invalid @enderror" name="radicado"
                                            value="{{ old('radicado') }}" required autocomplete="radicado" autofocus>
                                        @error('radicado')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fecha"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Fecha') }}</label>
                                    <div class="col-md-8">
                                        <input id="fecha" type="date"
                                            class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                            value="{{ old('fecha') }}" required autocomplete="fecha">
                                        @error('fecha')
                                            fecha
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="hora"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Hora') }}</label>
                                    <div class="col-md-8">
                                        <input id="hora" type="time"
                                            class="form-control @error('hora') is-invalid @enderror" name="hora"
                                            value="{{ old('hora') }}" required autocomplete="hora">
                                        @error('hora')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="procedencia"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Procedencia(Mina)') }}</label>

                                    <div class="col-md-8">
                                        <input id="procedencia" type="text"
                                            class="form-control @error('procedencia') is-invalid @enderror"
                                            name="procedencia" value="{{ old('procedencia') }}" required
                                            autocomplete="procedencia">

                                        @error('procedencia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="destino"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Destino') }}</label>

                                    <div class="col-md-8">
                                        <input id="destino" type="text"
                                            class="form-control @error('destino') is-invalid @enderror" name="destino"
                                            value="{{ old('destino') }}" required autocomplete="destino">

                                        @error('destino')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="despachador"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Nombre del despachador') }}</label>

                                    <div class="col-md-8">
                                        <input id="despachador" type="text"
                                            class="form-control @error('despachador') is-invalid @enderror"
                                            name="despachador" value="{{ old('despachador') }}" required
                                            autocomplete="despachador">

                                        @error('despachador')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="conductor"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Conductor') }}</label>

                                    <div class="col-md-8">
                                        <select class="form-select" name="conductor" id="conductor" required>
                                            <option value="">Seleccione un Conductor</option>
                                            @foreach ($conductores as $conductor)
                                                <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">

                                    <label for="pesoTara"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Peso Tara') }}</label>
                                    <div class="col-md-8">
                                        <input id="pesoTara" type="text"
                                            class="form-control @error('pesoTara') is-invalid @enderror"
                                            name="pesoTara" value="{{ old('pesoTara') }}" required
                                            autocomplete="pesoTara" autofocus>
                                        @error('pesoTara')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="pesoBruto"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Peso Bruto') }}</label>
                                    <div class="col-md-8">
                                        <input id="pesoBruto" type="text"
                                            class="form-control @error('pesoBruto') is-invalid @enderror"
                                            name="pesoBruto" value="{{ old('pesoBruto') }}" required
                                            autocomplete="pesoBruto" autofocus>
                                        @error('pesoBruto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="pesoNeto"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Peso Neto') }}</label>
                                    <div class="col-md-8">
                                        <input id="pesoNeto" type="text"
                                            class="form-control @error('pesoNeto') is-invalid @enderror"
                                            name="pesoNeto" value="{{ old('pesoNeto') }}" required
                                            autocomplete="pesoNeto" autofocus>
                                        @error('pesoNeto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="recibido"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Recibido Por') }}</label>
                                    <div class="col-md-8">
                                        <input id="recibido" type="text"
                                            class="form-control @error('recibido') is-invalid @enderror"
                                            name="recibido" value="{{ old('recibido') }}" required
                                            autocomplete="recibido" autofocus>
                                        @error('recibido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="foto"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Foto de Tickect') }}</label>
                                    <div class="form-group col-md-8">
                                        <label for="archivo" class="btn btn-success">
                                            <span id="nombre-archivo">Seleccionar</span>
                                            <input type="file" id="archivo" name="archivo" accept="image/*"
                                                style="display: none;" onchange="actualizarNombreArchivo(this)">
                                            <input id="foto" type="hidden" name="fotonombre">
                                        </label>
                                    </div>
                                </div>

                                {{-- <div>
                                <img src="{{ asset('/img/WhatsApp Image 2023-06-25 at 11.09.09 AM.jpeg') }}" alt="Descripción de la imagen">
                            </div> --}}

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


                                <div class="mt-5 row mb-0 text-md-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button class="btn btn-primary">Registrar</button>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
