<?php

namespace App\Http\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategorias extends Component
{
    use WithPagination;
    public $search;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $categorias = Categorias::where('id','LIKE','%'.$this->search.'%')->orWhere('nombreCategoria','LIKE','%'.$this->search.'%')->paginate(10);
        return view('livewire.show-categorias',compact('categorias'));
    }
}
