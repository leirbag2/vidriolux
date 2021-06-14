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
    
    
    public function getUsuarioAttribute() {
        return User::firstWhere('id', $this->users_id);
    }

    public function getProductoAttribute() {
        return Productos::firstWhere('id', $this->id);
    }


    public function detalle()
    {
        return $this->hasMany(DetalleVentas::class);
    }

    public function ventaProductos()
    {
        return $this->hasMany(Productos::class);
    }


    public $timestamps = false;
}
