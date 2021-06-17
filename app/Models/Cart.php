<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Productos;

class Cart extends Model
{
    public $items = null;
    public $Cantidad = 0;
    public $PrecioTotal = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->Cantidad = $oldCart->Cantidad;
            $this->PrecioTotal = $oldCart->PrecioTotal;
        }
    }

    public function add($item, $id, $cantidad)
    {

        $ItemAlmacenado = ['Cantidad' => 0, 'Precio' => $item->precioVenta, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $ItemAlmacenado = $this->items[$id];
            }
        }
        $ItemAlmacenado['Cantidad'] += $cantidad;
        $ItemAlmacenado['Precio'] = $item->precioVenta * $ItemAlmacenado['Cantidad'];
        $this->Cantidad += $cantidad;
        $this->PrecioTotal += $item->precioVenta * $cantidad;
        $this->items[$id] = $ItemAlmacenado;
    }

    public function disponible($item, $id, $cantidad)
    {
        $ItemAlmacenado = ['Cantidad' => 0, 'Precio' => $item->precioVenta, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $ItemAlmacenado = $this->items[$id];
            }
        }
        if (Productos::find($id)->stock >= ($ItemAlmacenado['Cantidad'] + $cantidad)) { 
            return true;
        }
        return false;
    }

    public function remove($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $ItemAlmacenado = $this->items[$id];
                $this->Cantidad -= $ItemAlmacenado['Cantidad'];
                $this->PrecioTotal -= $ItemAlmacenado['Precio'];
                unset($this->items[$id]);
            }
        }
    }
}
