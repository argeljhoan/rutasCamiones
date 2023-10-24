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
use Livewire\Component;

class MapaVista extends Component
{
  public $searchRutas;
  public $conductores;
  public $open=false;
  public $matricula; 
  public $codigo;


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

    $camiones = Camiones::where('id_conductor', '!=', null)
    ->whereHas('mapas', function ($query) {
      $query->where('estadoLaboral', 'activo');
    })->where(function ($query) {
      $query->where('matricula', 'like', '%' . $this->searchRutas . '%')
        ->orWhere('marca', 'like', '%' . $this->searchRutas . '%');
    })->orWhereHas('conductor', function ($query) {
      $query->where('name', 'like', '%' . $this->searchRutas . '%');
    })
      ->with('estado', 'tipo_camion', 'conductor', 'color', 'mapas')->paginate(15);



    return view('livewire.mapa-vista', compact('camiones', 'colores', 'estados', 'conductores'));
  }


public function modal(Camiones $camion){

  $this->matricula = $camion->matricula;
  $this->open = true ;
  $this->codigo = $camion->color->codigo;
  $coordenadas = Ruta::where('id_camion', $camion->id)->get();

  $this->emit('abrirModal', $camion, $coordenadas,$this->codigo);

}

}
