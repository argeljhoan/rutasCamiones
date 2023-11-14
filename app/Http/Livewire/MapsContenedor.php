<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Rutas\RutasController;
use Livewire\Component;
use App\Events\CoordenadasActualizadas;
use App\Models\Camiones;
use App\Models\Estado;
use App\Models\Mapa;
use App\Models\Tipo;
use App\Models\User;
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
    public $tipo;
    public $marca;
    public $color;
    public $idcamion;
    public $modelo;
    public $codigo;
    public $estado;
    public $direccion;
    public $situacion;





    protected $listeners = ['showModal', 'MapaCamiones', 'cambiarEstado'];

    public function mount($coordenadas, $camiones)
    {
        $this->coordenadas = $coordenadas;
        $this->camiones = $camiones;
    }

    public function render()
    {


        return view('livewire.maps-contenedor');
    }

    public function showModal(Camiones $camion)
    {

        $estado =  Estado::where('name', 'funcionando')->first();

        $camiones = Camiones::where('id_conductor', '!=', null)
            ->where('id_estado', $estado->id)
            ->with('conductor', 'color', 'mapas')->get();

        //  $camiones = Camiones::where('id_conductor', '!=', null)->with('conductor')->get();
        $coordenadas = Mapa::where('id_camion', $camion->id)->get();
        $tipo = Tipo::where('id', $camion->id_tipo)->first();
        $conductor = User::where('id', $camion->id_conductor)->first();


        foreach ($coordenadas as $coordenada) {

            $matricula = $coordenada->matricula;
            $lat = $coordenada->latitud;
            $log = $coordenada->longitud;
            $this->situacion = $coordenada->estadoSituacion;
            $this->direccion = $coordenada->direccion;
        }
        //dd($camion);


        if ($lat == null && $log == null) {

            $this->emit('alerta');
        } else {

            $this->open = true;
            $this->nombreconductor = $conductor->name;
            $this->idcamion = $camion->id;
            $this->modelo = $camion->modelo;
            $this->matricula = $camion->matricula;
            $this->tipo = $tipo->name;
            $this->marca = $camion->marca;
            $this->color = $camion->color->name;
            $this->codigo = $camion->color->codigo;
            $this->latitudModal = $lat;
            $this->longitudModal = $log;
            $this->coordenadas = $coordenadas;
            $this->camiones = $camiones;

            $this->emit('abrirModal', $camion, $lat, $log, $this->codigo);
        }
    }



    public function MapaCamiones()
    {

        $estado =  Estado::where('name', 'funcionando')->first();
        $camiones = Camiones::where('id_conductor', '!=', null)
            ->where('id_estado', $estado->id)
            ->with('conductor', 'color', 'mapas')->get();
        //   $this->camiones = $camiones;

        $this->emit('mapaRefresh', $camiones);
    }


    public function cambiarEstado(Camiones $camion)
    {


        $mapa = Mapa::where('id_camion', $camion->id)->first();


        if ($mapa) {
            $mapa->update([
                'estadoSituacion' => 'normal'
            ]);
            $this->open = false;


            $this->emit('MapaCamiones');
            $this->emit('cambiarExitoso',$camion->conductor);
        }
    }
}
