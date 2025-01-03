<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipo_articulo_id',
        'fecha_hora',
        'total',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function tipoArticulo()
    {
        return $this->belongsTo(TipoArticulos::class, 'tipo_articulo_id');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVentas::class, 'venta_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Articulos::class, 'detalle_ventas', 'venta_id', 'producto_id')
        ->withPivot('cantidad', 'precio', 'precio_total')
        ->withTimestamps();
    }
    


}
