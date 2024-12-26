<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 
        'proveedor_id', 
        'tipo_articulo_id', 
        'total'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVentas::class);
    }
}
