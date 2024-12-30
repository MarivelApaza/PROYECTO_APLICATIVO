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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 30);
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('precio_costo', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('cod_tipo_articulo');  // Relacionada con 'tipo_articulos'
            $table->unsignedBigInteger('cod_proveedor');      // Relacionada con 'proveedors'            
            $table->string('fecha_ingreso', 15);
            $table->unsignedBigInteger('ventas_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
