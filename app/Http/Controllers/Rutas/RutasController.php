<?php

namespace App\Http\Controllers\Rutas;

use Geocoder;
use App\Http\Controllers\Controller;
use App\Models\Camiones;
use App\Models\Estado;
use App\Models\Mapa;
use App\Models\Ruta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RutasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  $searchRutas ='luis';
    public $fecha;
    public function index()
    
    { 

   $fechaActual = Carbon::now();
   $fechaActual->toDateString(); 



if($this->fecha == null){

   $camiones = Camiones::where('id_conductor', '!=', null)
   ->whereHas('mapas', function ($query) {
       $query->where('estadoLaboral', 'activo');
   })
   ->where(function ($query) {
       $query->where(function ($subquery) {
           $subquery->where('matricula', 'like', '%' . $this->searchRutas . '%')
               ->orWhere('marca', 'like', '%' . $this->searchRutas . '%');
       })
       ->orWhereHas('conductor', function ($subquery) {
           $subquery->where('name', 'like', '%' . $this->searchRutas . '%');
       });
   })
   ->with(['estado', 'tipo_camion', 'conductor', 'color', 'rutas' => function ($query) use ($fechaActual) {
       // Filtrar las rutas para que solo incluya las que tienen la misma fecha que $fechaActual
       $query->whereDate('created_at', $fechaActual);
   }])
   ->get();



}else{

    $camiones = Camiones::where('id_conductor', '!=', null)
   ->whereHas('mapas', function ($query) {
       $query->where('estadoLaboral', 'activo');
   })
   ->where(function ($query) {
       $query->where(function ($subquery) {
           $subquery->where('matricula', 'like', '%' . $this->searchRutas . '%')
               ->orWhere('marca', 'like', '%' . $this->searchRutas . '%');
       })
       ->orWhereHas('conductor', function ($subquery) {
           $subquery->where('name', 'like', '%' . $this->searchRutas . '%');
       });
   })
   ->with(['estado', 'tipo_camion', 'conductor', 'color', 'rutas' => function ($query){
       // Filtrar las rutas para que solo incluya las que tienen la misma fecha que $fechaActual
       $query->whereDate('created_at', $this->fecha);
   }])
   ->get();

}
//return   $camiones;
        //AIzaSyAtTDv6zE-wO9l81rfsEqnWrtmIzykelug

        
        return view('Rutas.Gestion');
    }

    public function gestionMapa()
    {

        $estado = Estado::where('name', 'funcionando')->first();

        $camiones = Camiones::where('id_conductor', '!=', null)
            ->where('id_estado', $estado->id)
            ->with('conductor', 'color', 'mapas')->get();

        $coordenadas = Mapa::where('id_camion', '=', null)->get();

        // return $camiones;
        return view('Rutas.Mapa', compact('camiones', 'coordenadas'));
    }


    public function buscarCoordenadas()
    {

        $estado =  Estado::where('name', 'funcionando')->first();
        $camiones = Camiones::where('id_conductor', '!=', null)
            ->where('id_estado', $estado->id)
            ->with('conductor', 'color', 'mapas')->get();

        foreach ($camiones as $camion) {


            foreach ($camion->mapas as $coordenada) {
              $ruta = Ruta::create([
                    'latitud' => $coordenada->latitud,
                    'longitud' => $coordenada->longitud,
                    'id_camion' => $camion->id
                    // 'direccion'=>'inactivo',
                    // Aquí debes proporcionar los datos para las coordenadas, si es necesario.
                ]);
            }
        }


        return $camiones;

        // return view('Rutas.Mapa', compact('camiones', 'coordenadas'));
    }

    public function buscarCamion(Camiones $camion)
    {



        $camiones = Camiones::where('id', $camion->id)
            ->with('conductor', 'color', 'mapas')->first();

        return  $camiones;
    }

    public function rutasCoordenadas(Camiones $camion)
    {


        $coordenadas = Ruta::where('id_camion', $camion->id)->with(['camion' => function ($query) {
            $query->with('color');
        }])->get();
        return $coordenadas;
    }



    public function showMap()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
