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
    public $vendedor;

    public function mount()
    {
        if (Ventas::orderby('fechaVenta')->count()) {
            $this->fechaIn = date('Y-m-d', strtotime(Ventas::orderby('fechaVenta')->first()->fechaVenta));
        } else {
            $this->fechaIn = date('Y-m-d');
        }
        $this->fechaFin = date('Y-m-d');
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $error = false;
        $ventas = Ventas::select('ventas.*', 'users.name')
            ->join('users', 'ventas.users_id', '=', 'users.id')
            ->where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->where('name', 'LIKE', '%' . $this->vendedor . '%')
            ->orderByDesc('fechaVenta')
            ->paginate(10);

        $all = Ventas::select('ventas.*', 'users.name')
            ->join('users', 'ventas.users_id', '=', 'users.id')
            ->where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->where('name', 'LIKE', '%' . $this->vendedor . '%');
        $ventasTotal = $all->sum('totalIva');
        $ganancias = $ventasTotal - $all->sum('precioCompra');
        if ($this->fechaIn > $this->fechaFin) {
            $error = true;
        }
        return view('livewire.show-reportes', compact('ventas', 'ventasTotal', 'ganancias', 'all', 'error'));
    }
}
