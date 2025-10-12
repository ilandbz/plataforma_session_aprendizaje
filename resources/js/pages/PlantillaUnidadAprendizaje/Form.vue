<script setup>
import { toRefs, onMounted, computed, reactive } from 'vue';
import usePlantillaUnidad from '@/Composables/PlantillaUnidad.js'
import useArea from '@/Composables/Area.js'
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
    listaAreas, areas
} = useArea();
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

const areasFiltradas = computed(() => {
  if (form.value.tiene_educacion_fisica) {
    return areas.value
  } else {
    return areas.value.filter(a => a.nombre !== "Educación Física")
  }
})


const prepararYEnviarFormulario = async () => {
  const formData = new FormData()

  // Agrega los campos normales
  formData.append('grado', form.value.grado)
  formData.append('numero_unidad', form.value.numero_unidad)
  formData.append('region_id', form.value.region_id)
  formData.append('titulo', form.value.titulo)
  formData.append('tiene_educacion_fisica', form.value.tiene_educacion_fisica ? 1 : 0)

  // Agrega las sesiones por área
  for (const areaId in sesionesPorArea) {
    sesionesPorArea[areaId].forEach((sesion, index) => {
      formData.append(`sesiones[${areaId}][${index}][numero_orden]`, sesion.numero_orden)
      formData.append(`sesiones[${areaId}][${index}][archivo]`, sesion.archivo)
    })
  }


    areasFiltradas.value.forEach(area => {
        formData.append('areas_filtradas[]', area.id)
    })

  // Ahora envías usando fetch o axios
  try {
    await agregarRegistro(formData)

    if (respuesta.value.ok === 1) {
      Toast.fire({ icon: 'success', title: response.data.mensaje })
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

const sesionesPorArea = reactive({})

// 2. Función para agregar una sesión a un área
function agregarSesion(areaId) {
  if (!sesionesPorArea[areaId]) {
    sesionesPorArea[areaId] = []
  }

  sesionesPorArea[areaId].push({
    numero_orden: '',
    archivo: null
  })
}

const guardar = () => {
  if (form.value.estadoCrud === 'nuevo') {
    prepararYEnviarFormulario()
  } else {

  }
}


function handleArchivoUnidadUpload(event) {
  const file = event.target.files[0]
  form.value.archivo = file
}


function handleArchivoSesionUpload(event, areaId, index) {
  const file = event.target.files[0]
  if (sesionesPorArea[areaId] && sesionesPorArea[areaId][index]) {
    sesionesPorArea[areaId][index].archivo = file
  }
}

onMounted(() => {
    listaAreas()
    listaRegiones()
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
                                    <label for="archivo" class="form-label">Subir archivo</label>
                                    <input 
                                    type="file" 
                                    class="form-control" 
                                    id="archivo"
                                    @change="handleArchivoUnidadUpload" 
                                    :class="{ 'is-invalid': form.errors.archivo }"
                                    >
                                    <small class="text-danger" v-for="error in form.errors.archivo" :key="error">{{ error }}</small>
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
                        <div v-for="area in areasFiltradas" :key="area.id" class="mb-3">
                        <a 
                            class="btn btn-falcon-default mt-2" 
                            :data-bs-toggle="'collapse'" 
                            :href="'#collapse-' + area.id" 
                            role="button" 
                            aria-expanded="false" 
                            :aria-controls="'collapse-' + area.id">
                            {{ area.nombre }}
                        </a>
                        <div class="collapse mt-2" :id="'collapse-' + area.id">
                            <div class="border p-3 rounded">
                            <h6>Agregar sesiones para {{ area.nombre }}</h6>

                            <div 
                                v-for="(sesion, index) in sesionesPorArea[area.id] || []" 
                                :key="index" 
                                class="mb-3 border rounded p-2"
                            >
                                <div class="mb-2">
                                <label class="form-label">N.º de orden</label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    v-model="sesion.numero_orden" 
                                    placeholder="Ej: 1" 
                                    min="1"
                                >
                                </div>

                                <div class="mb-2">
                                <label class="form-label">Archivo de sesión</label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    @change="event => handleArchivoSesionUpload(event, area.id, index)"
                                >
                                </div>
                            </div>

                            <button 
                                class="btn btn-sm btn-success" 
                                @click="() => agregarSesion(area.id)">
                                ➕ Agregar sesión
                            </button>
                            </div>
                        </div>
                        <small 
                            class="text-danger" 
                            v-if="form.errors['sesiones.' + area.id]"
                            >
                            {{ form.errors['sesiones.' + area.id][0] }}
                        </small>
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