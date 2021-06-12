<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos;

class DetalleVentas extends Model
{
    use HasFactory;


    public function getProductoAttribute() {
        return Productos::firstWhere('id', $this->productos_id);
    }



}
