<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
class SearchUser extends Component
{

    use WithPagination; // Agrega el trait WithPagination al componente

    protected $users; 
    public $searchUser;

    // public function mount($users){
   
    //     $this->users = $users;
        
    // }
    public function render()
    {     

        $users = User::where(function ($query) {
            $query->where('identificacion', 'like', '%' . $this->searchUser . '%')
                ->orWhere('name', 'like', '%' . $this->searchUser . '%');
        })->orWhereHas('roles', function ($query) {
            $query->where('name', 'like', '%' . $this->searchUser . '%');
        })->with('roles')->paginate(15);

        return view('livewire.search-user' ,compact('users'));
    }
}
