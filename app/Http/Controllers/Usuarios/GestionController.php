<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUsers;
use App\Models\Model_has_role;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id_acceso',1)->with('roles')->paginate(15);
       
        
        return view('Users.Gestion',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role ::all();

  
        return view('Users.Registro',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $password = $request->password;
        $users = User::all();
        $rolnombre = Role::where('id',$request->rol)->first();
       
        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                return redirect()->back()->withInput()->withErrors(['password' => 'La contraseña corresponde a otro usuario']);
            }
        }
 
    $rutaDestino = public_path('img/'); // Esto crea la ruta completa a la carpeta public/img
    $nombreArchivo = $request->file('archivo')->getClientOriginalName();
    //http://localhost/gestionRutas/public/img/WhatsApp.jpeg
      
    
      

       // Mover el archivo a la carpeta de destino
       $request->file('archivo')->move($rutaDestino, $nombreArchivo);
       $rutacompleta = $rutaDestino . $nombreArchivo;

       
       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'profile_photo_path'=> $nombreArchivo,
        'identificacion' => $request->Identificacion,
        'telefono' => $request->Telefono,
        'id_acceso' => 1,
        'id_asignacion' => 2
       ])->assignRole($rolnombre->name);


       Session::flash('success', 'El Usuario se Registro exitosamente');
       return $this->index();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         $roles = Role ::all();
         $rolactual = Model_has_role::where('model_id', $user->id)
        ->with('role')
        ->first();

        $rol =$rolactual->role->name;


        return view('Users.Editar', compact('user','roles','rol'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsers $request, User $user)
    {
  
        if($request->rol){
           
            $rolnombre = Role::where('id',$request->rol)->first();
            $name = $rolnombre->name;
            $user->syncRoles([$name]);
           
        
        }

        if($request->fotonombre == null){
         
        $nombreArchivo = $user ->profile_photo_path;
           
        }else{

            $rutaDestino = public_path('img/'); 
            $nombreArchivo = $request->file('archivo')->getClientOriginalName();
            $request->file('archivo')->move($rutaDestino, $nombreArchivo);
              
        }
       
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_photo_path' => $nombreArchivo,
            'identificacion' => $request->Identificacion,
            'telefono' => $request->Telefono,
            'id_acceso' => 1
        ]);

        Session::flash('success', 'El Usuario se Actualizo exitosamente');
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function destroy( User $user)
    {


        $user->update([
        'id_acceso' => 2
        ]);

        return redirect()->route('Users.Gestion');
    }
}
