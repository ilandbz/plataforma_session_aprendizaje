<script setup>
import { toRefs, onMounted } from 'vue';
import useUnidadAprendizaje from '@/Composables/UnidadAprendizaje.js';
import useTipoUnidadAprendizaje from '@/Composables/TipoUnidadAprendizaje.js';
import useInstitucionEducativa from '@/Composables/InstitucionEducativa.js';
import useHelper from '@/Helpers';  
const { hideModal, Toast } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number,
});
const { form, currentPage } = toRefs(props)
const {
    errors, respuesta, agregarUnidad, actualizarUnidad
} = useUnidadAprendizaje();
const {
    listaTipoUnidadAprendizajes, tipoUnidadAprendizajes
} = useTipoUnidadAprendizaje();
const {
    listaInstituciones, instituciones, obtenerInstitucion, institucion
} = useInstitucionEducativa();
const  emit  =defineEmits(['onListar'])
const crud = {
    'nuevo': async() => {
        await agregarUnidad(form.value)
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
        await actualizarUnidad(form.value)
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
const cambiarInstitucion = async() => {
    if(form.value.institucion_educativa_id){
        await obtenerInstitucion(form.value.institucion_educativa_id)
        if(institucion.value){
            form.value.director = institucion.value.director
            form.value.sub_director = institucion.value.sub_director
        }
    }else{
        form.value.director = ''
        form.value.sub_director = ''
    }
}
const guardar = () => {
    crud[form.value.estadoCrud]()
}
onMounted(() => {
listaTipoUnidadAprendizajes()
listaInstituciones()
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
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Grado -->
                                    <div class="mb-3">
                                        <label for="grado" class="form-label">Grado</label>
                                        <select class="form-select" v-model="form.grado" :class="{ 'is-invalid': form.errors.grado }">
                                            <option value="" hidden>-- Seleccione --</option>
                                            <option value="1° Grado">1° Grado</option>
                                            <option value="2° Grado">2° Grado</option>
                                            <option value="3° Grado">3° Grado</option>
                                            <option value="4° Grado">4° Grado</option>
                                            <option value="5° Grado">5° Grado</option>
                                            <option value="6° Grado">6° Grado</option>
                                        </select>
                                        <small class="text-danger" v-for="error in form.errors.grado" :key="error">{{ error }}</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numero_unidad" class="form-label">N.º de Unidad</label>
                                        <input type="number" class="form-control" v-model.number="form.numero_unidad"
                                                :class="{ 'is-invalid': form.errors.numero_unidad }" placeholder="Ej: 1">
                                        <small class="text-danger" v-for="error in form.errors.numero_unidad" :key="error">{{ error }}</small>
                                    </div>


                                    <div class="mb-3">
                                        <label for="region" class="form-label">Region</label>
                                        <select class="form-select" v-model="form.region" :class="{ 'is-invalid': form.errors.region }">
                                            <option value="" hidden>-- Seleccione --</option>
                                            <option value="Costa">Costa</option>
                                            <option value="Sierra">Sierra</option>
                                            <option value="Amazonia">Amazonia</option>
                                        </select>
                                        <small class="text-danger" v-for="error in form.errors.region" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Nombre de la Unidad -->
                                    <div class="mb-3">
                                        <label for="nombre_unidad" class="form-label">Nombre de la Unidad</label>
                                        <input type="text" class="form-control" v-model="form.nombre_unidad"
                                                :class="{ 'is-invalid': form.errors.nombre_unidad }" placeholder="Nombre de la unidad">
                                        <small class="text-danger" v-for="error in form.errors.nombre_unidad" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Tipo (select) -->
                                    <div class="mb-3">
                                        <label for="tipo_id" class="form-label">Tipo</label>
                                        <select class="form-select" v-model="form.tipo_id" :class="{ 'is-invalid': form.errors.tipo_id }">
                                            <option value="" hidden>-- Seleccione --</option>
                                            <option v-for="t in tipoUnidadAprendizajes" :key="t.id" :value="t.id">{{ t.nombre }}</option>
                                        </select>
                                        <small class="text-danger" v-for="error in form.errors.tipo_id" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Institución Educativa (select) -->
                                    <div class="mb-3">
                                        <label for="institucion_educativa_id" class="form-label">Institución Educativa</label>
                                        <select class="form-select" v-model="form.institucion_educativa_id"
                                                :class="{ 'is-invalid': form.errors.institucion_educativa_id }" @click="cambiarInstitucion()">
                                            <option value="" hidden>-- Seleccione --</option>
                                            <option v-for="ie in instituciones" :key="ie.id" :value="ie.id">{{ ie.nombre }}</option>
                                        </select>
                                        <small class="text-danger" v-for="error in form.errors.institucion_educativa_id" :key="error">{{ error }}</small>
                                    </div>


                                    <!-- Director -->
                                    <div class="mb-3">
                                        <label for="director" class="form-label">Director</label>
                                        <input type="text" class="form-control" v-model="form.director"
                                                :class="{ 'is-invalid': form.errors.director }" placeholder="Director">
                                        <small class="text-danger" v-for="error in form.errors.director" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Sub Director -->
                                    <div class="mb-3">
                                        <label for="sub_director" class="form-label">Sub Director</label>
                                        <input type="text" class="form-control" v-model="form.sub_director"
                                                :class="{ 'is-invalid': form.errors.sub_director }" placeholder="Sub Director">
                                        <small class="text-danger" v-for="error in form.errors.sub_director" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Profesor -->
                                    <div class="mb-3">
                                        <label for="profesor" class="form-label">Profesor</label>
                                        <input type="text" class="form-control" :value="form.profesor"
                                                :class="{ 'is-invalid': form.errors.profesor }" placeholder="Profesor">
                                        <small class="text-danger" v-for="error in form.errors.profesor" :key="error">{{ error }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Sección -->
                                    <div class="mb-3">
                                    <label for="seccion" class="form-label">Sección</label>
                                    <input type="text" class="form-control" v-model="form.seccion"
                                            :class="{ 'is-invalid': form.errors.seccion }" placeholder="Ej: A">
                                    <small class="text-danger" v-for="error in form.errors.seccion" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Fecha Inicio -->
                                    <div class="mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                    <input type="date" class="form-control" v-model="form.fecha_inicio"
                                            :class="{ 'is-invalid': form.errors.fecha_inicio }">
                                    <small class="text-danger" v-for="error in form.errors.fecha_inicio" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Fecha Fin -->
                                    <div class="mb-3">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" v-model="form.fecha_fin"
                                                :class="{ 'is-invalid': form.errors.fecha_fin }">
                                        <small class="text-danger" v-for="error in form.errors.fecha_fin" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Descripción de la Unidad -->
                                    <div class="mb-3">
                                    <label for="descripcion_unidad" class="form-label">Descripción de la Unidad</label>
                                    <textarea class="form-control" rows="3" v-model="form.descripcion_unidad"
                                                :class="{ 'is-invalid': form.errors.descripcion_unidad }"
                                                placeholder="Breve descripción de la unidad"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.descripcion_unidad" :key="error">{{ error }}</small>
                                    </div>

                                    <!-- Situación Significativa -->
                                    <div class="mb-3">
                                    <label for="situacion_significativa" class="form-label">Situación Significativa</label>
                                    <textarea class="form-control" rows="3" v-model="form.situacion_significativa"
                                                :class="{ 'is-invalid': form.errors.situacion_significativa }"
                                                placeholder="Contexto/situación significativa"></textarea>
                                    <small class="text-danger" v-for="error in form.errors.situacion_significativa" :key="error">{{ error }}</small>
                                    </div>
                                </div>
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