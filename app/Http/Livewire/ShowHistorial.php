<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Historial;

class ShowHistorial extends Component
{
    use WithPagination;
    public $fechaIn;
    public $fechaFin;
    public $producto;
    public $usuario;

    public function mount()
    {
        if (Historial::orderby('created_at')->count()) {
            $this->fechaIn = date('Y-m-d', strtotime(Historial::orderby('created_at')->first()->created_at));
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
        $listaHistorial = Historial::orderByDesc('historial.created_at')
            ->select('historial.id', 'historial.created_at', 'historial.updated_at', 'historial.user_id', 'historial.productos_id', 'historial.cantidad', 'users.name', 'productos.codigo', 'productos.nombreProducto')
            ->join('users', 'users.id', '=', 'historial.user_id')
            ->join('productos', 'productos.id', '=', 'historial.productos_id')
            ->where('historial.created_at', '>=',  $this->fechaIn . ' 00:00:00')
            ->where('historial.created_at', '<=', $this->fechaFin . ' 23:59:59')
            ->where('users.name', 'LIKE', '%' . $this->usuario . '%')
            ->where(function ($query) {
                $query->where('productos.codigo', 'LIKE', '%' . $this->producto . '%')
                    ->orWhere('productos.nombreProducto', 'LIKE', '%' . $this->producto . '%');
            });
        if ($this->fechaIn > $this->fechaFin) {
            $error = true;
        }
        $listaHistorial = $user->hasRole('Administrador') ? $listaHistorial->paginate(10) : $listaHistorial->where('user_id', $user->id)->paginate(10);
        return view('livewire.show-historial', compact('listaHistorial', 'error'));
    }
}
