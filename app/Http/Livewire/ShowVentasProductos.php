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
        $productos = Productos::select('productos.id as id','categorias.id as cId','codigo','nombreProducto','stock','nombreCategoria','precioNeto','precioIva')
        ->leftJoin('categorias', 'categorias.id', '=', 'productos.categorias_id')
        ->where('tipo_estado_id',1)
        ->where('stock','>',0)
        ->where(function ($query){
            $query->where('nombreProducto','LIKE','%'.$this->search.'%')
            ->orWhere('codigo','LIKE','%'.$this->search.'%')
            ->orWhere('nombreCategoria','LIKE','%'.$this->search.'%');
        })->paginate(5);
        return view('livewire.show-ventas-productos',compact('productos'));
    }
}
