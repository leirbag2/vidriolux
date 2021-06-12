<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetalleVentas;

class Ventas extends Model
{
    use HasFactory;
    
    
    public function getUsuarioAttribute() {
        return User::firstWhere('id', $this->users_id);
    }


    public function detalle()
    {
        return $this->hasMany(DetalleVentas::class);
    }

}
