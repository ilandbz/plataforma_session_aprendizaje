<script setup>
import { ref, onMounted, toRefs } from 'vue'
import useHelper from '@/Helpers'
import usePlantillaUnidad from '@/Composables/PlantillaUnidad.js'
import UnidadAprendizajeForm from './Form.vue'
const { openModal, Toast, Swal } = useHelper()

const props = defineProps({
    usuario: Object
});

const { usuario } = toRefs(props);
const {
  registros, errors, registro, respuesta,
  obtenerRegistros, obtenerRegistro, eliminarRegistro
} = usePlantillaUnidad()

const dato = ref({
  page: '',
  buscar: '',
  paginacion: 10,
})

const form = ref({
  id: '',
  region_id: 1,
  grado: '',
  tiene_educacion_fisica: false,
  tipo_id: '',
  nombre_unidad: '',
  numero_unidad: 1,
  situacion_significativa: '',
  errors: []
})

const limpiar = () => {
  form.value = {
    id: '',
    region_id: 1,
    grado: '',
    tiene_educacion_fisica: false,
    tipo_id: '',
    nombre_unidad: '',
    numero_unidad: 1,
    situacion_significativa: '',
    errors: []
  }
  errors.value = []
}

const obtenerDatos = async (id) => {
  await obtenerRegistro(id)
  if (registro.value) {
    form.value.id                       = registro.value.id
    form.value.region_id                = registro.value.region_id ?? ''
    form.value.grado                    = registro.value.grado ?? ''
    form.value.tiene_educacion_fisica   = registro.value.tiene_educacion_fisica ?? ''
    form.value.tipo_id                  = registro.value.tipo_id ?? ''
  }
}

const editar = (id) => {
  limpiar()
  obtenerDatos(id)
  form.value.estadoCrud = 'editar'
  document.getElementById('modalUnidadAprendizajeLabel').innerHTML = 'Editar unidad de aprendizaje'
  openModal('#modalUnidadAprendizaje')
}

const nuevo = () => {
  limpiar()
  form.value.estadoCrud = 'nuevo'
  document.getElementById('modalUnidadAprendizajeLabel').innerHTML = 'Nueva unidad de aprendizaje'
  openModal('#modalUnidadAprendizaje')
}
const archivos=(id)=>{
  limpiarDatosImpresiones();
  formImpresion.value.id = id;
  openModal('#modalimpresiones')
  document.getElementById("modalimpresionesLabel").innerHTML = 'Actividades de aprendizaje';        
}
const listarRegistrosPlantillas = async (page = 1) => {
  dato.value.page = page
  await obtenerRegistros(dato.value)
}

const eliminar = (id) => {
  Swal.fire({
    title: '¿Estás seguro de eliminar?',
    text: 'Unidad de aprendizaje',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar'
  }).then((result) => {
    if (result.isConfirmed) elimina(id)
  })
}

const elimina = async (id) => {
  await eliminarRegistro(id)
  form.value.errors = []
  if (errors.value) form.value.errors = errors.value

  if (respuesta.value.ok == 1) {
    form.value.errors = []
    Toast.fire({ icon: 'success', title: respuesta.value.mensaje })
    listarRegistrosPlantillas(registros.value.current_page || 1)
  }
}

// PAGINACIÓN
const isActived = () => {
  return registros.value.current_page
}
const offset = 2

const pagesNumber = () => {
  if (!registros.value.to) return []
  let from = registros.value.current_page - offset
  if (from < 1) from = 1
  let to = from + (offset * 2)
  if (to >= registros.value.last_page) to = registros.value.last_page
  const pagesArray = []
  while (from <= to) {
    pagesArray.push(from)
    from++
  }
  return pagesArray
}

// BUSCAR / PAGINACIÓN UI
const buscar = () => listarRegistrosPlantillas()
const cambiarPaginacion = () => listarRegistrosPlantillas()
const cambiarPagina = (pagina) => listarRegistrosPlantillas(pagina)

// CARGA
onMounted(() => {
  listarRegistrosPlantillas()
})
</script>

<template>
  <div class="app-content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h6 class="card-title">
            Listado de Plantillas de Unidad de Aprendizaje
          </h6>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-1 mb-1">
              <button type="button" class="btn btn-danger" @click.prevent="nuevo">
                <i class="fas fa-plus"></i> Nuevo
              </button>
            </div>

            <div class="col-md-2 mb-1">
              <div class="input-group mb-1">
                <span class="input-group-text" id="basic-addon1">Mostrar</span>
                <select class="form-select" v-model="dato.paginacion" @change="cambiarPaginacion">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>

            <div class="col-md-5">
              <div class="input-group mb-1">
                <span class="input-group-text" id="basic-addon1">Buscar</span>
                <input
                  class="form-control"
                  placeholder="Ingrese nombre, profesor, grado o sección"
                  type="text"
                  v-model="dato.buscar"
                  @change="buscar"
                />
              </div>
            </div>

            <div class="col-md-4 mb-1">
              <nav>
                <ul class="pagination">
                  <li v-if="registros.current_page >= 2" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                       title="Primera Página"
                       @click.prevent="cambiarPagina(1)">
                      <span><i class="fas fa-backward"></i></span>
                    </a>
                  </li>
                  <li v-if="registros.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                       title="Página Anterior"
                       @click.prevent="cambiarPagina(registros.current_page - 1)">
                      <span><i class="fas fa-angle-left"></i></span>
                    </a>
                  </li>
                  <li v-for="page in pagesNumber()" class="page-item"
                      :key="page"
                      :class="[ page == isActived() ? 'active' : '' ]"
                      :title="'Página ' + page">
                    <a href="#" class="page-link" @click.prevent="cambiarPagina(page)">{{ page }}</a>
                  </li>
                  <li v-if="registros.current_page < registros.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                       title="Página Siguiente"
                       @click.prevent="cambiarPagina(registros.current_page + 1)">
                      <span><i class="fas fa-angle-right"></i></span>
                    </a>
                  </li>
                  <li v-if="registros.current_page <= registros.last_page - 1" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                       @click.prevent="cambiarPagina(registros.last_page)"
                       title="Última Página">
                      <span><i class="fas fa-step-forward"></i></span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-1">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm table-striped">
                  <thead class="table-dark">
                    <tr>
                      <th colspan="10" class="text-center">
                        Registros
                      </th>
                    </tr>
                    <tr>
                      <th>#</th>
                      <th>N°</th>
                      <th>Nombre</th>
                      <th>Profesor</th>
                      <th>Grado</th>
                      <th>Sección</th>
                      <th>F. Inicio</th>
                      <th>F. Fin</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-if="registros.total == 0">
                      <td class="text-danger text-center" colspan="10">
                        -- Datos No Registrados - Tabla Vacía --
                      </td>
                    </tr>

                    <tr v-else v-for="(ua, index) in registros.data" :key="ua.id">
                      <td>{{ index + registros.from }}</td>
                      <td class="text-nowrap">{{ ua.numero_unidad }}</td>
                      <td>{{ ua.nombre_unidad }}</td>
                      <td>{{ ua.profesor }}</td>
                      <td>{{ ua.grado }}</td>
                      <td>{{ ua.seccion }}</td>
                      <td class="text-nowrap">{{ ua.fecha_inicio }}</td>
                      <td class="text-nowrap">{{ ua.fecha_fin }}</td>
                      <td>
                        <button class="btn btn-warning btn-xs" title="Editar" @click.prevent="editar(ua.id)">
                          <i class="fas fa-edit"></i>
                       </button>&nbsp;
                        <button class="btn btn-danger btn-xs" title="Eliminar" @click.prevent="eliminar(ua.id)">
                          <i class="fas fa-trash"></i>
                        </button>&nbsp;
                        <button class="btn btn-success btn-sm btn-custom" title="Archivos" @click.prevent="archivos(ua.id)">
                            <i class="fa-solid fa-file-pdf"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-5 mb-1">
              Mostrando <b>{{ registros.from }}</b> a <b>{{ registros.to }}</b> de <b>{{ registros.total }}</b> Registros
            </div>
            <div class="col-md-7 mb-1 text-right">
              <nav>
                <ul class="pagination">
                  <li v-if="registros.current_page >= 2" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                       title="Primera Página"
                       @click.prevent="cambiarPagina(1)">
                      <span><i class="fas fa-backward"></i></span>
                    </a>
                  </li>
                  <li v-if="registros.current_page > 1" class="page-item">
                    <a href="#" aria-label="Previous" class="page-link"
                       title="Página Anterior"
                       @click.prevent="cambiarPagina(registros.current_page - 1)">
                      <span><i class="fas fa-angle-left"></i></span>
                    </a>
                  </li>
                  <li v-for="page in pagesNumber()" class="page-item"
                      :key="page"
                      :class="[ page == isActived() ? 'active' : '' ]"
                      :title="'Página ' + page">
                    <a href="#" class="page-link" @click.prevent="cambiarPagina(page)">{{ page }}</a>
                  </li>
                  <li v-if="registros.current_page < registros.last_page" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                       title="Página Siguiente"
                       @click.prevent="cambiarPagina(registros.current_page + 1)">
                      <span><i class="fas fa-angle-right"></i></span>
                    </a>
                  </li>
                  <li v-if="registros.current_page <= registros.last_page - 1" class="page-item">
                    <a href="#" aria-label="Next" class="page-link"
                       @click.prevent="cambiarPagina(registros.last_page)"
                       title="Última Página">
                      <span><i class="fas fa-step-forward"></i></span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <UnidadAprendizajeForm
      :form="form"
      :usuario="usuario"
      @onListar="listarRegistrosPlantillas"
      :currentPage="registros.current_page"
    />
  </div>
</template>
