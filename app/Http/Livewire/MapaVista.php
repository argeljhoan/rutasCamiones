<?php

namespace App\Http\Livewire;

use App\Models\Camiones;
use App\Models\Mapa;
use Livewire\Component;

class MapaVista extends Component
{
  public $latitudModal;
  public $longitudModal;
  public $open = false;
  public $matricula;
  public $nombreconductor;


  protected $listeners = ['abrirModal'];

  public function render()
  {
    return view('livewire.mapa-vista');
  }


  public function abrirModal(Camiones $camion, Mapa $coordenadas)
  {

    $this->open = true;
    $this->matricula = $camion->matricula;
    $this->latitudModal = $coordenadas->latitud;
    $this->longitudModal = $coordenadas->longitud;
  }
}
