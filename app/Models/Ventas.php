<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetalleVentas;
use App\Models\Productos;

class Ventas extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function getUsuarioAttribute() {
        return User::firstWhere('id', $this->users_id);
    }

    public function getProductoAttribute() {
        return Productos::firstWhere('id', $this->id);
    }

    public function getEstadoAttribute() {
        return EstadoVenta::firstWhere('id', $this->estado_venta_id);
    }

    public function detalle()
    {
        return $this->hasMany(DetalleVentas::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Productos::class, 'detalle_ventas')->withPivot('cantidad', 'subtotal', 'precioCompra', 'precioVenta');
    }
}
