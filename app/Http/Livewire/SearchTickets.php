<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class SearchTickets extends Component
{


    public $searchTicket;
    public $fecha;
    
    public function render()
    {

        $tickets = Ticket::where('radicado', 'like', '%' . $this->searchTicket . '%')
        ->orWhereHas('camion.conductor', function ($query) {
            $query->where('matricula', 'like', '%' . $this->searchTicket . '%')
            ->orWhere('name', 'like', '%' . $this->searchTicket . '%');

        })->whereDate('fecha','like', '%' . $this->fecha . '%')->with('camion.conductor')->paginate(15);

        return view('livewire.search-tickets',compact('tickets'));
    }
}
