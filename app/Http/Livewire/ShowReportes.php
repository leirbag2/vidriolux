<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Ventas;
use Livewire\Component;

class ShowReportes extends Component
{



    use WithPagination;
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $ventas = Ventas::where('fechaVenta', 'LIKE', '%' . $this->search . '%')->orWhere('numFactura', 'LIKE', '%' . $this->search . '%')->paginate(10);
        return view('livewire.show-reportes', compact('ventas'));
    }
}
