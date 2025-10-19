<script setup>
import { toRefs, onMounted, computed, ref } from 'vue';
import useArea from '@/Composables/Area.js'
import usePropositoAprendizaje from '@/Composables/PropositoAprendizaje.js'
import useHelper from '@/Helpers';  
const { hideModal, Toast, Swal } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number,
    propositos: Array,
});
const { form, currentPage, propositos } = toRefs(props)
const  emit  =defineEmits(['onListar', 'obtenerPropositos'])
const {
    listaAreas, areas
} = useArea();
const {
    agregarProposito, respuesta, errors, eliminarProposito
} = usePropositoAprendizaje();

const activarCard = ref(false);
const tituloCard = ref('');
const actividad=ref({
    orden: 1,
    proposito_aprendizaje_id : '',
    desempeño_id : '',
    criterio_evaluacion_id : '',
    titulo : '',
    enfoque_transversal : '',
    actitud_observable : '',
    competencia_transversal : '',
    desempeños : '',
    que_se_debe_hacer : '',
    recursos_materiales : '',
    inicio_duracion : '',
    inicio_actividad : '',
    desarrollo_duracion : '',
    desarrollo_actividad : '',
    cierre_duracion : '',
    cierre_actividad : '',
});
const limpiarActividad = () => {
    actividad.value = {
        orden: form.value.actividades.length + 1,
        proposito_aprendizaje_id : '',
        desempeño_id : '',
        criterio_evaluacion_id : '',
        titulo : '',
        enfoque_transversal : '',
        actitud_observable : '',
        competencia_transversal : '',
        desempeños : '',
        que_se_debe_hacer : '',
        recursos_materiales : '',
        inicio_duracion : 15,
        inicio_actividad : '',
        desarrollo_duracion : 70,
        desarrollo_actividad : '',
        cierre_duracion : 5,
        cierre_actividad : '',
    }
}
const guardar = async() => {
    await agregarProposito(form.value)
    form.value.errors = []
    if(errors.value)
    {
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        emit('obtenerPropositos', form.value.plantilla_unidad_id)
    }
}
const areasFiltradas = computed(() => {
  if (form.value.tiene_educacion_fisica) {
    return areas.value
  } else {
    return areas.value.filter(a => a.nombre !== "Educación Física")
  }
})
const item = ref('');
const nuevoDesempeño = () => {
    activarCard.value = true;
    tituloCard.value = 'Nuevo Desempeño';
}
const nuevoCriterio = () => {
    activarCard.value = true;
    tituloCard.value = 'Nuevo Criterio de Evaluación';
}
const eliminarRegProposito = (id) => {
    Swal.fire({
        title: '¿Estás seguro de Eliminar?',
        text: "Menu",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {
            elimina(id)
        }
    })
}
const elimina = async(id) => {
    await eliminarProposito(id)
    form.value.errors = []
    if(errors.value)
    {
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        emit('obtenerPropositos', form.value.plantilla_unidad_id)
    }
}
const verActividad = (act) => {
    activarCard.value = true;
    tituloCard.value = 'Nueva Actividad';
    actividad.value = {...act};
}
const agregar = () => {
    if(item.value==''){
        return
    }
    if (tituloCard.value === 'Nuevo Desempeño') {
        form.value.desempeños.push({ id: Date.now(), nombre: item.value });
    } else if (tituloCard.value === 'Nuevo Criterio de Evaluación') {
        form.value.criterio_evaluacions.push({ id: Date.now(), nombre: item.value });
    } else if (tituloCard.value === 'Nueva Actividad') {
        form.value.actividades.push({...actividad.value});
        limpiarActividad();
        return;
    }
    item.value = '';
}

onMounted(() => {
    listaAreas()
})
</script>
<template>
    <div class="modal fade" id="modalProposito" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalPropositoLabel" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="modalPropositoLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <h4>UNIDAD N° {{ form.nro_unidad }} :  {{ form.nombre_unidad }}</h4>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <h4>GRADO : {{ form.grado }}</h4>
                                </div>
                                <div class="col">
                                    <h4>REGION : {{ form.region }}</h4>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="area_id" class="form-label">Area</label>
                                    <select v-model="form.area_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.area_id }">
                                        <option value="" hidden>Seleccione</option>
                                        <option v-for="area in areasFiltradas" :key="area.id" :value="area.id"
                                            :title="area.nombre">
                                            {{ area.nombre }}
                                        </option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.area_id" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="instrumento_evaluacion" class="form-label">Instrumento Evaluación</label>
                                    <select v-model="form.instrumento_evaluacion" class="form-control"
                                            :class="{ 'is-invalid': form.errors.instrumento_evaluacion }">
                                        <option value="" hidden>Seleccione</option>
                                        <option value="prueba_escrita">Prueba escrita</option>
                                        <option value="prueba_oral">Prueba oral</option>
                                        <option value="cuestionario">Cuestionario</option>
                                        <option value="LISTA DE COTEJO">Lista de cotejo</option>
                                        <option value="rubrica">Rúbrica</option>
                                        <option value="portafolio">Portafolio</option>
                                        <option value="trabajo_practico">Trabajo práctico</option>
                                        <option value="proyecto">Proyecto</option>
                                        <option value="exposicion">Exposición</option>
                                        <option value="debate">Debate</option>
                                        <option value="ensayo">Ensayo</option>
                                        <option value="taller">Taller</option>
                                        <option value="guia_observacion">Guía de observación</option>
                                        <option value="autoevaluacion">Autoevaluación</option>
                                        <option value="coevaluacion">Coevaluación</option>
                                    </select>
                                    <small class="text-danger" 
                                        v-for="error in form.errors.instrumento_evaluacion" 
                                        :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="evidencia" class="form-label">Evidencia</label>
                                    <select v-model="form.evidencia" class="form-control"
                                            :class="{ 'is-invalid': form.errors.evidencia }">
                                        <option value="" hidden>Seleccione</option>
                                        <option value="Participación oral">Participación oral</option>
                                        <option value="Responde preguntas de comprensión">Responde preguntas de comprensión</option>
                                        <option value="Organizador visual">Organizador visual</option>
                                        <option value="Resuelve fichas de aplicación">Resuelve fichas de aplicación</option>
                                        <option value="Texto informativo">Texto informativo </option>
                                        <option value="Texto instructivo">Texto instructivo</option>
                                        <option value="Díptico">Díptico </option>
                                    </select>
                                    <small class="text-danger" 
                                        v-for="error in form.errors.evidencia" 
                                        :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" rows="3" v-model="form.descripcion"
                                                :class="{ 'is-invalid': form.errors.descripcion }"
                                                placeholder="Descripción"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.descripcion" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="competencia_capacidades" class="form-label">Competencia/Capacidades</label>
                                    <textarea class="form-control" rows="3" v-model="form.competencia_capacidades"
                                                :class="{ 'is-invalid': form.errors.competencia_capacidades }"
                                                placeholder="Competencia"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.competencia_capacidades" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="estandares" class="form-label">Estandares</label>
                                    <textarea class="form-control" rows="3" v-model="form.estandares"
                                                :class="{ 'is-invalid': form.errors.estandares }"
                                                placeholder="Estandares"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.estandares" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <div class="btn-group mb-3">
                                        <button type="button" class="btn btn-primary mt-4"
                                            @click="nuevoDesempeño()">
                                            + Desempeño
                                        </button>
                                        <button type="button" class="btn btn-info mt-4"
                                            @click="nuevoCriterio()">
                                            + Criterio de Evaluacion
                                        </button>
                                       
                                    </div>
                                    <div class="text-danger" v-for="error in form.errors.desempeños" :key="error">Desempeño {{ error }}</div>
                                    <div class="text-danger" v-for="error in form.errors.criterio_evaluacions" :key="error">Criterio Evaluacion {{ error }}</div>
                                    <div class="text-danger" v-for="error in form.errors.actividades" :key="error">Actividades {{ error }}</div>

                                    <div v-if="tituloCard === 'Nueva Actividad'">
                                        <h5>Actividades</h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Accion</th>
                                            </tr>
                                            <tr v-for="(act, index) in form.actividades" :key="act.id">
                                                <td>{{ index+1 }}</td>
                                                <td>{{ act.titulo }}</td>
                                                <td>
                                                    <button title="Ver" class="btn btn-xs p-2 btn-outline-info" @click="verActividad(act)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>&nbsp;
                                                    <button title="Eliminar" class="btn btn-xs p-2 btn-outline-danger" @click="form.actividades.splice(index, 1)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <button type="button" @click="guardar()" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <div class="card mb-3" v-if="activarCard">
                        <div class="card-header">
                            <h5>{{ tituloCard }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label id="tituloCard" class="form-label">{{ tituloCard }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="item"
                                            :class="{ 'is-invalid': form.errors.nombre_unidad }" placeholder="Nombre de la unidad">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="agregar()">Agregar</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div v-if="tituloCard === 'Nuevo Desempeño'">
                                        <h5>Desempeños</h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Accion</th>
                                            </tr>
                                            <tr v-for="(desempeño, index) in form.desempeños" :key="desempeño.id">
                                                <td>{{ index+1 }}</td>
                                                <td>{{ desempeño.nombre }}</td>
                                                <td>
                                                    <button title="Eliminar" class="btn btn-xs p-2 btn-outline-danger" @click="form.desempeños.splice(index, 1)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div v-else-if="tituloCard === 'Nuevo Criterio de Evaluación'">
                                        <h5>Criterios de Evaluación</h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Accion</th>
                                            </tr>
                                            <tr v-for="(criterio, index) in form.criterio_evaluacions" :key="criterio.id">
                                                <td>{{ index+1 }}</td>
                                                <td>{{ criterio.nombre }}</td>
                                                <td>
                                                    <button title="Eliminar" class="btn btn-xs p-2 btn-outline-danger" @click="form.criterio_evaluacions.splice(index, 1)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="propositos.length>0" class="card mb-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Propositos</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nro</th>
                                    <th>Descripcion</th>
                                    <th>Competencias Capacidades</th>
                                    <th>Instrumento Evaluacion</th>
                                    <th>Accion</th>
                                </tr>
                                <tr v-for="(item, index) in propositos" :key="item.id">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ item.descripcion }}</td>
                                    <td>{{ item.competencia_capacidades }}</td>
                                    <td>{{ item.instrumento_evaluacion }}</td>
                                    <td>
                                        <button title="Eliminar" class="btn btn-xs p-2 btn-outline-danger" @click="eliminarRegProposito(item.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>