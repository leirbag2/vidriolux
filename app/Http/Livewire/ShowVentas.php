<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ventas;

class ShowVentas extends Component
{
    use WithPagination;
    public $vendedor;
    public $search;
    public $fechaIn;
    public $fechaFin;

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
        $user = auth()->user();
        $error = false;
        $ventas = Ventas::orderByDesc('fechaVenta')
            ->select('ventas.*', 'users.name')
            ->join('users', 'ventas.users_id', '=', 'users.id')
            ->where('fechaVenta', '>=',  $this->fechaIn . ' 00:00:00')
            ->where('fechaVenta', '<=', $this->fechaFin . ' 23:59:59')
            ->where('numFactura', 'LIKE', '%' . $this->search . '%')
            ->where('name', 'LIKE', '%' . $this->vendedor . '%');
        if ($this->fechaIn > $this->fechaFin) {
            $error = true;
        }
        $ventas = $user->hasRole('Administrador') ? $ventas->paginate(10) : $ventas->where('users_id', $user->id)->paginate(10);
        return view('livewire.show-ventas', compact('ventas', 'error'));
    }
}
