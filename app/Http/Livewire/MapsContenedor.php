<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Rutas\RutasController;
use Livewire\Component;
use App\Events\CoordenadasActualizadas;
use App\Models\Camiones;
use App\Models\Mapa;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;

class MapsContenedor extends Component
{

    public $camiones;
    public $coordenadas;
    public $latitudModal;
    public $longitudModal;
    public $open = false;
    public $matricula;
    public $nombreconductor;




    protected $listeners = ['showModal'];

    public function mount($coordenadas, $camiones)
    {
        $this->coordenadas = $coordenadas;
        $this->camiones = $camiones;
    }

    public function render()
    {
        $camionJSON = json_encode($this->camiones);
        $camionArray = json_decode($camionJSON, true);
        $camiones = Camiones::where('id_conductor', '!=', null)->with('conductor')->get();


        foreach ($this->coordenadas as $coordenada) {

            $id = $coordenada->id_camion;
            $lat = $coordenada->latitud;
            $log = $coordenada->longitud;
        }
        $coordenadas = Mapa::where('id_camion', $id)->get();

        $this->emit('CoordenadasActualizadas', $lat, $log);
        return view('livewire.maps-contenedor');
    }

    public function showModal(Camiones $camion)
    {
        $camiones = Camiones::where('id_conductor', '!=', null)->with('conductor')->get();
        $coordenadas = Mapa::where('id_camion', $camion->id)->get();


        foreach ($coordenadas as $coordenada) {

            $matricula = $coordenada->matricula;
            $lat = $coordenada->latitud;
            $log = $coordenada->longitud;
        }

        $this->open = true;
        $this->matricula = $camion->matricula;
        $this->latitudModal = $lat;
        $this->longitudModal = $log;
        $this->coordenadas = $coordenadas;
        $this->camiones = $camiones;
        $this->emit('abrirModal', $camion, $lat,$log);
    }
}
