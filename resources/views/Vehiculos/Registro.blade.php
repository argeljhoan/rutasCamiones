<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion de Vehiculos') }}
        </h2>
    </x-slot>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Registro de Vehiculos') }}</div>
                        <div class="card-body">
                            <form class="mt-3" method="POST" action="{{ route('Vehiculos.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">

                                    <label for="matricula"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Matricula') }}</label>
                                    <div class="col-md-8">
                                        <input id="matricula" type="text"
                                            class="form-control @error('matricula') is-invalid @enderror"
                                            name="matricula" value="{{ old('matricula') }}" required
                                            autocomplete="matricula" autofocus>
                                        @error('matricula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Marca"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Marca') }}</label>
                                    <div class="col-md-8">
                                        <input id="Marca" type="text"
                                            class="form-control @error('Marca') is-invalid @enderror" name="Marca"
                                            value="{{ old('Marca') }}" required autocomplete="Marca">
                                        @error('Marca')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="modelo"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Modelo') }}</label>
                                    <div class="col-md-8">
                                        <input id="modelo" type="text"
                                            class="form-control @error('modelo') is-invalid @enderror" name="modelo"
                                            value="{{ old('modelo') }}" required autocomplete="modelo">
                                        @error('modelo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>






                                <div class="row mb-3">
                                    <label for="color"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Color Vehiculo') }}</label>

                                    <div class="col-md-8">
                                        <select class="form-select" name="color" id="color" required>
                                            <option value="">Seleccione un Color</option>
                                            @foreach ($colores as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="tipo"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Tipo') }}</label>

                                    <div class="col-md-8">
                                        <select class="form-select" name="tipo" id="tipo" required>
                                            <option value="">Seleccione un Tipo</option>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>





                                <div class="row mb-3">
                                    <label for="foto"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Foto del Vehiculo') }}</label>
                                    <div class="form-group col-md-8">
                                        <label for="archivo" class="btn btn-success">
                                            <span id="nombre-archivo">Seleccionar</span>
                                            <input type="file" id="archivo" name="archivo" accept="image/*"
                                                style="display: none;" onchange="actualizarNombreArchivo(this)">
                                            <input id="foto" type="hidden" name="foto">
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
