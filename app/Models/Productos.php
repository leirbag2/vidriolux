<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table='productos';

    public function getCategoriaAttribute() {
        return Categorias::firstWhere('id', $this->categorias_id);
    }
}
