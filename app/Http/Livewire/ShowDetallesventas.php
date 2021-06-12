<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DetalleVentas; 

class ShowDetallesventas extends Component
{
    use WithPagination;
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {  
        $detalleventas = DetalleVentas::where('ventas_id','LIKE','%'.$this->search.'%')->orWhere('productos_id','LIKE','%'.$this->search.'%')->paginate(10);
        return view('livewire.show-detallesventas',compact('detalleventas'));
    }
}
