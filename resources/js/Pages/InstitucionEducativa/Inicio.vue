<script setup>
  import { ref, onMounted } from 'vue';
  import useHelper from '@/Helpers';  
  import useInstitucionEducativa from '@/Composables/InstitucionEducativa.js';
  import InstitucionForm from './Form.vue'
  const { openModal, Toast, Swal } = useHelper();
  const {
        instituciones, errors, institucion, respuesta,
        obtenerInstituciones, obtenerInstitucion, eliminarInstitucion        
    } = useInstitucionEducativa();
    const dato = ref({
        page:'',
        buscar:'',
        paginacion: 10
    });
    const form = ref({
        id:'',
        codigo : '',
        nombre : '',
        direccion : '', 
        telefono : '', 
        email : '', 
        director : '', 
        sub_director : '', 
        estadoCrud:'',
        errors:[]

    });
    const limpiar = ()=> {
        form.value.id='',
        form.value.codigo='',
        form.value.nombre='',
        form.value.direccion='',
        form.value.telefono='',
        form.value.email='',
        form.value.director='',
        form.value.sub_director='',
        form.value.estadoCrud = '',          
        form.value.errors = []
        errors.value = []
    }
    const obtenerDatos = async(id) => {
        await obtenerInstitucion(id);
        if(institucion.value)
        {
            form.value.id=institucion.value.id;
            form.value.codigo=institucion.value.codigo;
            form.value.nombre=institucion.value.nombre;
            form.value.direccion=institucion.value.direccion;
            form.value.telefono=institucion.value.telefono;
            form.value.email=institucion.value.email;
            form.value.director=institucion.value.director;
            form.value.sub_director=institucion.value.sub_director;
        }
    }
    const editar = (id) => {
        limpiar();
        obtenerDatos(id)
        form.value.estadoCrud = 'editar'
        document.getElementById("modalinstitucionLabel").innerHTML = 'Editar institucion';
        openModal('#modalinstitucion')
    }
    const nuevo = () => {
        limpiar()
        form.value.estadoCrud = 'nuevo'
        openModal('#modalinstitucion')
        document.getElementById("modalinstitucionLabel").innerHTML = 'Nuevo institucion';
        //titulo.textContent = 'Editar Datos Personales';
    }
    const listarInstituciones = async(page=1) => {
        dato.value.page= page
        await obtenerInstituciones(dato.value)
    }
    const eliminar = (id) => {
        Swal.fire({
            title: '¿Estás seguro de Eliminar?',
            text: "institucion",
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
        await eliminarInstitucion(id)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            listarInstituciones(instituciones.value.current_page)
        }
    }
    // PAGINACION
    const isActived = () => {
        return instituciones.value.current_page
    }
    const offset = 2;

    const buscar = () => {
        listarInstituciones()
    }
    const cambiarPaginacion = () => {
        listarInstituciones()
    }
    const cambiarPagina =(pagina) => {
        listarInstituciones(pagina)
    }
    const pagesNumber = () => {
        if(!instituciones.value.to){
            return []
        }
        let from = instituciones.value.current_page - offset
        if(from < 1) from = 1
        let to = from + (offset*2)
        if( to >= instituciones.value.last_page) to = instituciones.value.last_page
        let pagesArray = []
        while(from <= to) {
            pagesArray.push(from)
            from ++
        }
        return pagesArray
    }
    // CARGA
    onMounted(() => {
        //defineTitle(titleHeader.value.titulo)
        listarInstituciones()
    })
</script>
<template>
    <div class="app-content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h6 class="card-title">
                    Listado de Instituciones
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 mb-1">
                        <button  type="button" class="btn btn-danger" @click.prevent="nuevo">
                            <i class="fas fa-plus"></i> Nuevo
                        </button>                        
                    </div>
                    <div class="col-md-2 mb-1">
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">Mostrar</span>
                            <select class="form-select"  v-model="dato.paginacion" @change="cambiarPaginacion">
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
                            <input class="form-control" placeholder="Ingrese nombre, código ciiu" type="text" v-model="dato.buscar"
                                @change="buscar" />
                        </div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <nav>
                            <ul class="pagination">
                                <li v-if="instituciones.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="instituciones.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(instituciones.current_page - 1)">
                                        <span><i class="fas fa-angle-left"></i></span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber()" class="page-item"
                                    :key="page"
                                    :class="[ page == isActived() ? 'active' : '']"
                                    :title="'Página '+ page">
                                    <a href="#" class="page-link"
                                        @click.prevent="cambiarPagina(page)">{{ page }}</a>
                                </li>
                                <li v-if="instituciones.current_page < instituciones.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(instituciones.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="instituciones.current_page <= instituciones.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(instituciones.last_page)"
                                        title="Última Página">
                                        <span ><i class="fas fa-step-forward"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <div class="table-responsive">         
                            <table class="table table-bordered table-hover table-sm table-striped small">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="8" class="text-center">instituciones</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Director</th>
                                        <th>Sub Director</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="instituciones.total == 0">
                                        <td class="text-danger text-center" colspan="7">
                                            -- Datos No Registrados - Tabla Vacía --
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(institucion,index) in instituciones.data" :key="institucion.id">
                                        <td>{{ index + instituciones.from }}</td>
                                        <td>{{ institucion.codigo }}</td>
                                        <td>{{ institucion.nombre }}</td>
                                        <td>{{ institucion.direccion }}</td>
                                        <td>{{ institucion.director }}</td>
                                        <td>{{ institucion.sub_director }}</td>
                                        <td>
                                            <template v-if="institucion.deleted_at == null">
                                                <button class="btn btn-warning btn-xs" title="Editar" @click.prevent="editar(institucion.id)">
                                                    <i class="fas fa-edit"></i>
                                                </button>&nbsp;
                                                <button class="btn btn-danger btn-xs" title="Enviar a Papelera" @click.prevent="eliminar(institucion.id, 'Temporal')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button class="btn btn-info btn-xs" title="Restaurar" @click.prevent="restaurar(institucion.id)">
                                                    <i class="fas fa-trash-restore-alt"></i>
                                                </button>&nbsp;
                                                <button class="btn btn-danger btn-xs" title="Eliminar Permanente" @click.prevent="eliminar(institucion.id, 'Permanente')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-1">
                        Mostrando <b>{{instituciones.from}}</b> a <b>{{ instituciones.to }}</b> de <b>{{ instituciones.total}}</b> Registros
                    </div>
                    <div class="col-md-7 mb-1 text-right">
                        <nav>
                            <ul class="pagination">
                                <li v-if="instituciones.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="instituciones.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(instituciones.current_page - 1)">

                                        <span><i class="fas fa-angle-left"></i></span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber()" class="page-item"
                                    :key="page"
                                    :class="[ page == isActived() ? 'active' : '']"
                                    :title="'Página '+ page">
                                    <a href="#" class="page-link"
                                        @click.prevent="cambiarPagina(page)">{{ page }}</a>
                                </li>
                                <li v-if="instituciones.current_page < instituciones.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(instituciones.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="instituciones.current_page <= instituciones.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(instituciones.last_page)"
                                        title="Última Página">
                                        <span ><i class="fas fa-step-forward"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <InstitucionForm :form="form" @onListar="listarInstituciones" :currentPage="instituciones.current_page"></InstitucionForm>
</template>