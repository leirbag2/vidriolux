<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Productos;

class Historial extends Model
{
    use HasFactory;
    protected $table='historial';

    public function getUsuarioAttribute() {
        return User::firstWhere('id', $this->users_id);
    }

    public function getProductoAttribute() {
        return Productos::firstWhere('id', $this->productos_id);
    }
}
