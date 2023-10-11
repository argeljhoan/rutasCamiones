<?php

namespace App\Http\Controllers\Vehiculos;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculo;
use App\Http\Requests\UpdatedVehiculo;
use App\Models\Camiones;
use App\Models\Conductores_Camiones;
use App\Models\Estado;
use App\Models\Model_has_role;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class VehiculoGestionController extends Controller
{
    private $conductores = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {

        $camiones = Camiones::with('estado', 'tipo_camion','conductor')->get();

        $tipos = Tipo::all();                                               
        $nombreDelRol = 'Conductor';



        $results = Model_has_role::whereHas('role', function ($query) use ($nombreDelRol) {

            $query->where('name', $nombreDelRol);

        })->get();                    

        foreach ($results as $result) {
            $user = User::where('id', $result->model_id)
            ->where('id_asignacion', 2)->get(); // Cambiar "first" a "get" si esperas múltiples resultados por cada iteración
            if ($user) {
                $this->conductores[] = $user;
            }
           
        }

        $conductores = $this->conductores;

        $estados = Estado::all();

        
        return view('Vehiculos.Gestion', compact('camiones', 'tipos','conductores','estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $tipos = Tipo::all();
        // $estados = Tipo::all();
        return view('Vehiculos.Registro', compact('tipos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiculo $request)
    {


        $rutaDestino = public_path('img/'); // Esto crea la ruta completa a la carpeta public/img
        $nombreArchivo = $request->file('archivo')->getClientOriginalName();
        $request->file('archivo')->move($rutaDestino, $nombreArchivo);


        $camion = Camiones::create([
            'profile_photo_path' => $nombreArchivo,
            'marca' => $request->Marca,
            'modelo' => $request->modelo,
            'color' => $request->color,
            'matricula' => $request->matricula,
            'id_estado' => 1,
            'id_tipo' => $request->tipo

        ]);


        Session::flash('success', 'El Vehiculo se Registro exitosamente');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedVehiculo $request, Camiones $camion)
    {

        if (is_null($request->tipo)) {

            $idTipo = $camion->id_tipo;
        } else {
            $idTipo = $request->tipo;
        }

        if ($request->foto == null) {

            $nombreArchivo = $camion->profile_photo_path;
        } else {

            $rutaDestino = public_path('img/');
            $nombreArchivo = $request->file('archivo')->getClientOriginalName();
            $request->file('archivo')->move($rutaDestino, $nombreArchivo);
        }

        $camion->update([
            'profile_photo_path' => $nombreArchivo,
            'marca' => $request->Marca,
            'modelo' => $request->modelo,
            'color' => $request->color,
            'matricula' => $request->matricula,
            'id_estado' => $camion->id_estado,
            'id_tipo' => $idTipo
        ]);

        Session::flash('success', 'El Vehiculo se Actualizo exitosamente');
        return redirect()->back();
    }

    public function asignar(Request $request, Camiones $camion){

     $conductor_camion = Conductores_Camiones::create([

        'id_conductor'=>$request->user,
        'id_camion'=>$camion->id
     ]);

   
    
    //return $camion;
    $users = User :: where('id',$request->user)->first();
    if($camion->id_conductor != null){
        $conductoranterior = User :: where('id',$camion->id_conductor)->first();
        $conductoranterior -> update([
            'id_asignacion' => 2
             ]);
    
    }

    $users -> update([
    'id_asignacion' => 1
    ]);


    $camion->update([
        'id_conductor'=>$request->user
    ]);



     Session::flash('success', 'Se Asigno un Conductor');
     return redirect()->route('Vehiculos.Gestion')->with('success', 'Se Asignó un Conductor');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
