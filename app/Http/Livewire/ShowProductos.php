<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
class ShowProductos extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $visibilidad = Auth::user()->can('productos.edit') ? [1,2]:[1];
        $productos = Productos::select('productos.id AS id','productos.codigo','productos.nombreProducto','productos.descripcionProducto','productos.stock','productos.precioNeto','productos.precioIva','productos.tipo_estado_id','productos.categorias_id','categorias.id AS cId','categorias.nombreCategoria','precioVenta')
        ->leftJoin('categorias', 'categorias.id', '=', 'productos.categorias_id')
        ->whereIn('tipo_estado_id',$visibilidad)
        ->where(function ($query){
            $query->where('nombreProducto','LIKE','%'.$this->search.'%')
            ->orWhere('codigo','LIKE','%'.$this->search.'%')
            ->orWhere('nombreCategoria','LIKE','%'.$this->search.'%');
        })->paginate(10);
        return view('livewire.show-productos',compact('productos'));
    }
}
