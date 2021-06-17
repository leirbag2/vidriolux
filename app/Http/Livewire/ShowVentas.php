<?php
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ventas; 
use App\Models\ReportController; 
class ShowVentas extends Component
{
    use WithPagination;
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {  
        $ventas = Ventas::orderByDesc('id')->where('fechaVenta','LIKE','%'.$this->search.'%')->orWhere('numFactura','LIKE','%'.$this->search.'%')->paginate(10);
        return view('livewire.show-ventas',compact('ventas'));
    }
}
