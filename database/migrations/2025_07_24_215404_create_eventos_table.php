<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('eventos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion');
        $table->dateTime('inicio');
        $table->dateTime('fin');
        $table->unsignedBigInteger('id_ubicacion');
        $table->foreign('id_ubicacion')->references('id')->on('ubicaciones');
        $table->string('lugar');
        $table->string('ciudad');
        $table->string('pais');
        $table->string('imagen');
        $table->string('estado');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
