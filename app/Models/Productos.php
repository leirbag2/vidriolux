<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ventas;

class Productos extends Model
{
    use HasFactory;
    protected $table='productos';
    public $timestamps = false;

    public function getCategoriaAttribute() {
        return Categorias::firstWhere('id', $this->categorias_id);
    }

    public function ventas()
    {
        return $this->belongsToMany(Ventas::class,'detalle_ventas')->withPivot('cantidad','subtotal');
    }
}
