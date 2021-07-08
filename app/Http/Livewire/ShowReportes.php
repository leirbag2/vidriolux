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

        $all = Ventas::select('ventas.*', 'users.name')
            ->join('users', 'ventas.users_id', '=', 'users.id')
            ->where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->where('name', 'LIKE', '%' . $this->vendedor . '%')
<<<<<<< HEAD
            ->where('estado_venta_id','=', 1)
            ->orderByDesc('fechaVenta')
            ->paginate(10);

        $all = Ventas::select('ventas.*', 'users.name')
            ->join('users', 'ventas.users_id', '=', 'users.id')
            ->where('fechaVenta', '>=', $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->where('name', 'LIKE', '%' . $this->vendedor . '%')
            ->where('estado_venta_id','=', 1);
        
=======
            ->where('estado_venta_id', 1);
        $ventas = $all
            ->orderByDesc('fechaVenta')
            ->paginate(10);
>>>>>>> 0de591e93606ca7e61a7056218a7bc4d18d4c1f4
        $ventasTotal = $all->sum('totalIva');
        $ganancias = $ventasTotal - $all->sum('precioCompra');
        if ($this->fechaIn > $this->fechaFin) {
            $error = true;
        }
        return view('livewire.show-reportes', compact('ventas', 'ventasTotal', 'ganancias', 'all', 'error'));
    }
}
