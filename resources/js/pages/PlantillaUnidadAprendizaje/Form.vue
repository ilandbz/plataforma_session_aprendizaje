<script setup>
import { toRefs, onMounted } from 'vue';
import usePlantillaUnidad from '@/Composables/PlantillaUnidad.js'
import useTipoUnidadAprendizaje from '@/Composables/TipoUnidadAprendizaje.js';
import useRegion from '@/Composables/Region.js'
import useHelper from '@/Helpers';  
const { hideModal, Toast } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number,
});
const { form, currentPage } = toRefs(props)
const {
    errors, respuesta, agregarRegistro, actualizarRegistro
} = usePlantillaUnidad();
const {
    listaTipoUnidadAprendizajes, tipoUnidadAprendizajes
} = useTipoUnidadAprendizaje();
const {
    listaRegiones, regiones
} = useRegion();
const  emit  =defineEmits(['onListar'])
const crud = {
    'nuevo': async() => {
        await agregarRegistro(form.value)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modalUnidadAprendizaje')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)
        }
    },
    'editar': async() => {
        await actualizarRegistro(form.value)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modalUnidadAprendizaje')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)
        }
    }
}
const guardar = () => {
    crud[form.value.estadoCrud]()
}
onMounted(() => {
    listaRegiones()
    listaTipoUnidadAprendizajes()
})
</script>
<template>
    <form @submit.prevent="guardar">
    <div class="modal fade" id="modalUnidadAprendizaje" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalUnidadAprendizajeLabel" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="modalUnidadAprendizajeLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Grado -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="grado" class="form-label">Grado</label>
                                    <select class="form-select" v-model="form.grado" :class="{ 'is-invalid': form.errors.grado }">
                                        <option value="" hidden>Seleccione</option>
                                        <option value="1° Grado">1° Grado</option>
                                        <option value="2° Grado">2° Grado</option>
                                        <option value="3° Grado">3° Grado</option>
                                        <option value="4° Grado">4° Grado</option>
                                        <option value="5° Grado">5° Grado</option>
                                        <option value="6° Grado">6° Grado</option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.grado" :key="error">{{ error }}</small>
                                </div>
                                <div class="col">
                                    <label for="numero_unidad" class="form-label">N.º de Unidad</label>
                                    <input type="number" class="form-control" v-model.number="form.numero_unidad"
                                            :class="{ 'is-invalid': form.errors.numero_unidad }"
                                            placeholder="Ej: 1"
                                            min="1" max="20" step="1">
                                    <small class="text-danger" v-for="error in form.errors.numero_unidad" :key="error">{{ error }}</small>                                            
                                </div>
                                <div class="col">
                                    <label for="region_id" class="form-label">Region</label>
                                    <select v-model="form.region_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.region_id }">
                                        <option v-for="region in regiones" :key="region.id" :value="region.id"
                                            :title="region.nombre">
                                            {{ region.nombre }}
                                        </option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.region_id" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="tipo_id" class="form-label">Tipo</label>
                                    <select class="form-select" v-model="form.tipo_id" :class="{ 'is-invalid': form.errors.tipo_id }">
                                        <option v-for="t in tipoUnidadAprendizajes" :key="t.id" :value="t.id">{{ t.nombre }}</option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.tipo_id" :key="error">{{ error }}</small>

                                </div>
                                <div class="col">
                                    <label for="nombre_unidad" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" v-model="form.nombre_unidad"
                                            :class="{ 'is-invalid': form.errors.nombre_unidad }" placeholder="Nombre de la unidad">
                                    <small class="text-danger" v-for="error in form.errors.nombre_unidad" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="tiene_educacion_fisica" type="checkbox" checked="" v-model="form.tiene_educacion_fisica" />
                                    <label class="form-check-label" for="tiene_educacion_fisica">Tiene Educacion Física</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="situacion_significativa" class="form-label">Situación Significativa</label>
                                <textarea class="form-control" rows="7" v-model="form.situacion_significativa"
                                            :class="{ 'is-invalid': form.errors.situacion_significativa }"
                                            placeholder="Contexto/situación significativa"></textarea>
                                <small class="text-danger" v-for="error in form.errors.situacion_significativa" :key="error">{{ error }}</small>
                            </div>
                        </div>
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ (form.estadoCrud=='nuevo') ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</template>