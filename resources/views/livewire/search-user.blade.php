<div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            @can('Users.Registro')
                <div style="display: flex; flex-direction: column; align-items: flex-end;">

                    <a class="btn btn-primary "
                        style=" font-size: 14px; width: 160px; display: flex ;flex-direction: row ;gap:1rem"
                        href="{{ route('Users.Registro') }} ">
                        <svg style=" fill: rgba(0, 0, 0, 1); margin: auto" xmlns="http://www.w3.org/2000/svg" width="25"
                            height="25" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                            <path
                                d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />

                        </svg>Nuevo Usuario
                    </a>



                </div>
            @endcan
            <div class="px-4 py-4">
                <x-input class="w-full" placeholder="Buscar por Nombre, Identificacion o Rol" type="text"
                    wire:model='searchUser'> </x-input>
            </div>

            @if ($users->isEmpty())
                <div class="alert alert-info mt-3">
                    No hay Usuarios registrados.
                </div>
            @else
                <div class="table-responsive">




                    <table class=" mt-3 table  border-primary table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Identificacion</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Rol</th>

                                @can('Users.Editar')
                                    <th class="no-activar">Editar</th>
                                @endcan
                                @can('Users.Destroy')
                                    <th class="no-activar">Inhabilitar</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="activar">{{ $user->id }} </td>
                                    <td class="activar">{{ $user->name }} </td>
                                    <td class="activar">{{ $user->identificacion }} </td>
                                    <td class="activar">{{ $user->telefono }} </td>
                                    <td class="activar">{{ $user->email }} </td>
                                    @foreach ($user->roles as $role)
                                        <td class="activar">{{ $role->name }} </td>
                                    @endforeach

                                    <td class="hidden" data-foto="{{ asset('img/' . $user->profile_photo_path) }}">
                                    </td>
                                    @can('Users.Editar')
                                        <td>
                                            <div class="button">

                                                <a class="btn btn-warning" href="{{ route('Users.Editar', $user) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-arrow-clockwise"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                        <path
                                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                    </svg>
                                                </a>

                                            </div>
                                        </td>
                                    @endcan
                                    @can('Users.Destroy')
                                        <td>

                                            <div class="button">

                                                <a class="btn" style="background-color:#fa3841"
                                                    href="javascript:void(0);" onclick="mostrarVentanaEmergente()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24"
                                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                        <path
                                                            d="M12 19c.946 0 1.81-.103 2.598-.281l-1.757-1.757c-.273.021-.55.038-.841.038-5.351 0-7.424-3.846-7.926-5a8.642 8.642 0 0 1 1.508-2.297L4.184 8.305c-1.538 1.667-2.121 3.346-2.132 3.379a.994.994 0 0 0 0 .633C2.073 12.383 4.367 19 12 19zm0-14c-1.837 0-3.346.396-4.604.981L3.707 2.293 2.293 3.707l18 18 1.414-1.414-3.319-3.319c2.614-1.951 3.547-4.615 3.561-4.657a.994.994 0 0 0 0-.633C21.927 11.617 19.633 5 12 5zm4.972 10.558-2.28-2.28c.19-.39.308-.819.308-1.278 0-1.641-1.359-3-3-3-.459 0-.888.118-1.277.309L8.915 7.501A9.26 9.26 0 0 1 12 7c5.351 0 7.424 3.846 7.926 5-.302.692-1.166 2.342-2.954 3.558z">
                                                        </path>
                                                    </svg>
                                                </a>

                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                        </tbody>
            @endforeach
            </table>
        </div>
        {{ $users->links() }}
    </div>
    <div id="info" class="hidden">





    </div>
    @foreach ($users as $user)
        <div id="principal" class="hidden">
            <form action="{{ route('Users.Destroy', $user) }}" method="POST">
                @csrf
                @method('delete')
                <div id="ventanaEliminar" class="hidden">
                    <!-- Contenido que deseas mostrar en la ventana emergente -->
                    <p>Información de la tabla aquí</p>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endif

</div>


</div>
