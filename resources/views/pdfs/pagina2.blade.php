{{-- resources/views/pdfs/_pagina2.blade.php --}}
<style>
    /* ====== Estilos locales de la página 2 ====== */
    .page-break { page-break-before: always; }
    .p2 * { box-sizing: border-box; }
    .p2 { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color:#111; }

    .seccion-titulo {
        color:#b30000; font-weight: 800; margin: 8px 0 6px 0;
        text-transform: uppercase;
    }

    table { width:100%; border-collapse: collapse; }
    th, td { padding:6px; vertical-align: top; }
    .conborde th, .conborde td { border:1px solid #222; }
    .center { text-align:center; }
    .bg-encabezado { background:#fde7b4; font-weight:700; }
    .bg-sub { background:#f2f7ff; font-weight:700; }
    .bg-col { background:#e7f5e7; }
    .mini { font-size:10px; }
    .li { margin:0 0 4px 16px; }
    .w-20{width:20%} .w-25{width:25%} .w-30{width:30%} .w-35{width:35%}
    .w-40{width:40%} .w-45{width:45%} .w-10{width:10%}

    /* Columna vertical "COMUNICACIÓN" (con fallback) */
    .vertical {
        writing-mode: vertical-rl;
        transform: rotate(180deg);           /* fallback para visores sin writing-mode */
        text-align: center;
        font-weight: 800;
        letter-spacing: 1px;
    }
    .col-vertical {
        width:20px;                           /* ancho estrecho */
        padding:0 !important;
        background:#ffd6d6;
        border-right:1px solid #222;
        border-left:1px solid #222;
    }
</style>

<div class="page-break"></div>
<div class="p2">

    {{-- IV. ENFOQUES TRANSVERSALES --}}
    <div class="seccion-titulo">IV. ENFOQUES TRANSVERSALES:</div>
    <table class="conborde mini">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-25">ENFOQUES TRANSVERSALES</th>
            <th class="w-20">VALOR</th>
            <th>ACTITUDES O ACCIONES OBSERVABLES</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-sub">Ambiental</td>
            <td>
                Justicia y solidaridad
            </td>
            <td>
                <div class="li">Los estudiantes comprenden cómo se originan los desastres naturales y buscar soluciones para disminuir el riesgo y así garantizar el bienestar de las personas.</div>
                <div class="li">Los estudiantes comprenden que el buen uso de la tecnología.</div>
                <div class="li">El docente promueve espacios de diálogo para que los estudiantes dialoguen e intercambien ideas y experiencias respetando a los demás.</div>
            </td>
        </tr>
        <tr>
            <td class="bg-sub">Bien común</td>
            <td>
                Solidaridad<br>Empatía
            </td>
            <td>
                <div class="li">Identificación efectiva con los sentimientos del otro y disposición para apoyar y comprender en circunstancias de desastres naturales.</div>
                <div class="li">Los docentes promueven el buen uso de la tecnología mediante información confiable para prevenir a los estudiantes de los riesgos que pueden suceder.</div>
            </td>
        </tr>
        </tbody>
    </table>

    {{-- V. PROPÓSITOS DE APRENDIZAJE --}}
    <div class="seccion-titulo" style="margin-top:10px;">V. PROPÓSITOS DE APRENDIZAJE</div>

    <table class="conborde">
        <thead>
        <tr class="bg-encabezado center">
            <th class="col-vertical"><div class="vertical">COMUNICACIÓN</div></th>
            <th class="w-25">Competencias / Capacidades</th>
            <th class="w-25">Estándares</th>
            <th class="w-25">Desempeños de 3°</th>
            <th class="w-25">Criterios de evaluación</th>
            <th class="w-20">Actividad</th>
            <th class="w-15">Evidencia</th>
            <th class="w-10">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody class="mini">
        <tr>
            {{-- Columna vertical vacía (ya contiene el texto rotado en el thead) --}}
            <td class="col-vertical"></td>

            {{-- Competencias/Capacidades --}}
            <td class="bg-col">
                <strong>Se comunica oralmente en su lengua materna.</strong>
                <ul style="margin:6px 0 0 16px; padding:0;">
                    <li>Obtiene información del texto oral.</li>
                    <li>Infiere e interpreta información del texto oral.</li>
                    <li>Adecua, organiza y desarrolla las ideas de forma coherente y cohesionada.</li>
                </ul>
            </td>

            {{-- Estándares --}}
            <td>
                Se comunica oralmente mediante diversos tipos de textos; identifica información explícita; infiere e interpreta hechos, tema y propósito. Organiza y desarrolla sus ideas en torno a un tema y las relaciona mediante el uso de algunos conectores y referentes, así como de un vocabulario variado. Se apoya en recursos no verbales y paraverbales para enfatizar lo que dice. Reflexiona sobre textos escuchados a partir de sus conocimientos y experiencia. Se expresa adecuándose a situaciones comunicativas formales e informales; en un intercambio, comienza a adaptar lo que dice a las necesidades y puntos de vista de quien lo escucha.
            </td>

            {{-- Desempeños de 3° --}}
            <td>
                <ul style="margin:0 0 0 16px; padding:0;">
                    <li>Expresa oralmente ideas y emociones en torno a un tema, y evita reiterar información innecesariamente.</li>
                    <li>Participa en diversos intercambios orales alternando roles de hablante y oyente, formulando preguntas, comentarios y respuestas y haciendo precisiones respecto al tema.</li>
                    <li>Reconoce normas y modos de interacción en el contexto sociocultural.</li>
                    <li>Opina, concluye y ordena sobre hechos, ideas y temas de los textos orales, del entorno escolar, social y de medios de comunicación, a partir de evidencias.</li>
                </ul>
            </td>

            {{-- Criterios de evaluación --}}
            <td>
                <ul style="margin:0 0 0 16px; padding:0;">
                    <li>Planifica lo que va a realizar durante su exposición de instrucciones para una evacuación segura.</li>
                    <li>Participa activamente durante las exposiciones con comentarios sobre los terremotos ocurridos.</li>
                    <li>Emplea el lenguaje y tono adecuado para dirigir su diálogo durante el compartir.</li>
                </ul>
            </td>

            {{-- Actividad --}}
            <td>
                <div class="li">Comparte las instrucciones para una evacuación segura.</div>
                <div class="li">Comparte tus recomendaciones para el buen uso de la tecnología.</div>
            </td>

            {{-- Evidencia --}}
            <td class="center">Participación oral</td>

            {{-- Instrumento --}}
            <td class="center">Lista de cotejo</td>
        </tr>
        </tbody>
    </table>
</div>
