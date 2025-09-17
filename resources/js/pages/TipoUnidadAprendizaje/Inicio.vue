<script setup>
  import { ref, onMounted } from 'vue';
  import useHelper from '@/Helpers';  
  import useTipoUnidadAprendizaje from '@/Composables/TipoUnidadAprendizaje.js';
  import tipoUnidadAprendizajeForm from './Form.vue'
  const { openModal, Toast, Swal } = useHelper();
  const {
        tipoUnidadAprendizajes, errors, tipoUnidadAprendizaje, respuesta,
        obtenerTipoUnidadAprendizajes, obtenerTipoUnidadAprendizaje, eliminarTipoUnidadAprendizaje        
    } = useTipoUnidadAprendizaje();
    const dato = ref({
        page:'',
        buscar:'',
        paginacion: 10
    });
    const form = ref({
        id:'',
        nombre : '',
        estadoCrud:'',
        errors:[]

    });
    const limpiar = ()=> {
        form.value.id='',
        form.value.nombre='',
        form.value.estadoCrud = '',          
        form.value.errors = []
        errors.value = []
    }
    const obtenerDatos = async(id) => {
        await obtenerTipoUnidadAprendizaje(id);
        if(tipoUnidadAprendizaje.value)
        {
            form.value.id=tipoUnidadAprendizaje.value.id;
            form.value.nombre=tipoUnidadAprendizaje.value.nombre;
        }
    }
    const editar = (id) => {
        limpiar();
        obtenerDatos(id)
        form.value.estadoCrud = 'editar'
        document.getElementById("modaltipoUnidadAprendizajeLabel").innerHTML = 'Editar Tipo Unidad de Aprendizaje';
        openModal('#modaltipoUnidadAprendizaje')
    }
    const nuevo = () => {
        limpiar()
        form.value.estadoCrud = 'nuevo'
        openModal('#modaltipoUnidadAprendizaje')
        document.getElementById("modaltipoUnidadAprendizajeLabel").innerHTML = 'Nuevo Tipo Unidad de Aprendizaje';
        //titulo.textContent = 'Editar Datos Personales';
    }
    const listarTipos = async(page=1) => {
        dato.value.page= page
        await obtenerTipoUnidadAprendizajes(dato.value)
    }
    const eliminar = (id) => {
        Swal.fire({
            title: '¿Estás seguro de Eliminar?',
            text: "tipoUnidadAprendizaje",
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
        await eliminarTipoUnidadAprendizaje(id)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            listarTipos(tipoUnidadAprendizajes.value.current_page)
        }
    }
    // PAGINACION
    const isActived = () => {
        return tipoUnidadAprendizajes.value.current_page
    }
    const offset = 2;

    const buscar = () => {
        listarTipos()
    }
    const cambiarPaginacion = () => {
        listarTipos()
    }
    const cambiarPagina =(pagina) => {
        listarTipos(pagina)
    }
    const pagesNumber = () => {
        if(!tipoUnidadAprendizajes.value.to){
            return []
        }
        let from = tipoUnidadAprendizajes.value.current_page - offset
        if(from < 1) from = 1
        let to = from + (offset*2)
        if( to >= tipoUnidadAprendizajes.value.last_page) to = tipoUnidadAprendizajes.value.last_page
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
        listarTipos()
    })
</script>
<template>
    <div class="app-content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h6 class="card-title">
                    Listado de tipoUnidadAprendizajes
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
                                <li v-if="tipoUnidadAprendizajes.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="tipoUnidadAprendizajes.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.current_page - 1)">
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
                                <li v-if="tipoUnidadAprendizajes.current_page < tipoUnidadAprendizajes.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="tipoUnidadAprendizajes.current_page <= tipoUnidadAprendizajes.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.last_page)"
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
                            <table class="table table-bordered table-hover table-sm table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th colspan="8" class="text-center">Tipos de Unidad de Aprendizajes</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="tipoUnidadAprendizajes.total == 0">
                                        <td class="text-danger text-center" colspan="7">
                                            -- Datos No Registrados - Tabla Vacía --
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(tipoUnidadAprendizaje,index) in tipoUnidadAprendizajes.data" :key="tipoUnidadAprendizaje.id">
                                        <td>{{ index + tipoUnidadAprendizajes.from }}</td>
                                        <td>{{ tipoUnidadAprendizaje.nombre }}</td>
                                        <td>
                                            <template v-if="tipoUnidadAprendizaje.deleted_at == null">
                                                <button class="btn btn-warning btn-xs" title="Editar" @click.prevent="editar(tipoUnidadAprendizaje.id)">
                                                    <i class="fas fa-edit"></i>
                                                </button>&nbsp;
                                                <button class="btn btn-danger btn-xs" title="Enviar a Papelera" @click.prevent="eliminar(tipoUnidadAprendizaje.id, 'Temporal')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button class="btn btn-info btn-xs" title="Restaurar" @click.prevent="restaurar(tipoUnidadAprendizaje.id)">
                                                    <i class="fas fa-trash-restore-alt"></i>
                                                </button>&nbsp;
                                                <button class="btn btn-danger btn-xs" title="Eliminar Permanente" @click.prevent="eliminar(tipoUnidadAprendizaje.id, 'Permanente')">
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
                        Mostrando <b>{{tipoUnidadAprendizajes.from}}</b> a <b>{{ tipoUnidadAprendizajes.to }}</b> de <b>{{ tipoUnidadAprendizajes.total}}</b> Registros
                    </div>
                    <div class="col-md-7 mb-1 text-right">
                        <nav>
                            <ul class="pagination">
                                <li v-if="tipoUnidadAprendizajes.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="tipoUnidadAprendizajes.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.current_page - 1)">

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
                                <li v-if="tipoUnidadAprendizajes.current_page < tipoUnidadAprendizajes.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="tipoUnidadAprendizajes.current_page <= tipoUnidadAprendizajes.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(tipoUnidadAprendizajes.last_page)"
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
    <tipoUnidadAprendizajeForm :form="form" @onListar="listarTipos" :currentPage="tipoUnidadAprendizajes.current_page"></tipoUnidadAprendizajeForm>
</template>