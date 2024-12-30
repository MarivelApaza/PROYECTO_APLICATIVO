<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); // Nombre del cliente, con longitud de 100 caracteres.
            $table->string('tipo_documento', 20);
            $table->string('num_documento', 20);
            $table->string('apellidos', 100);
            $table->string('telefono', 15); // Teléfono, ajustado a un tamaño adecuado para números telefónicos.
            $table->string('direccion', 200); // Dirección, con longitud de 200 caracteres.
            $table->string('ciudad', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
