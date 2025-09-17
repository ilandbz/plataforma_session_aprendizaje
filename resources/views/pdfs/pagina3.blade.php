{{-- resources/views/pdfs/_pagina3.blade.php --}}
<style>
    .page-break { page-break-before: always; }
    .p3 { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 9.5px; color:#111; }
    .p3 * { box-sizing: border-box; }
    .seccion-titulo { color:#b30000; font-weight:800; margin: 6px 0; text-transform: uppercase; }
    table { width:100%; border-collapse: collapse; }
    th, td { padding:4px 6px; vertical-align: top; }
    .conborde th, .conborde td { border:1px solid #222; }
    .center { text-align:center; }
    .bg-encabezado { background:#fde7b4; font-weight:700; }
    .bg-cap { background:#e7f5e7; font-weight:700; }
    .bg-area { background:#ffd6d6; }
    .mini ul { margin:0 0 0 14px; padding:0; }
    .mini li { margin-bottom:3px; }
    .w-are { width:24px; padding:0 !important; }
    .w-cap { width:18%; }
    .w-std { width:22%; }
    .w-des { width:22%; }
    .w-crit{ width:16%; }
    .w-act { width:10%; }
    .w-evi { width:8%; }
    .w-ins { width:8%; }

    /* “Etiqueta” vertical del área */
    .vertical {
        writing-mode: vertical-rl;
        transform: rotate(180deg); /* fallback */
        text-align: center; font-weight:800; letter-spacing:1px;
    }
</style>

<div class="page-break"></div>
<div class="p3">
    <div class="seccion-titulo">V. Propósitos de aprendizaje</div>

    {{-- =========================
         COMUNICACIÓN – ORAL
    ========================== --}}
    <table class="conborde mini">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">COMUNICACIÓN</div></td>
            <td class="bg-cap">
                Se comunica oralmente en su lengua materna.
                <ul>
                    <li>Obtiene información del texto oral.</li>
                    <li>Infiere e interpreta información del texto oral.</li>
                    <li>Adecúa, organiza y desarrolla las ideas de forma coherente y cohesionada.</li>
                    <li>Utiliza recursos no verbales y paraverbales de forma estratégica.</li>
                    <li>Interactúa estratégicamente con distintos interlocutores.</li>
                    <li>Reflexiona y evalúa la forma, el contenido y contexto del texto oral.</li>
                </ul>
            </td>
            <td>
                Se comunica oralmente mediante diversos tipos de textos; identifica información explícita; infiere e interpreta hechos, tema y propósito. Organiza y desarrolla sus ideas en torno a un tema y las relaciona con conectores y referentes y vocabulario variado. Se apoya en recursos no verbales y paraverbales; reflexiona sobre textos escuchados a partir de su experiencia. Se expresa adecuándose a situaciones comunicativas formales e informales y adapta lo que dice según necesidades y puntos de vista de quien lo escucha, a través de comentarios y preguntas relevantes.
            </td>
            <td>
                <ul>
                    <li>Expresa oralmente ideas y emociones en torno a un tema sin reiteraciones innecesarias.</li>
                    <li>Participa en intercambios alternando roles de hablante y oyente; formula preguntas, explica sus respuestas y hace comentarios pertinentes; respeta normas de cortesía.</li>
                    <li>Opina como hablante y oyente sobre ideas y temas de textos orales a partir de su experiencia y contexto.</li>
                </ul>
            </td>
            <td>
                <ul>
                    <li>Planifica lo que va a realizar durante su exposición de instrucciones para una evacuación segura.</li>
                    <li>Participa con comentarios sobre terremotos ocurridos.</li>
                    <li>Emplea lenguaje y tono adecuados en el diálogo.</li>
                    <li>Comunica sus ideas con claridad sobre el buen uso de la tecnología.</li>
                    <li>Escucha con atención las exposiciones.</li>
                </ul>
            </td>
            <td>
                <div>Comparte las instrucciones de evacuación segura.</div>
                <div>Comparte recomendaciones para el buen uso de la tecnología.</div>
            </td>
            <td>Participación oral</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         COMUNICACIÓN – LECTURA
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">COMUNICACIÓN</div></td>
            <td class="bg-cap">
                Lee diversos tipos de textos en su lengua materna.
                <ul>
                    <li>Obtiene información del texto escrito.</li>
                    <li>Infiere e interpreta información del texto.</li>
                    <li>Reflexiona y evalúa la forma, el contenido y el contexto del texto.</li>
                </ul>
            </td>
            <td>
                Lee textos de estructura simple con algunos elementos complejos y vocabulario variado. Obtiene información poco evidente distinguiéndola de otras próximas; realiza inferencias locales; interpreta el texto considerando información relevante y reflexiona sobre ideas importantes, explicando la intención de recursos textuales comunes desde su experiencia.
            </td>
            <td>
                <ul>
                    <li>Identifica información explícita en distintas partes del texto (estructura simple y algunas complejidades).</li>
                    <li>Predice de qué tratará el texto por indicios (silueta, palabras, frases, colores, dimensiones de imágenes) y contrasta con lo leído.</li>
                    <li>Explica tema, propósito, enseñanza, relaciones texto-ilustración; reconoce adjetivaciones y motivaciones de personajes.</li>
                    <li>Opina sobre el contenido y justifica preferencias; reflexiona sobre textos que lee.</li>
                </ul>
            </td>
            <td>
                <div>Predice por el título e imágenes.</div>
                <div>Interpreta y responde preguntas de comprensión.</div>
                <div>Identifica pronombres personales y demostrativos.</div>
                <div>Identifica oraciones bimembres y unimembres; clasifica oraciones.</div>
                <div>Identifica palabras con hiato.</div>
                <div>Reconoce estructura de cada texto.</div>
                <div>Explica la importancia del buen uso de la tecnología y la enseñanza del texto.</div>
                <div>Opina y justifica con base en la información leída.</div>
            </td>
            <td>
                <div>Los pronombres personales y demostrativos<br><em>(Leemos historias de sobrevivientes de terremotos)</em></div>
                <div>Oración bimembre y unimembre</div>
                <div>La oración y sus clases <em>(Leemos sobre los adultos mayores)</em></div>
                <div>Identificamos diptongo y triptongo <em>(La IA en la educación)</em></div>
                <div>Uso responsable del celular, tablet o computadora <em>(El hiato)</em></div>
            </td>
            <td>
                <div>Responde preguntas de comprensión</div>
                <div>Organizador visual</div>
                <div>Resuelve fichas de aplicación</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         COMUNICACIÓN – ESCRITURA
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">COMUNICACIÓN</div></td>
            <td class="bg-cap">
                Escribe diversos tipos de textos en su lengua materna.
                <ul>
                    <li>Adecúa el texto a la situación comunicativa.</li>
                    <li>Organiza y desarrolla ideas de forma coherente y cohesionada.</li>
                    <li>Utiliza convenciones del lenguaje escrito.</li>
                    <li>Reflexiona y evalúa forma, contenido y contexto.</li>
                </ul>
            </td>
            <td>
                Escribe de forma reflexiva; adecúa texto a destinatario, propósito y registro; organiza y desarrolla lógicamente ideas; usa conectores y referentes; vocabulario variado; recursos ortográficos básicos; reflexiona sobre coherencia y cohesión y el uso de recursos textuales.
            </td>
            <td>
                <ul>
                    <li>Adecúa el texto según propósito, destinatario y tipo textual.</li>
                    <li>Escribe de forma coherente y cohesionada; establece relaciones (causa-efecto, secuencia) con conectores y referentes.</li>
                    <li>Utiliza y revisa recursos gramaticales y ortográficos para dar sentido al texto.</li>
                </ul>
            </td>
            <td>
                <div>Planifica, elabora, revisa y obtiene versión final.</div>
                <div>Incluye recursos textuales (imágenes/dibujos) para instrucciones de evacuación segura.</div>
                <div>Planifica y escribe un díptico con recomendaciones de buen uso de tecnología.</div>
            </td>
            <td>
                <div>Escribe un texto informativo sobre los sismos.</div>
                <div>Las preposiciones (instrucciones para una evacuación segura).</div>
                <div>Escribe un díptico con recomendaciones de buen uso de la tecnología.</div>
            </td>
            <td>
                <div>Texto informativo</div>
                <div>Texto instructivo</div>
                <div>Díptico</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- A partir de aquí puedes repetir el mismo patrón por área/competencia.
       Incluyo las secciones de Matemática, CyT, Personal Social, Arte y Religión. --}}

    {{-- =========================
         MATEMÁTICA – CANTIDAD
    ========================== --}}
    <table class="conborde mini" style="margin-top:10px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">MATEMÁTICA</div></td>
            <td class="bg-cap">
                Resuelve problemas de cantidad.
                <ul>
                    <li>Traduce cantidades a expresiones numéricas.</li>
                    <li>Comunica su comprensión de números y operaciones.</li>
                    <li>Usa estrategias y procedimientos de estimación y cálculo.</li>
                    <li>Argumenta relaciones numéricas y operaciones.</li>
                </ul>
            </td>
            <td>
                Resuelve problemas de agregar, quitar, igualar, repetir o repartir; combina colecciones; fracciones usuales; valor posicional hasta cuatro cifras; propiedades y nociones básicas de multiplicación/división; fracción como parte-todo; equivalencias; usando lenguaje numérico y diversas representaciones.
            </td>
            <td>
                <ul>
                    <li>Establece relaciones y modela con adición, sustracción, multiplicación y división (hasta tres cifras).</li>
                    <li>Comprende centena, valor posicional y orden/comparación de números.</li>
                    <li>Comprende multiplicación/división hasta 100; propiedad conmutativa.</li>
                    <li>Emplea estrategias: heurísticas, cálculo mental (descomposiciones, x10/÷10), aproximaciones.</li>
                    <li>Mide y compara masa (kg) y tiempo (horas exactas).</li>
                </ul>
            </td>
            <td>
                <div>Ubica datos clave para resolver operaciones.</div>
                <div>Usa material concreto en problemas de tiempo.</div>
                <div>Aplica multiplicación para múltiplos; explica procedimiento.</div>
                <div>Aplica división para divisores; explica procedimiento.</div>
                <div>Selecciona estrategias para mcm y mcd.</div>
                <div>Explica procedimientos en operaciones combinadas.</div>
            </td>
            <td>
                <div>Organizamos nuestro tiempo (pág.).</div>
                <div>Los múltiplos / Los divisores.</div>
                <div>MCM y MCD.</div>
                <div>Operaciones combinadas.</div>
            </td>
            <td>
                <div>Resuelve ficha de aplicación.</div>
                <div>Resuelve páginas del cuaderno de trabajo.</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         MATEMÁTICA – FORMA Y LOCALIZACIÓN
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">MATEMÁTICA</div></td>
            <td class="bg-cap">
                Resuelve problemas de forma, movimiento y localización.
                <ul>
                    <li>Modela con formas geométricas.</li>
                    <li>Comunica comprensión de formas y relaciones.</li>
                    <li>Se orienta en el espacio con procedimientos.</li>
                    <li>Argumenta relaciones geométricas.</li>
                </ul>
            </td>
            <td>
                Modela características y ubicación de objetos en 2D/3D, reconoce ángulos rectos, lados, vértices, líneas paralelas/perpendiculares, simetrías y traslaciones en cuadrículas; elabora croquis; usa medidas (longitud, superficie, capacidad) con unidades convencionales y no convencionales.
            </td>
            <td>
                <ul>
                    <li>Relaciona datos de ubicación/recorridos y los expresa en gráficos con puntos de referencia y ejes de simetría.</li>
                    <li>Representa elementos de formas 2D/3D.</li>
                    <li>Expresa medidas de longitud con distintas unidades.</li>
                    <li>Grafica desplazamientos y posiciones con lenguaje geométrico básico.</li>
                </ul>
            </td>
            <td>
                <div>Reconoce un croquis de la aula.</div>
                <div>Describe ruta segura usando centímetros.</div>
                <div>Explica recorridos entre zonas seguras.</div>
                <div>Selecciona estrategias para hallar medidas.</div>
            </td>
            <td>
                <div>Medimos rutas seguras (uso del centímetro).</div>
                <div>Representamos desplazamientos.</div>
            </td>
            <td>Ficha de aplicación</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         MATEMÁTICA – DATOS E INCERTIDUMBRE
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">MATEMÁTICA</div></td>
            <td class="bg-cap">
                Resuelve problemas de gestión de datos e incertidumbre.
                <ul>
                    <li>Representa datos.</li>
                    <li>Comunica conceptos estadísticos.</li>
                    <li>Recopila y procesa datos.</li>
                    <li>Sustenta conclusiones.</li>
                </ul>
            </td>
            <td>
                Trabaja con datos cualitativos y cuantitativos discretos; encuestas sencillas; tablas de frecuencia simples; pictogramas y barras simples (escala 2,5,10); interpreta información y usa moda; elabora conclusiones y toma decisiones; nociones de probabilidad cotidiana (seguro/más/menos probable).
            </td>
            <td>
                <ul>
                    <li>Representa características y comportamiento de datos con pictogramas y barras horizontales/verticales con escala.</li>
                </ul>
            </td>
            <td>
                <div>Comprende el problema.</div>
                <div>Representa gráficos (vertical y horizontal).</div>
                <div>Interpreta gráficos de barras.</div>
                <div>Explica el procedimiento seguido.</div>
            </td>
            <td>
                <div>Informamos mediante gráficos de barras.</div>
                <div>Elabora gráficos.</div>
                <div>Resuelve ficha de aplicación.</div>
            </td>
            <td>Ficha de aplicación</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         CIENCIA Y TECNOLOGÍA – INDAGA
    ========================== --}}
    <table class="conborde mini" style="margin-top:10px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">CIENCIA Y TECNOLOGÍA</div></td>
            <td class="bg-cap">
                Indaga mediante métodos científicos para construir conocimientos.
                <ul>
                    <li>Problematiza y diseña estrategias.</li>
                    <li>Genera/registra y analiza datos.</li>
                    <li>Evalúa y comunica resultados.</li>
                </ul>
            </td>
            <td>
                Indaga causas de hechos o fenómenos; formula preguntas e hipótesis; propone estrategias; registra datos; analiza relaciones y evidencias de causalidad; comunica procedimientos, dificultades, conclusiones y dudas.
            </td>
            <td>
                <ul>
                    <li>Hace preguntas e hipótesis basadas en regularidades.</li>
                    <li>Propone plan y selecciona materiales, instrumentos y fuentes.</li>
                    <li>Obtiene datos (medidas, registros, organizadores).</li>
                    <li>Establece relaciones y elabora conclusiones.</li>
                    <li>Comunica lo aprendido y propone mejoras.</li>
                </ul>
            </td>
            <td>
                <div>Plantea hipótesis y plan de indagación.</div>
                <div>Explica reacción del sistema nervioso y excretor en emergencias con fuentes confiables.</div>
                <div>Obtiene información y elabora organizador visual.</div>
                <div>Explica tecnologías de alerta y prevención.</div>
                <div>Escribe conclusiones fundamentadas.</div>
            </td>
            <td>
                <div>El sistema nervioso en emergencias.</div>
                <div>El sistema excretor y su importancia en emergencias.</div>
                <div>Indagamos tecnologías para alertar y prevenir fenómenos naturales.</div>
            </td>
            <td>
                <div>Organizador visual</div>
                <div>Conclusiones</div>
                <div>Experimento</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         CIENCIA Y TECNOLOGÍA – EXPLICA EL MUNDO FÍSICO
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">CIENCIA Y TECNOLOGÍA</div></td>
            <td class="bg-cap">
                Explica el mundo físico (seres vivos, materia/energía, biodiversidad, Tierra y universo).
            </td>
            <td>
                Explica con evidencias relaciones entre energía y cambios en materiales; fuerzas y movimiento; estructura/función de sistemas vivos; radiación solar y zonas climáticas; impactos de tecnologías en problemas de vida colectiva.
            </td>
            <td>
                <ul>
                    <li>Relaciona desplazamientos y cambios de forma por fuerzas.</li>
                    <li>Compara manifestaciones del clima; describe zonas climáticas con respaldo científico y las aplica a situaciones cotidianas.</li>
                </ul>
            </td>
            <td>
                <div>Plantea y contrasta explicaciones a preguntas de investigación.</div>
                <div>Elabora y aplica plan con fichas informativas.</div>
                <div>Explica por qué ocurren huaycos, inundaciones y friaje; registra datos y elabora conclusión final.</div>
            </td>
            <td>
                <div>¿Cómo el cambio climático causa desastres?</div>
                <div>Explicamos por qué ocurren huaycos, inundaciones y friaje.</div>
            </td>
            <td>
                <div>Respuestas a la pregunta de investigación y conclusiones.</div>
                <div>Organizadores visuales.</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         CIENCIA Y TECNOLOGÍA – DISEÑA SOLUCIONES
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">CIENCIA Y TECNOLOGÍA</div></td>
            <td class="bg-cap">
                Diseña y construye soluciones tecnológicas para su entorno.
            </td>
            <td>
                Determina problema y causas; propone alternativas con base científica; representa partes/etapas; implementa con herramientas y materiales; valida, ajusta y comunica beneficios; evalúa y propone mejoras.
            </td>
            <td>
                <ul>
                    <li>Define problema y alternativas con requerimientos y recursos.</li>
                    <li>Representa solución con dibujos y textos; describe partes y pasos; selecciona materiales.</li>
                    <li>Construye la solución cumpliendo normas de seguridad y ecoeficiencia.</li>
                    <li>Explica materiales usados y aprendizajes.</li>
                </ul>
            </td>
            <td>
                <div>Propone prototipo para emergencia; selecciona materiales; explica funcionamiento y beneficios.</div>
            </td>
            <td>
                <div>Diseñamos un prototipo que ayude en situaciones de emergencia.</div>
                <div>Prototipo para emergencias.</div>
            </td>
            <td>Producto construido</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         PERSONAL SOCIAL – CONVIVE
    ========================== --}}
    <table class="conborde mini" style="margin-top:10px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">PERSONAL SOCIAL</div></td>
            <td class="bg-cap">
                Convive y participa democráticamente en la búsqueda del bien común.
            </td>
            <td>
                Se relaciona respetando diferencias; expresa desacuerdo ante situaciones que vulneran la convivencia; conoce manifestaciones culturales; construye/evalúa acuerdos y normas; dialoga para manejar conflictos; propone acciones colectivas para el bienestar común.
            </td>
            <td>
                <ul>
                    <li>Interviene ante conflictos recurriendo al diálogo.</li>
                    <li>Delibera sobre asuntos de interés público y participa en acciones colectivas (seguridad vial, etc.).</li>
                </ul>
            </td>
            <td>
                <div>Deliberan formación de brigadas escolares de emergencia.</div>
                <div>Proponen funciones de brigadas.</div>
                <div>Identifican riesgos en colegio y calle; proponen acciones.</div>
            </td>
            <td>
                <div>Brigadas escolares de emergencia.</div>
                <div>Deliberamos sobre situaciones de riesgo en el colegio y la calle.</div>
            </td>
            <td>
                <div>Participación oral</div>
                <div>Compromiso</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         PERSONAL SOCIAL – ESPACIO Y AMBIENTE
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">PERSONAL SOCIAL</div></td>
            <td class="bg-cap">
                Gestiona responsablemente el espacio y el ambiente.
            </td>
            <td>
                Reconoce causas y consecuencias de problemas ambientales; impacto de acciones cotidianas; lugares vulnerables y seguros; describe espacios geográficos; usa representaciones cartográficas sencillas.
            </td>
            <td>
                <ul>
                    <li>Describe problemas ambientales y propone/realiza actividades para solucionarlos y conservar el ambiente.</li>
                    <li>Identifica lugares seguros y vulnerables en la escuela y participa en prevención.</li>
                </ul>
            </td>
            <td>
                <div>Identifica diferencia entre fenómeno natural y desastre natural con ejemplos.</div>
                <div>Propone acciones para prevenir o reducir daños y reflexiona sobre impactos en su comunidad.</div>
            </td>
            <td>
                <div>Diferencia entre desastres naturales y fenómenos naturales.</div>
                <div>Fenómenos naturales en el Perú.</div>
                <div>Cómo afectan a las personas y a la comunidad.</div>
            </td>
            <td>
                <div>Organizador visual</div>
                <div>Ficha de aplicación</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         PERSONAL SOCIAL – RECURSOS ECONÓMICOS
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">PERSONAL SOCIAL</div></td>
            <td class="bg-cap">
                Gestiona responsablemente los recursos económicos.
            </td>
            <td>
                Diferencia necesidades/deseos; uso de servicios públicos y su costo; reconoce actividades económicas de su comunidad y su impacto en el bienestar.
            </td>
            <td>
                <ul>
                    <li>Explica que el trabajo permite obtener dinero para bienes/servicios.</li>
                    <li>Explica importancia del ahorro (efectivo y billeteras digitales).</li>
                    <li>Menciona uso del dinero en desastres; se compromete a ahorrar y gastar con criterio.</li>
                </ul>
            </td>
            <td>
                <div>El dinero y las billeteras digitales durante fenómenos naturales.</div>
            </td>
            <td>El dinero y las billeteras digitales</td>
            <td>Compromiso</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         ARTE Y CULTURA
    ========================== --}}
    <table class="conborde mini" style="margin-top:10px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">ARTE Y CULTURA</div></td>
            <td class="bg-cap">
                Crea proyectos desde los lenguajes artísticos.
            </td>
            <td>
                Crea proyectos que comunican experiencias, ideas y sentimientos; explora y combina elementos del arte; usa medios, materiales y técnicas; planifica y adecua procesos a intenciones.
            </td>
            <td>
                <ul>
                    <li>Improvisa y experimenta con elementos del arte y medios/materiales/técnicas.</li>
                    <li>Planifica proyectos inspirándose en cómo otros artistas usan elementos/técnicas.</li>
                </ul>
            </td>
            <td>
                <div>Planifica y experimenta materiales; realiza robot con material reciclado; comparte procesos con sus compañeros.</div>
            </td>
            <td>
                <div>Manualidad por día del niño.</div>
                <div>Collage de un desastre natural.</div>
                <div>Manualidad de Santa Rosa de Lima.</div>
                <div>Robot articulado.</div>
            </td>
            <td>
                <div>Manualidad / Collage</div>
                <div>Santa Rosa de Lima</div>
                <div>Robot articulado</div>
            </td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         RELIGIÓN – IDENTIDAD Y CONVIVENCIA CRISTIANA
    ========================== --}}
    <table class="conborde mini" style="margin-top:10px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">RELIGIÓN</div></td>
            <td class="bg-cap">
                Construye su identidad como persona humana amada por Dios; convive cristianamente.
            </td>
            <td>
                Describe el amor de Dios en la creación/Salvación; construye su identidad como hijo de Dios; participa en la Iglesia; promueve convivencia armónica basada en diálogo, respeto, tolerancia y amor fraterno.
            </td>
            <td>
                <ul>
                    <li>Identifica la acción de Dios en la Historia de la Salvación.</li>
                    <li>Se compromete con una convivencia cristiana basada en el diálogo y respeto.</li>
                </ul>
            </td>
            <td>
                <div>Explica por qué cayeron las plagas de Egipto; menciona las 10 plagas; valora el poder de Dios.</div>
                <div>Identifica que Jesús calmó la tormenta; reflexiona sobre confiar en Dios en momentos difíciles.</div>
            </td>
            <td>
                <div>Las plagas de Egipto.</div>
                <div>Jesús calma la tempestad.</div>
            </td>
            <td>Ficha / Compromiso</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>

    {{-- =========================
         RELIGIÓN – PROYECTO DE VIDA
    ========================== --}}
    <table class="conborde mini" style="margin-top:8px;">
        <thead>
        <tr class="bg-encabezado center">
            <th class="w-are">Ár<br>ea</th>
            <th class="w-cap">Competencias / Capacidades</th>
            <th class="w-std">Estándares</th>
            <th class="w-des">Desempeños de 3°</th>
            <th class="w-crit">Criterios de evaluación</th>
            <th class="w-act">Actividad</th>
            <th class="w-evi">Evidencia</th>
            <th class="w-ins">Inst. de evaluación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-area"><div class="vertical">RELIGIÓN</div></td>
            <td class="bg-cap">
                Asume el encuentro personal y comunitario con Dios en su proyecto de vida.
            </td>
            <td>
                Expresa coherencia entre lo que cree, dice y hace; comprende su dimensión religiosa/trascendente; establece propósitos de cambio a la luz del Evangelio; celebra su fe con gratitud; respeta y cuida lo creado.
            </td>
            <td>
                <ul>
                    <li>Descubre el amor de Dios proponiendo acciones para mejorar la relación con su familia y escuela.</li>
                    <li>Participa en momentos de encuentro con Dios; practica la oración.</li>
                </ul>
            </td>
            <td>
                <div>Identifica acciones de virtudes divinas para ayudar a los demás; relaciona enseñanzas bíblicas con su vida; valora la solidaridad como amor cristiano (compromiso).</div>
                <div>Reconoce virtudes de Santa Rosa de Lima y las relaciona con acciones personales.</div>
            </td>
            <td>
                <div>La solidaridad como valor cristiano.</div>
                <div>Virtudes de Santa Rosa de Lima.</div>
            </td>
            <td>Escribe su compromiso con Dios</td>
            <td>Lista de cotejo</td>
        </tr>
        </tbody>
    </table>
</div>
