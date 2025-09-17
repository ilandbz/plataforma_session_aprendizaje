<?php

namespace Database\Seeders;

use App\Models\UnidadAprendizaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadAprendizajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnidadAprendizaje::firstOrCreate([
                    'id'                     => 1,
                    'numero_unidad'          => 1,
                    'nombre_unidad'          => 'PREVENIMOS FENÓMENOS NATURALES, SITUACIONES DE RIESGO Y CONOCEMOS EL USO ADECUADO DE LA TECNOLOGÍA',
                    'tipo_id'                => 4,
                    'institucion_educativa_id' => 1,
                    'director'               => 'Director Ejemplar',
                    'sub_director'           => 'Subdirector Ejemplar',
                    'descripcion_unidad'     => 'dasasd',
                    'profesor'               => 'admin',
                    'grado'                  => '3° Grado',
                    'seccion'                => 'a',
                    'fecha_inicio'           => '2025-09-10',
                    'situacion_significativa'=> "Los estudiantes del 3° han observado que el Perú es un país en el cual sucede diferentes fenómenos
        naturales dependiendo de la zona donde vivan, puede haber huaycos, inundaciones, temblores,
        terremotos, heladas, friajes, etc. Muchos de sus hogares desconocen las acciones a realizar para
        prevenir y enfrentar posibles situaciones de riesgo, por otro lado, no conocen los riesgos que pueden
        tener usar inadecuadamente la tecnología que actualmente es un gran aliado.
        <br><br>
        <span class=\"resaltado-amarillo\">
            A partir de esta situación, planteamos el siguiente reto:
            ¿Qué situaciones de riesgo ocurren en tu localidad? ¿Cómo podemos actuar frente a los fenómenos
            naturales? ¿Cómo podemos prevenir situaciones de riesgo? ¿Sabes cuál es el adecuado uso de la tecnología?
        </span>",
                    'productos'              => "            <span style=\"font-weight: 600\">
                Manualidad día del niño, manualidad Santa Rosa, collage, texto instructivo, texto informativo,
                recomendaciones para evacuar, exposición de textos y díptico con recomendaciones para el buen uso de la tecnología.
            </span>",
                    'fecha_fin'              => '2025-09-02',
                ]);
    }
}
