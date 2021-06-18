<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Ventas;
use Livewire\Component;

class ShowReportes extends Component
{
    use WithPagination;
    public $fechaIn;
    public $fechaFin;

    public function mount()
    {
        $this->fechaIn = date('Y-m-d', strtotime(Ventas::orderby('fechaVenta')->first()->fechaVenta));
        $this->fechaFin = date('Y-m-d');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ventas = Ventas::where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->orderByDesc('id')
            ->paginate(10);
        $ventasTotal = Ventas::where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')->sum('totalIva');
        return view('livewire.show-reportes', compact('ventas', 'ventasTotal'));
    }
}
