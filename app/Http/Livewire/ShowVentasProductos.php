<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Productos;

class ShowVentasProductos extends Component
{
    use WithPagination;
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $productos = Productos::where('nombreProducto','LIKE','%'.$this->search.'%')->paginate(5);
        return view('livewire.show-product-form',compact('productos'));
    }
}
