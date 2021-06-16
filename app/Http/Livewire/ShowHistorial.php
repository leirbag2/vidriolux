<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Historial;
class ShowHistorial extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $listaHistorial=Historial::orderByDesc('historial.created_at')
        ->select('historial.id','historial.created_at','historial.updated_at','historial.users_id','historial.productos_id','historial.cantidad','users.name', 'productos.codigo','productos.nombreProducto')
        ->join('users', 'users.id', '=', 'historial.users_id')
        ->join('productos', 'productos.id', '=', 'historial.productos_id')
        ->where('historial.created_at','LIKE','%'.$this->search.'%')->orWhere('users.name','LIKE','%'.$this->search.'%')
        ->orWhere('productos.codigo','LIKE','%'.$this->search.'%')
        ->orWhere('productos.nombreProducto','LIKE','%'.$this->search.'%')->paginate(10);
        return view('livewire.show-historial',compact('listaHistorial'));
        
    }
}
