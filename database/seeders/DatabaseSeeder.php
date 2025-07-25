<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Importa los modelos
use App\Models\User;
use App\Models\Ubicacion;
use App\Models\Evento;
use App\Models\Artista;
use App\Models\TipoDeBoleto;
use App\Models\PaqueteBoleto;
use App\Models\EventoArtista;
use App\Models\Descuento;
use App\Models\Compra;
use App\Models\Boleto;
use App\Models\CompraDescuento;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desactivar restricciones de clave foránea para truncar tablas en orden
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncar todas las tablas para asegurar un estado limpio
        $this->truncateTables([
            'users', 'ubicaciones', 'eventos', 'artistas', 'tipos_de_boletos',
            'paquetes_boletos', 'eventos_artistas', 'descuentos', 'compras',
            'boletos', 'compra_descuentos'
        ]);

        // Reactivar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Crear datos en orden lógico ---

        // 1. Crear Usuarios y Ubicaciones (sin dependencias)
        User::factory(50)->create();
        $ubicaciones = Ubicacion::factory(10)->create(); // Guardamos la colección

        // 2. Crear Artistas (sin dependencias)
        $artistas = Artista::factory(20)->create(); // Guardamos la colección

        // 3. Crear Eventos (depende de Ubicaciones)
        // CORRECCIÓN: Creamos los eventos y luego les asignamos una ubicación
        $eventos = Evento::factory(15)->make(); // make() crea modelos sin guardarlos

        foreach ($eventos as $evento) {
            // Asignar una ubicación aleatoria de las ya creadas
            $evento->id_ubicacion = $ubicaciones->random()->id;
            $evento->save(); // Ahora sí lo guardamos con el id_ubicacion
        }
        
        // Refrescar la colección de eventos desde la BD para tener los IDs
        $eventos = Evento::all();

        // 4. Crear Tipos de Boletos y Paquetes
        TipoDeBoleto::factory(8)->create();
        PaqueteBoleto::factory(5)->create();

        // 5. Crear Descuentos
        Descuento::factory(10)->create();

        // 6. Crear Relaciones Evento-Artista
        $eventos->each(function ($evento) use ($artistas) {
            $artistasAleatorios = $artistas->random(rand(1, 3));
            foreach ($artistasAleatorios as $artista) {
                EventoArtista::factory()->create([
                    'evento_id' => $evento->id,
                    'artista_id' => $artista->id,
                ]);
            }
        });

        // 7. Crear Compras (depende de Usuarios y Eventos)
        $compras = Compra::factory(100)->make(); // make() para asignar evento_id después

        foreach ($compras as $compra) {
            // Asignar un usuario y un evento aleatorios
            $compra->usuario_id = User::all()->random()->id;
            $compra->evento_id = $eventos->random()->id;
            $compra->save(); // Guardar con las FKs asignadas
        }
        
        // Refrescar la colección de compras
        $compras = Compra::all();

        // 8. Crear Boletos (depende de Compras, TiposDeBoleto, Eventos)
        $tiposDeBoletos = TipoDeBoleto::all();
        $compras->each(function ($compra) use ($tiposDeBoletos, $eventos) {
            $numBoletos = rand(1, 5);
            for ($i = 0; $i < $numBoletos; $i++) {
                Boleto::factory()->create([
                    'compra_id' => $compra->id,
                    'tipo_boleto_id' => $tiposDeBoletos->random()->id,
                    'evento_id' => $compra->evento_id, // Mismo evento que la compra
                    'precio' => $tiposDeBoletos->random()->precio_base,
                ]);
            }
        });

        // 9. Crear Relaciones Compra-Descuento
        $descuentos = Descuento::all();
        $compras->each(function ($compra) use ($descuentos) {
            if (rand(1, 100) <= 60) {
                $numDescuentos = rand(0, 2);
                if ($numDescuentos > 0) {
                    $descuentosAplicados = $descuentos->random($numDescuentos);
                    if ($descuentosAplicados instanceof \Illuminate\Database\Eloquent\Collection) {
                        foreach ($descuentosAplicados as $descuento) {
                            CompraDescuento::factory()->create([
                                'compra_id' => $compra->id,
                                'descuento_id' => $descuento->id,
                                'monto_aplicado' => $descuento->porcentaje ? ($compra->total * $descuento->porcentaje / 100) : ($descuento->monto_fijo ?? 0),
                            ]);
                        }
                    } else {
                         CompraDescuento::factory()->create([
                            'compra_id' => $compra->id,
                            'descuento_id' => $descuentosAplicados->id,
                            'monto_aplicado' => $descuentosAplicados->porcentaje ? ($compra->total * $descuentosAplicados->porcentaje / 100) : ($descuentosAplicados->monto_fijo ?? 0),
                        ]);
                    }
                }
            }
        });

        $this->command->info('Base de datos poblada con datos de prueba realistas.');
    }

    /**
     * Trunca las tablas especificadas.
     */
    private function truncateTables(array $tables)
    {
        // Desactivar verificación de claves foráneas para truncar
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
            $this->command->info("Tabla {$table} truncada.");
        }
        // Reactivar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
