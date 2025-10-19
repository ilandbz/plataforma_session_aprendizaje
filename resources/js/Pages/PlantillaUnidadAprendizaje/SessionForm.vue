<script setup>
import { toRefs, onMounted, watch, ref, onUnmounted, computed, reactive } from 'vue';
import usePlantillaUnidad from '@/Composables/PlantillaUnidad.js'
import useHelper from '@/Helpers';  

const { hideModal, Toast, Swal } = useHelper();
const {
    respuesta, errors, guardarSession, cargarSessiones, sessiones,
    eliminarSession
} = usePlantillaUnidad()

const props = defineProps({
    form: Object,
});

const { form } = toRefs(props)

// Objeto reactivo para cada área (usando computed para crear uno por área)
const formsSessions = ref({})

const limpiarFormSession = (areaId) => {
    formsSessions.value[areaId] = {
        'area_id': areaId,
        'orden': '',
        'titulo': '',
        'genero': 'M',
        'archivo': null,
    }
}

// Inicializar forms para cada área
const initializeForms = () => {
    if (form.value.areas) {
        form.value.areas.forEach(area => {
            limpiarFormSession(area.area_id)
        })
    }
}

const guardar = async(formObj) => {
    const fd = new FormData();
    fd.append('area_id', formObj.area_id);
    fd.append('plantilla_unidad_id', formObj.plantilla_unidad_id);
    fd.append('orden', formObj.orden);
    fd.append('titulo', formObj.titulo);
    fd.append('genero', formObj.genero);
    fd.append('archivo', formObj.archivo); // <-- IMPORTANTE: debe ser un File
    await guardarSession(fd);
    if(respuesta.value.ok == 1) {
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        listaSessiones(formObj.area_id, formObj.plantilla_unidad_id)
    }
}
const verCardPdf = ref(false);
const loading = ref(false);
const pdfUrl = ref('')
function verPdf(area_id, sesion_id) {
  loading.value = true;
  verCardPdf.value = true;

  // Construcción más segura y legible del nombre del archivo
  const plantillaId = form.value.plantilla_unidad_id;
  const safeName = `${plantillaId}_${area_id}_${sesion_id}.pdf`;

  // Usa template literals consistentes
  pdfUrl.value = `/storage/unidades_aprendizaje/${plantillaId}/${safeName}`;
  setTimeout(() => (loading.value = false), 300)

}
const listaSessiones = async(area_id, plantilla_unidad_id)=>{
    const area = form.value.areas.find(a => a.area_id === area_id);
    await cargarSessiones(area_id, plantilla_unidad_id)
    area.sessiones = sessiones
}
function agregarSesion(areaId) {
    const area = form.value.areas.find(a => a.area_id === areaId);
    if (!area) return;
    const formData = formsSessions.value[areaId];
    if (!formData.titulo) {
        Toast.fire({icon:'error', title:'Complete el título de la sesión'})
        return;
    }
    if (!formData.archivo) {
        Toast.fire({icon:'error', title:'Aun no selecciono el Archivo PDF'})
        return;
    }
    if (!area.sessiones) {
        area.sessiones = [];
    }
    const siguienteOrden = area.sessiones.length > 0 
        ? Math.max(...area.sessiones.map(s => s.orden)) + 1 
        : 1;
    formData.orden = siguienteOrden
    formData.plantilla_unidad_id = form.value.plantilla_unidad_id,
    guardar(formData)
    limpiarFormSession(areaId);
    
}
const eliminar = (area_id, id) => {
    Swal.fire({
        title: '¿Estás seguro de Eliminar?',
        text: "Sesión",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarSesion(area_id, id)
        }
    })
}

const eliminarSesion = async(area_id, id) => {
    await eliminarSession(id)

  if (errors.value) {
    Toast.fire({icon:'error', title:'Error'})
  }

  if (respuesta.value.ok == 1) {
    Toast.fire({ icon: 'success', title: respuesta.value.mensaje })
    listaSessiones(area_id, form.value.plantilla_unidad_id)
  }

}
const MAX_FILE_SIZE = 10 * 1024 * 1024;

function handleArchivoSesionUpload(event, areaId) {
    const file = event.target.files[0];
    if (!file) return;

    if (file.type !== 'application/pdf') {
        Toast.fire({ icon: 'error', title: 'Solo se permiten archivos PDF' });
        event.target.value = ''; // limpia el input
        return;
    }

    if (file.size > MAX_FILE_SIZE) {
        Toast.fire({ 
            icon: 'error', 
            title: `El archivo excede el tamaño máximo permitido (10 MB)` 
        });
        event.target.value = ''; // limpia el input
        return;
    }
    formsSessions.value[areaId].archivo = file;
}

onMounted(() => {
    initializeForms()
})

watch(() => form.value.areas, () => {
    initializeForms()
}, { deep: true })

</script>

<template>
    <div class="modal fade" id="modalSessiones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalSessionesLabel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="modalSessionesLabel">Gestión de Sesiones por Área</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Áreas</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Navegación de Tabs -->

                            <ul class="nav nav-pills" id="pill-myTab" role="tablist">
                                <li 
                                    v-for="(area, index) in form.areas" 
                                    :key="area.area_id" 
                                    class="nav-item"
                                >
                                    <a 
                                        class="nav-link" 
                                        :class="{ active: index === 0 }"
                                        :id="'pill-area-' + area.area_id + '-tab'" 
                                        data-bs-toggle="tab" 
                                        :href="'#pill-tab-area-' + area.area_id" 
                                        role="tab" 
                                        :aria-controls="'pill-tab-area-' + area.area_id" 
                                        :aria-selected="index === 0 ? 'true' : 'false'"
                                    >
                                        {{ area.nombre }}
                                    </a>
                                </li>
                            </ul>

                            <!-- Contenido de los Tabs -->
                            <div class="tab-content border p-3 mt-3" id="pill-myTabContent">
                                <div 
                                    v-for="(area, index) in form.areas" 
                                    :key="area.area_id"
                                    class="tab-pane fade" 
                                    :class="{ 'show active': index === 0 }"
                                    :id="'pill-tab-area-' + area.area_id" 
                                    role="tabpanel" 
                                    :aria-labelledby="'pill-area-' + area.area_id + '-tab'"
                                >
                                    <h6>Agregar sesiones para {{ area.nombre }}</h6>
                                    <div class="row mb-2" v-if="formsSessions[area.area_id]">
                                        <div class="col">
                                            <label class="form-label">N.º de orden (auto)</label>
                                            <input 
                                                type="number" 
                                                class="form-control" 
                                                :value="area.sessiones?.length ? Math.max(...area.sessiones.map(s => s.orden)) + 1 : 1"
                                            >
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Título <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                placeholder="Título" 
                                                v-model="formsSessions[area.area_id].titulo"
                                            >
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Género</label>
                                            <select 
                                                class="form-control"
                                                v-model="formsSessions[area.area_id].genero"
                                            >
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>

                                        <div class="col">                                            
                                            <label class="form-label">Archivo de sesión</label>
                                            <input 
                                                type="file" 
                                                class="form-control" 
                                                @change="event => handleArchivoSesionUpload(event, area.area_id)"
                                            >
                                        </div>
                                    </div>
                                    
                                    <!-- Botón para agregar sesión -->
                                    <button 
                                        class="btn btn-sm btn-success mb-3" 
                                        @click="() => agregarSesion(area.area_id)"
                                    >
                                        ➕ Agregar sesión
                                    </button>

                                    <hr>
                                    <table class="table table-bordered table-hover table-sm table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th colspan="4" class="text-center">
                                                    Sesiones Registradas
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Orden</th>
                                                <th>Título</th>
                                                <th>Género</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-if="!area.sessiones || area.sessiones.length === 0">
                                                <td class="text-danger text-center" colspan="4">
                                                    -- Datos No Registrados - Tabla Vacía --
                                                </td>
                                            </tr>

                                            <tr v-else v-for="(sesion, idx) in area.sessiones" :key="idx">
                                                <td>{{ sesion.orden }}</td>
                                                <td>{{ sesion.titulo }}</td>
                                                <td>{{ sesion.genero }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button 
                                                            class="btn btn-danger btn-xs" 
                                                            title="Eliminar" 
                                                            @click.prevent="eliminar(area.id, sesion.id)"
                                                        >
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button 
                                                            class="btn btn-info btn-xs" 
                                                            title="Ver" 
                                                            @click.prevent="verPdf(area.id, sesion.id)"
                                                        >
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-info" v-if="verCardPdf">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click.prevent="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>