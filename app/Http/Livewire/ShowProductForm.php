<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Productos;
class ShowProductForm extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $productos = Productos::
        leftJoin('categorias', 'categorias.id', '=', 'productos.categorias_id')
        ->where('tipo_estado_id',1)
        ->where(function ($query){
            $query->where('nombreProducto','LIKE','%'.$this->search.'%')
            ->orWhere('codigo','LIKE','%'.$this->search.'%')
            ->orWhere('nombreCategoria','LIKE','%'.$this->search.'%');
        })->paginate(5);
        return view('livewire.show-product-form',compact('productos'));
    }
}
