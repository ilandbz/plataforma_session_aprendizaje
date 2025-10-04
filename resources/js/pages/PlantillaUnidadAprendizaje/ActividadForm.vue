<script setup>
import { toRefs, onMounted, watch, ref, onUnmounted } from 'vue';
import usePropositoAprendizaje from '@/Composables/PropositoAprendizaje.js'
import useActividadAprendizaje from '@/Composables/ActividadAprendizaje.js'
import useHelper from '@/Helpers';  
const { hideModal, Toast, Swal } = useHelper();
const {
    obtenerProposito, proposito
} = usePropositoAprendizaje()
const {
    respuesta, agregarActividad, errors, eliminarActividad
} = useActividadAprendizaje()
const props = defineProps({
    form: Object,
    propositos: Array,
});
const { form, propositos } = toRefs(props)
const  emit  =defineEmits(['limpiar'])
const listaDesempeños = ref([]) 
const listaCriterios = ref([]) 
const listaActividades = ref([])
const listardatos =async()=>{
    await obtenerProposito(form.value.proposito_aprendizaje_id)
    listaDesempeños.value = proposito.value.desempeños || []
    listaCriterios.value = proposito.value.criterios || []
    listaActividades.value = proposito.value.actividades || []
}
const ensureDefaultProposito = () => {
  const lista = Array.isArray(propositos.value) ? propositos.value : []
  if (lista.length && !form.value.proposito_aprendizaje_id) {
    form.value.proposito_aprendizaje_id = lista[0].id
    form.value.orden = (lista[0].actividades?.length || 0) + 1
    listaDesempeños.value = lista[0].desempeños || []
    listaCriterios.value = lista[0].criterios || []
    listaActividades.value = lista[0].actividades || []
  }
}
onMounted(() => {
  ensureDefaultProposito()

  const el = document.getElementById('modalActividad')
  const onShown = () => ensureDefaultProposito()
  el?.addEventListener('shown.bs.modal', onShown)

  onUnmounted(() => el?.removeEventListener('shown.bs.modal', onShown))
})
const guardar = async() =>{
    await agregarActividad(form.value)
    form.value.errors = []
    if(errors.value)
    {
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        emit('limpiar')        
        listardatos()
    }
}
const eliminar = (id) => {
    Swal.fire({
        title: '¿Estás seguro de Eliminar?',
        text: "Actividad",
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
    await eliminarActividad(id)
    form.value.errors = []
    if(errors.value)
    {
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        listardatos()
    }
}
watch(propositos, () => ensureDefaultProposito())
</script>
<template>
    <div class="modal fade" id="modalActividad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalActividadLabel" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="modalActividadLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="orden" class="form-label">Orden</label>
                                    <input type="number" class="form-control" v-model.number="form.orden" min="1" max="120" step="1">
                                </div>
                                <div class="col">
                                    <label for="proposito_aprendizaje_id" class="form-label">Proposito</label>
                                    <select v-model="form.proposito_aprendizaje_id" class="form-control" @change="listardatos()">
                                        <option v-for="item in propositos" :key="item.id" :value="item.id"
                                            :title="item.descripcion">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>              
                                    <small class="text-danger" v-for="error in form.errors.proposito_aprendizaje_id" :key="error">{{ error }}</small>                      
                                </div>
                                <div class="col">
                                    <label for="desempeño_id" class="form-label">Desempeño</label>
                                    <select v-model="form.desempeño_id" class="form-control">
                                        <option value="" hidden>Seleccione</option>
                                        <option v-for="item in listaDesempeños" :key="item.id" :value="item.id"
                                            :title="item.descripcion">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="criterio_evaluacion_id" class="form-label">Criterio de Evaluacion</label>
                                    <select v-model="form.criterio_evaluacion_id" class="form-control">
                                        <option value="" hidden>Seleccione</option>
                                        <option v-for="item in listaCriterios" :key="item.id" :value="item.id"
                                            :title="item.descripcion">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.criterio_evaluacion_id" :key="error">{{ error }}</small> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="titulo" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" v-model="form.titulo" placeholder="Titulo">
                                    <small class="text-danger" v-for="error in form.errors.titulo" :key="error">{{ error }}</small>
                                </div>                                
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="enfoque_transversal" class="form-label">Enfoque Transversal</label>
                                    <textarea class="form-control" rows="3" v-model="form.enfoque_transversal" placeholder="enfoque_transversal"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.enfoque_transversal" :key="error">{{ error }}</small> 
                                </div>
                                <div class="col">
                                    <label for="actitud_observable" class="form-label">Actitud Observable</label>
                                    <textarea class="form-control" rows="3" v-model="form.actitud_observable" placeholder="actitud_observable"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.actitud_observable" :key="error">{{ error }}</small> 
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="competencia_transversal" class="form-label">Competencia Transversal</label>
                                    <textarea class="form-control" rows="3" v-model="form.competencia_transversal" placeholder="competencia_transversal"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.competencia_transversal" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="desempeños" class="form-label">Desempeños</label>
                                    <textarea class="form-control" rows="3" v-model="form.desempeños" placeholder="desempeños"></textarea> 
                                    <small class="text-danger" v-for="error in form.errors.desempeños" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="que_se_debe_hacer" class="form-label">Que se debe hacer</label>
                                    <textarea class="form-control" rows="3" v-model="form.que_se_debe_hacer" placeholder="que_se_debe_hacer"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.que_se_debe_hacer" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="recursos_materiales" class="form-label">Recursos Materiales</label>
                                    <textarea class="form-control" rows="3" v-model="form.recursos_materiales" placeholder="recursos_materiales"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.recursos_materiales" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="inicio_actividad" class="form-label">Inicio Actividad</label>
                                    <textarea class="form-control" rows="3" v-model="form.inicio_actividad" placeholder="inicio_actividad"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.inicio_actividad" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="inicio_duracion" class="form-label">Inicio Duracion (min)</label>
                                    <input type="number" class="form-control" v-model.number="form.inicio_duracion"
                                            placeholder="Ej: 15"
                                            min="1" max="120" step="1">
                                    <small class="text-danger" v-for="error in form.errors.inicio_duracion" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="desarrollo_actividad" class="form-label">Desarrollo Actividad</label>
                                    <textarea class="form-control" rows="3" v-model="form.desarrollo_actividad" placeholder="desarrollo_actividad"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.desarrollo_actividad" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="desarrollo_duracion" class="form-label">Desarrollo Duracion (min)</label>
                                    <input type="number" class="form-control" v-model.number="form.desarrollo_duracion"
                                            placeholder="Ej: 70"
                                            min="1" max="120" step="1">
                                    <small class="text-danger" v-for="error in form.errors.desarrollo_duracion" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="cierre_actividad" class="form-label">Cierre Actividad</label>
                                    <textarea class="form-control" rows="3" v-model="form.cierre_actividad" placeholder="cierre_actividad"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.cierre_actividad" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="cierre_duracion" class="form-label">Cierre Duracion (min)</label>
                                    <input type="number" class="form-control" v-model.number="form.cierre_duracion"
                                            placeholder="Ej: 5"
                                            min="1" max="120" step="1">
                                    <small class="text-danger" v-for="error in form.errors.cierre_duracion" :key="error">{{ error }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" @click="guardar()" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Actividades</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Orden</th>
                                    <th>Titulo</th>
                                    <th>Que se Debe Hacer</th>
                                    <th>Accion</th>
                                </tr>
                                <tr v-for="(item, index) in listaActividades" :key="item.id">
                                    <td>{{ item.orden }}</td>
                                    <td>{{ item.titulo }}</td>
                                    <td>{{ item.que_se_debe_hacer }}</td>
                                    <td>
                                        <button title="Eliminar" class="btn btn-xs p-2 btn-outline-danger" @click="eliminar(item.id)">
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