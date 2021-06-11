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
        $listaHistorial=Historial::orderByDesc('created_at')->paginate(12);
        return view('livewire.show-historial',compact('listaHistorial'));
    }
}
