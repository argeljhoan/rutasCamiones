<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion de Usuarios') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Registro de Usuarios') }}</div>
                    <div class="card-body">
                        <form  class="mt-3" method="POST" action="{{ route('Users.store') }}" enctype="multipart/form-data">
                            @csrf
        
                            <div class="row mb-3">

                                <label for="name" class="col-md-3 col-form-label text-md-start">{{ __('Nombres y Apellidos') }}</label>
                                 <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="Identificacion" class="col-md-3 col-form-label text-md-start">{{ __('Identificacion') }}</label>
                                <div class="col-md-8">
                                    <input id="Identificacion" type="number" class="form-control @error('Identificacion') is-invalid @enderror" name="Identificacion" value="{{ old('Identificacion') }}" required autocomplete="Identificacion">
                                    @error('Identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    <span class="invalid-feedback" role="alert">
                                            <strong>El campo de Identificación debe contener al menos 8 dígitos y no debe contener letras.</strong>
                                    </span>
                                  
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="row mb-3">
                                <label for="Telefono" class="col-md-3 col-form-label text-md-start">{{ __('Telefono') }}</label>
                                <div class="col-md-8">
                                    <input id="Telefono" type="number" class="form-control @error('Telefono') is-invalid @enderror" name="Telefono" value="{{ old('Telefono') }}" required autocomplete="Telefono">
                                    @error('Telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>El Campo de Telefono de ser un Numero real de Colombia.</strong>
                                        </span>
                                    @enderror
                                </div>
                           
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-3 col-form-label text-md-start">{{ __('Correo') }}</label>
    
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-3 col-form-label text-md-start">{{ __('Contraseña') }}</label>
    
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-start">{{ __('Confirmacion de Contraseña') }}</label>
    
                                <div class="col-md-8">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="rol" class="col-md-3 col-form-label text-md-start">{{ __('Rol') }}</label>
    
                                <div class="col-md-8">
                                  <select class="form-select" name="rol" id="rol" required>
                                    <option value="">Seleccione un Rol</option>
                                       @foreach ($roles as $rol)
                                     <option value="{{$rol->id}}">{{$rol->name}}</option>
                                   @endforeach 
                                    
                                  </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="foto" class="col-md-3 col-form-label text-md-start">{{ __('Foto de Perfil') }}</label>
                            <div class="form-group col-md-8">
                                <label for="archivo" class="btn btn-success">
                                    <span id="nombre-archivo">Seleccionar</span>
                                    <input type="file" id="archivo" name="archivo" accept="image/*" style="display: none;" onchange="actualizarNombreArchivo(this)">
                                    <input id="foto" type="hidden" name="fotonombre" >
                                </label>
                            </div>
                            </div>

                          {{--<div>
                                <img src="{{ asset('/img/WhatsApp Image 2023-06-25 at 11.09.09 AM.jpeg') }}" alt="Descripción de la imagen">
                            </div>--}}
                           
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
                                <button  class="btn btn-primary">Registrar</button>
                            </div>
                        </div>
                       
                        </form>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
