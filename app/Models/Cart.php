<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

        $ItemAlmacenado = ['Cantidad' => 0, 'Precio' => $item->precioNeto, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $ItemAlmacenado = $this->items[$id];
            }
        }
        $ItemAlmacenado['Cantidad'] += $cantidad;
        $ItemAlmacenado['Precio'] = $item->precioNeto * $ItemAlmacenado['Cantidad'];
        $this->items[$id] = $ItemAlmacenado;
        $this->Cantidad += $cantidad;
        $this->PrecioTotal += $item->precioNeto * $cantidad;
    }

    public function remove($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $ItemAlmacenado = $this->items[$id];
                $this->Cantidad -= $ItemAlmacenado['Cantidad'];
                //$c = $ItemAlmacenado['Precio'].' '.$ItemAlmacenado['Cantidad'];
                //return dd($c);
                $this->PrecioTotal -= $ItemAlmacenado['Precio'];
                unset($this->items[$id]);
            }
        }
    }
}
