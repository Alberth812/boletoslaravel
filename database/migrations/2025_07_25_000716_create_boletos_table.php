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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('tipo_boleto_id');
            $table->unsignedBigInteger('evento_id');
            $table->string('numero_serie')->unique();
            $table->string('qr_code')->nullable(); // Puedes almacenar la ruta del QR
            $table->string('asiento')->nullable(); // Si aplica
            $table->decimal('precio', 10, 2);
            $table->string('estado'); // Ej: Activo, Usado, Cancelado
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('tipo_boleto_id')->references('id')->on('tipos_de_boletos')->onDelete('cascade');
            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};