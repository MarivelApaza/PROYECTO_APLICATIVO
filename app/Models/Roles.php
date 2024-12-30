<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Si la tabla se llama 'roles'
    protected $fillable = ['nombre'];

    public function users() : HasMany
    {
        return $this->hasMany(User::class, 'roles_id'); // 'roles_id' es el nombre de la columna en la tabla users
    }
}
