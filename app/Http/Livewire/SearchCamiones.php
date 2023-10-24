<?php

namespace App\Http\Livewire;

use App\Models\Camiones;
use App\Models\Color;
use App\Models\Estado;
use App\Models\Model_has_role;
use App\Models\Tipo;
use App\Models\User;
use Livewire\Component;

class SearchCamiones extends Component
{

    public $searchCamion;
    public $conductores;
    public function render()
    {
        $tipos = Tipo::all();    
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

        $camiones = Camiones::where(function ($query) {
            $query->where('matricula', 'like', '%' . $this->searchCamion . '%')
                ->orWhere('marca', 'like', '%' . $this->searchCamion . '%');
        })->orWhereHas('conductor', function ($query) {
            $query->where('name', 'like', '%' . $this->searchCamion . '%');

        })->orWhereHas('estado', function ($query) {
            $query->where('name', 'like', '%' . $this->searchCamion . '%');

        })
        ->with('estado', 'tipo_camion','conductor','color')->paginate(15);


        return view('livewire.search-camiones',compact('camiones','tipos','colores','estados','conductores'));

    }
}
