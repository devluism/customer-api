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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni', 45)->primary()->comment('Documento de Identidad');
            $table->foreignId('region_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('commune_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('email', 120)->unique()->comment('Correo Electrónico');
            $table->string('name', 45)->comment('Nombre');
            $table->string('last_name', 45)->comment('Apellido');
            $table->string('address', 255)->nullable()->comment('Dirección');
            $table->enum('status', ['A','I', 'trash'])->default('A')->comment('Estado del registo. A: activo, I: desactivo, trash: eliminado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
