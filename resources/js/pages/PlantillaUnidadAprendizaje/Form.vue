<script setup>
import { toRefs, onMounted, computed, ref } from 'vue';
import usePlantillaUnidad from '@/Composables/PlantillaUnidad.js'
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
    listaRegiones, regiones
} = useRegion();
const  emit  =defineEmits(['onListar'])
const prepararYEnviarFormulario = async () => {
  const formData = new FormData()
  formData.append('id', form.value.id)
  formData.append('grado', form.value.grado)
  formData.append('numero_unidad', form.value.numero_unidad)
  formData.append('region_id', form.value.region_id)
  formData.append('titulo', form.value.titulo)
  formData.append('situacion_significativa', form.value.situacion_significativa)
  formData.append('tiene_educacion_fisica', form.value.tiene_educacion_fisica ? 1 : 0)
  formData.append('archivo', form.value.archivo ?? '');
  try {
    if (form.value.estadoCrud === 'nuevo') {
        await agregarRegistro(formData)
    } else {
        await actualizarRegistro(formData)
    }
    if (respuesta.value.ok === 1) {
      Toast.fire({ icon: 'success', title: respuesta.value.mensaje })
      hideModal('#modalUnidadAprendizaje')
      emit('onListar', currentPage.value)
    }
    if(errors.value)
    {
        form.value.errors = errors.value
    }
  } catch (error) {
    console.error('Error al enviar:', error)
    Toast.fire({ icon: 'error', title: 'Error al guardar' })
  }
}
const guardar = () => {
    prepararYEnviarFormulario()
}
const verCardPdf = ref(false);
const loading = ref(false);
const pdfUrl = ref('')
function handleArchivoUnidadUpload(event) {
  const file = event.target.files[0]
  form.value.archivo = file
}
function verPdf(filename) {
  loading.value = true
  verCardPdf.value = true
  const safeName = encodeURIComponent(filename ?? '')
  pdfUrl.value = `/storage/unidades_aprendizaje/${form.value.id}/${safeName}`
  setTimeout(() => (loading.value = false), 300)
}
onMounted(() => {
    listaRegiones()
})
</script>
<template>
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
                                <div class="col">
                                    <label for="titulo" class="form-label">Título</label>
                                    <textarea class="form-control" 
                                            v-model="form.titulo"
                                            :class="{ 'is-invalid': form.errors.titulo }" 
                                            placeholder="Nombre de la unidad"
                                            rows="3">
                                    </textarea>
                                    <small class="text-danger" v-for="error in form.errors.titulo" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="situacion_significativa" class="form-label">Situacion Significativa</label>
                                    <textarea class="form-control" 
                                            v-model="form.situacion_significativa"
                                            :class="{ 'is-invalid': form.errors.situacion_significativa }" 
                                            placeholder="Nombre de la unidad"
                                            rows="3">
                                    </textarea>
                                    <small class="text-danger" v-for="error in form.errors.situacion_significativa" :key="error">{{ error }}</small>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <label for="archivo" class="form-label">Subir archivo</label>
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        id="archivo"
                                        @change="handleArchivoUnidadUpload" 
                                        accept=".pdf,application/pdf"
                                        :class="{ 'is-invalid': form.errors.archivo }"
                                    >
                                    <small class="text-danger" v-for="error in form.errors.archivo" :key="error">{{ error }}</small>
                                </div>

                                <div class="col-md-3 d-flex align-items-end" v-if="form.filename">
                                    <button class="btn btn-primary btn-sm w-100" @click="verPdf(form.filename)">
                                        <i class="fas fa-eye"></i> Ver PDF
                                    </button>
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
                    <div class="card border-info" v-if="verCardPdf && form.filename">
                        <div class="card-body">
                            <div v-if="loading" class="d-flex justify-content-center align-items-center vh-50">
                            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                                <span class="visually-hidden">Obteniendo Datos...</span>
                            </div>
                            </div>

                            <iframe
                            v-else
                            :src="pdfUrl"
                            width="100%"
                            height="600"
                            style="border:none;"
                            ></iframe>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>