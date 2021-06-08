<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ShowUsers extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.show-users',['lista' => User::where('name','LIKE','%'.$this->search.'%')->orWhere('email','LIKE','%'.$this->search.'%')->paginate(12)]  );
    }
}
