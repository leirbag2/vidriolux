<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ShowUsers extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.show-users',['lista' => User::where('name','LIKE','%'.$this->search.'%')->get()]  );
    }
}
