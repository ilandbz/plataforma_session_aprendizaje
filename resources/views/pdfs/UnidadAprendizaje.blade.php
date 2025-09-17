<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UNIDAD DE APRENDIZAJE</title>
    <style>
        @page { margin: 20px 25px; size: A4 landscape; }
        * { box-sizing: border-box; }
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color:#111; 
            background: url(imagenes/logo_opaco.png) no-repeat center center fixed;
            background-size: contain; /* Cambia cover por contain */
            background-position: center;
        
        }
        .marco {
            border: 10px solid transparent;
            padding: 10px;
            background:
                linear-gradient(#fff,#fff) padding-box,
                repeating-linear-gradient(45deg,#f9a 0 10px,#9cf 10px 20px,#f9a 20px 30px) border-box;
        }
        .encabezado {
            position: relative;
            padding: 8px 12px 0 12px;
        }
        .encabezado .escudo {
            position:absolute; top:-8px; left:-8px; width:70px; height:auto;
        }
        .encabezado .escudo-der {
            position:absolute; top:-8px; right:-8px; width:70px; height:auto;
        }
        .agua {
            position: fixed;
            inset: 0;
            z-index: -1;
            opacity: .08;
        }
        h1.titulo {
            margin: 0 auto 6px auto;
            display: inline-block;
            padding: 6px 18px;
            border: 1px solid #caa36b;
            background: #f4e2c5;
            border-radius: 4px;
            font-size: 18px;
            text-transform: uppercase;
        }
        .banda {
            text-align: center;
            font-style: italic;
            font-size: 10px;
            margin-bottom: 6px;
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px 6px; vertical-align: top; }
        .conborde th, .conborde td { border: 1px solid #222; }
        .w-60 { width: 60%; }
        .w-40 { width: 40%; }
        .w-70 { width: 70%; }
        .w-30 { width: 30%; }

        .seccion-titulo {
            color:#b30000; font-weight: 800; margin: 8px 0 4px 0;
        }
        .caja-titulo {
            border: 1px solid #222; background: #fde7b4; text-align: center;
            font-weight: 800; padding: 8px; text-transform: uppercase;
        }
        .caja-productos {
            background: #e4f7e4; border: 1px solid #3a7e3a; padding: 6px; font-weight: 700;
        }
        .resaltado-amarillo { background: #fffd9e; }
        .mt-6 { margin-top: 6px; }
        .mb-6 { margin-bottom: 6px; }
        .small { font-size: 10px; }
        .right { text-align: right; }
        .center { text-align: center; }

        /* “tarjeta” derecha con imagen */
        .grid {
            display: table; width:100%;
        }
        .col { display: table-cell; vertical-align: top; }
        .col-izq { width: 65%; padding-right:10px; }
        .col-der { width: 35%; }
        .panel-img { border:1px solid #ddd; padding:6px; }
        .panel-img img { width:100%; height:auto; display:block; }
        .logo-sup { width:60px; vertical-align: middle; }
    </style>
</head>
<body>
    {{-- Marca de agua opcional --}}
    @if(file_exists(public_path('imagenes/marca_agua.png')))
        <img class="agua" src="{{ public_path('imagenes/marca_agua.png') }}" alt="">
    @endif

    <div class="marco">
        <div class="encabezado">
            @if(file_exists(public_path('imagenes/escudo.png')))
                <img class="escudo" src="{{ public_path('imagenes/escudo.png') }}" alt="Escudo">
            @endif
            @if(file_exists(public_path('imagenes/escudo.png')))
                <img class="escudo-der" src="{{ public_path('imagenes/escudo.png') }}" alt="Escudo">
            @endif>

            <div class="banda">“Año de la recuperación y consolidación de la economía peruana”</div>
            <div class="center">
                <h1 class="titulo">
                    UNIDAD DE APRENDIZAJE N°{{ $registro->numero_unidad ?? '—' }} – {{ $registro->grado ? $registro->grado.'°' : '—' }}
                </h1>
            </div>
        </div>

        <div class="grid">
            <div class="col col-izq">
                {{-- I. DATOS INFORMATIVOS --}}
                <div class="seccion-titulo">I. DATOS INFORMATIVOS:</div>
                <table class="conborde">
                    <tr>
                        <th class="w-30">I.E</th>
                        <td class="w-70">{{ $registro->institucion_educativa->nombre ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>DIRECTOR</th>
                        <td>{{ $registro->director ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>SUB DIRECTOR</th>
                        <td>{{ $registro->sub_director ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>PROFESOR</th>
                        <td>{{ $registro->profesor ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>GRADO Y SECCIÓN</th>
                        <td>
                            {{ $registro->grado ? $registro->grado.'°' : '—' }}
                            {{ $registro->seccion ? ' - '.$registro->seccion : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>PERÍODO DE EJECUCIÓN</th>
                        <td>
                            @php
                                $fi = $registro->fecha_inicio ?? null;
                                $ff = $registro->fecha_fin ?? null;
                            @endphp
                            {{ $fi ? \Carbon\Carbon::parse($fi)->translatedFormat('d \d\e F') : '—' }}
                            {{ $ff ? ' al '.\Carbon\Carbon::parse($ff)->translatedFormat('d \d\e F') : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>ÁREAS</th>
                        <td>{{ $registro->areas ?? 'Comunicación, Matemática, Personal Social, Tutoría, Ciencia y Tecnología, Arte, Religión y Educación Física' }}</td>
                    </tr>
                </table>
            </div>

            <div class="col col-der">
                {{-- Imagen ilustrativa / panel derecho --}}
                <div class="panel-img">
                    @if(file_exists(public_path('imagenes/bomberos.png')))
                        <img src="{{ public_path('imagenes/bomberos.png') }}" alt="Ilustración">
                    @else
                        <div class="center small" style="padding:40px 10px">[ Imagen ilustrativa ]</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- II. TÍTULO --}}
        <div class="seccion-titulo">II. TÍTULO DE LA UNIDAD DE APRENDIZAJE</div>
        <div class="caja-titulo">
            {{ strtoupper($registro->nombre_unidad ?? '—') }}
        </div>

        {{-- III. SITUACIÓN SIGNIFICATIVA --}}
        <div class="seccion-titulo">III. SITUACIÓN SIGNIFICATIVA</div>
        <div class="mb-6" style="text-align: justify; line-height: 1.35;">
            @if(!empty($registro?->situacion_significativa))
                {!! $registro->situacion_significativa !!}
            @else
                Los estudiantes del 3° han observado que el Perú es un país en el cual sucede diferentes fenómenos
                naturales dependiendo de la zona donde vivan, puede haber huaycos, inundaciones, temblores,
                terremotos, heladas, friajes, etc. Muchos de sus hogares desconocen las acciones a realizar para
                prevenir y enfrentar posibles situaciones de riesgo, por otro lado, no conocen los riesgos que pueden
                tener usar inadecuadamente la tecnología que actualmente es un gran aliado.
                <br><br>
                <span class="resaltado-amarillo">
                    A partir de esta situación, planteamos el siguiente reto:
                    ¿Qué situaciones de riesgo ocurren en tu localidad? ¿Cómo podemos actuar frente a los fenómenos
                    naturales? ¿Cómo podemos prevenir situaciones de riesgo? ¿Sabes cuál es el adecuado uso de la tecnología?
                </span>
            @endif
        </div>

        {{-- PRODUCTOS --}}
        <div class="caja-productos">
            PRODUCTOS:
            {!! $registro->productos !!}
        </div>

        {{-- Pie opcional con logo --}}
        <div class="mt-6 right small">
            @if(file_exists(public_path('imagenes/logo.png')))
                <img src="{{ public_path('imagenes/logo.png') }}" class="logo-sup" alt="Logo">
            @endif
        </div>




    </div>
    @include('pdfs.pagina2')
    @include('pdfs.pagina3')
    @include('pdfs.pagina4')
    @include('pdfs.pagina5')
    @include('pdfs.pagina6')
    @include('pdfs.pagina7')
</body>
</html>
