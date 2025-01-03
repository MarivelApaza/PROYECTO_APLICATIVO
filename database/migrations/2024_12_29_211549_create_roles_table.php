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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->unique();
            $table->boolean('condicion')->default(1);       
            $table->timestamps();
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Operador'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Invitado'));

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
