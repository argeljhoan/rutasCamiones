<?php

namespace App\Http\Livewire;

use App\Models\Camiones;
use App\Models\Color;
use App\Models\Estado;
use App\Models\Mapa;
use App\Models\Model_has_role;
use App\Models\Ruta;
use App\Models\Tipo;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class MapaVista extends Component
{
  public $searchRutas;
  public $conductores;
  public $open=false;
  public $matricula; 
  public $codigo;
  public $camion;
  public $fecha;


  //protected $listeners = ['abrirModal'];

  public function render()
  {


    $colores = Color::all();
    $estados = Estado::all();

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
    ->paginate(15);
 
 
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
    ->paginate(15);


   
  }

   return view('livewire.mapa-vista', compact('camiones', 'colores', 'estados', 'conductores'));
  }


public function modal(Camiones $camion){

  $this->matricula = $camion->matricula;
  
  $this->codigo = $camion->color->codigo;


if($this->fecha ==null){
  $fechaActual = Carbon::now();
  $fechaActual->toDateString(); 


  $coordenadas = Ruta::where('id_camion', $camion->id)
  ->whereDate('created_at', $fechaActual)
  ->get();
  $this->open = true ;
   $this->emit('abrirModal', $camion, $coordenadas,$this->codigo);
}else {


  $coordenadas = Ruta::where('id_camion', $camion->id)
  ->whereDate('created_at', $this->fecha)
  ->get();

if(!$coordenadas->isEmpty()){
  $this->open = true ;
  $this->emit('abrirModal', $camion, $coordenadas,$this->codigo);
}else{

  $this->emit('alerta');

}


}


 

}

}
