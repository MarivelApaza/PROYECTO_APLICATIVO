<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio',
        'precio_total'
    ];

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'venta_id');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Articulos::class, 'producto_id');
    }

}
