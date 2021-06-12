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
        $users = User::where('name','LIKE','%'.$this->search.'%')->orWhere('email','LIKE','%'.$this->search.'%')->paginate(10);
        return view('livewire.show-users',compact('users'));
    }
}
