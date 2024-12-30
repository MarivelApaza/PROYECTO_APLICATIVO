<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
    protected $table = 'articulos';

    // Los campos que pueden ser llenados masivamente
    protected $fillable = [
        'descripcion',
        'precio_venta',
        'precio_costo',
        'stock',
        'cod_tipo_articulo',
        'cod_proveedor',
        'fecha_ingreso',
        'ventas_id',
    ];

    public function tipoArticulo()
    {
        return $this->belongsTo(TipoArticulos::class, 'cod_tipo_articulo', 'id');
    }

    // Relación con el modelo Proveedor (suponiendo que tienes este modelo)
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'cod_proveedor', 'id');
    }

    public function detallesVentas()
    {
        return $this->hasMany(DetalleVentas::class);
    }

    public function venta()
    {
        
        return $this->belongsToMany(Ventas::class, 'detalle_ventas', 'producto_id', 'venta_id')
        ->withPivot('cantidad', 'precio', 'precio_total');
        
    }

}
