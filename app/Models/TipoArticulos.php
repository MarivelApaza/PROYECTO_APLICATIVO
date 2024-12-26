<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArticulos extends Model
{
    use HasFactory;

    protected $table = 'tipoarticulos'; // Asegúrate de que sea el nombre correcto de la tabla
    protected $fillable = ['descripcion'];

    // Relación inversa de artículos
    public function articulos()
    {
        return $this->hasMany(Articulo::class, 'cod_tipo_articulo', 'id');
    }
}
