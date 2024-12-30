<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    // Definimos los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'direccion',
        'ciudad',
        'tipo_documento', // Campo tipo de documento
        'num_documento',  // Campo número de documento
    ];
    
    public function ventas()
    {
        return $this->hasMany(Ventas::class);
    }
}
