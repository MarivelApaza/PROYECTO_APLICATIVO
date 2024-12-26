<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'proveedor', 
        'contacto', 
        'telefono', 
        'direccion'
    ];

    // Relación inversa de artículos
    public function articulos()
    {
        return $this->hasMany(Articulos::class, 'cod_proveedor', 'id');
    }
}
