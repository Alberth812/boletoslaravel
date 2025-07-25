// database/migrations/0001_01_01_000000_create_users_table.php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario');
            $table->string('correo')->unique();
            $table->string('contraseña_hash'); // Considera usar 'password' como nombre estándar
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->boolean('es_admin')->default(false);
            $table->boolean('esta_activo')->default(true);
            $table->rememberToken(); // Agrega esta línea si planeas usar el sistema de autenticación de Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};