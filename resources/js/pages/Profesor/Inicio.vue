<script setup>
  import { ref, onMounted } from 'vue';
  import { defineTitle } from '@/Helpers';
  import useHelper from '@/Helpers';  
  import profesor from '@/Composables/Profesor.js';
  import UsuarioForm from './Form.vue'
  const { openModal, Toast, Swal } = useHelper();
  const {
        profesores, errors, respuesta,obtenerProfesores, eliminarProfesor
    } = profesor();
    const show_tipo = ref("Habilitados")
    const titleHeader = ref({
      titulo: "Usuario",
      subTitulo: "Inicio",
      icon: "",
      vista: ""
    });
    const dato = ref({
        page:'',
        buscar:'',
        paginacion: 10,
        show_tipo : 'habilitados',
    });
    const form = ref({
        id:'',
        apepat:'',
        apemat:'',
        primernombre:'',
        otrosnombres:'',
        celular:'',
        dni: '',
        institucion_educativa_id : '',
        errors:[]

    });
    const limpiar = () => {
        form.value.id = '';
        form.value.dni = '';
        form.value.institucion_educativa_id = '';
        form.value.apepat = '';
        form.value.apemat = '';
        form.value.primernombre = '';
        form.value.otrosnombres = '';
        form.value.celular = '';
        form.value.email = '';
        form.value.errors = [];
        errors.value = [];
    };
    const obtenerDatos = async(id) => {
        await obtenerUsuario(id);
        if(usuario.value)
        {
            form.value.id=usuario.value.id;
            form.value.dni=usuario.value.dni;
            form.value.apepat=usuario.value.persona.ape_pat;
            form.value.apemat=usuario.value.persona.ape_mat;
            form.value.primernombre=usuario.value.persona.primernombre;
            form.value.otrosnombres=usuario.value.persona.otrosnombres;
            form.value.celular=usuario.value.persona.celular;
            form.value.email=usuario.value.persona.email;
        }
    }
    const editar = (id) => {
        limpiar();
        obtenerDatos(id)
        form.value.estadoCrud = 'editar'
        document.getElementById("modaldocenteLabel").innerHTML = 'Editar Usuario';
        openModal('#modaldocente')
    }
    const nuevo = () => {
        limpiar()
        form.value.estadoCrud = 'nuevo'
        openModal('#modaldocente')
        document.getElementById("modaldocenteLabel").innerHTML = 'Nuevo Usuario';
    }
    const listarProfesores = async(page=1) => {
        dato.value.page= page
        await obtenerProfesores(dato.value)
    }
    const eliminar = (id) => {
        Swal.fire({
            title: '¿Estás seguro de Eliminar?',
            text: "Profesor",
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
    const resetear = async(id) => {
        Swal.fire({
            title: '¿Estás seguro de Resetear la clave?',
            text: "profesores",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                resetearclaveUsuario(id)
            }
        })
    }
    const resetearclaveUsuario = async(id) => {
        await resetClaveUsuario(id)
        if(respuesta.value.ok==1)
        {
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            listarProfesores()
        }
    }
    const elimina = async(id) => {
        await eliminarProfesor(id)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            listarProfesores(profesores.value.current_page)
        }
    }
    const cambEstado= async(id)=>{
        await cambiarEstado(id)
        if(respuesta.value.ok==1){
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            listarProfesores()
        }
    }
    const mostrarTodos = async () => {
        show_tipo.value = 'Todos'
        dato.value.show_tipo = 'todos'
        listarProfesores()
    }
    const mostrarHabilitados = async () => {
        show_tipo.value = 'Habilitados'
        dato.value.show_tipo = 'habilitados'
        listarProfesores()
    }
    const mostrarInactivos = async () => {
        show_tipo.value = 'Inactivos'
        dato.value.show_tipo = 'inactivos'
        listarProfesores()
    }
    // PAGINACION
    const isActived = () => {
        return profesores.value.current_page
    }
    const offset = 2;

    const buscar = () => {
        listarProfesores()
    }
    const cambiarPaginacion = () => {
        listarProfesores()
    }
    const cambiarPagina =(pagina) => {
        listarProfesores(pagina)
    }
    const pagesNumber = () => {
        if(!profesores.value.to){
            return []
        }
        let from = profesores.value.current_page - offset
        if(from < 1) from = 1
        let to = from + (offset*2)
        if( to >= profesores.value.last_page) to = profesores.value.last_page
        let pagesArray = []
        while(from <= to) {
            pagesArray.push(from)
            from ++
        }
        return pagesArray
    }
const crearFormulario = (extraFields = {}) => ({
    user_id: '',
    dni: '',
    apenom: '',
    errors: [],
    ...extraFields,
});

const formRoleUser = ref(crearFormulario({ institucion_educativa_id: '' }));
const formAgenciaUser = ref(crearFormulario({ agencia_id: '' }));
const limpiarFormulario = (form) => {
    Object.keys(form.value).forEach(key => {
        form.value[key] = Array.isArray(form.value[key]) ? [] : '';
    });
};
const obtenerDatosUsuario = async (id, form) => {
    limpiarFormulario(form);
    await obtenerUsuario(id);
    if (usuario.value) {
        form.value.user_id = usuario.value.id;
        form.value.dni = usuario.value.persona?.dni;
        form.value.apenom = usuario.value.persona?.apenom;
    }
};
const nuevoRegistro = async (id, form, modalLabel, modalId) => {
    await obtenerDatosUsuario(id, form);
    if(modalLabel==='Nuevo Rol'){
        await rolesDisponibles(id)
    }else{
        await agenciasDisponibles(id)
    }
    document.getElementById(modalId+"Label").innerHTML = modalLabel;
    openModal('#'+modalId);
};


    // CARGA
    onMounted(() => {
        //defineTitle(titleHeader.value.titulo)
        listarProfesores()
    })
</script>
<template>
    <div class="app-content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h6 class="card-title">
                    Listado de Profesores
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
                    <div class="col-md-3">
                        <button data-bs-toggle="dropdown" class="btn btn-indigo btn-block">
                            Mostrar <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>{{dato.buscar}}
                        </button>
                        <div class="dropdown-menu">
                            <a href="" class="dropdown-item" @click.prevent="mostrarTodos">Todos</a>
                            <a href="" class="dropdown-item" @click.prevent="mostrarHabilitados">Habilitados</a>
                            <a href="" class="dropdown-item" @click.prevent="mostrarInactivos">Inactivos</a>
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
                                <li v-if="profesores.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="profesores.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(profesores.current_page - 1)">
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
                                <li v-if="profesores.current_page < profesores.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(profesores.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="profesores.current_page <= profesores.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(profesores.last_page)"
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
                                        <th colspan="8" class="text-center">profesores {{ show_tipo }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>DNI</th>
                                        <th>Apellidos y Nombres</th>
                                        <th>Institucion Educativa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="profesores.total == 0">
                                        <td class="text-danger text-center" colspan="7">
                                            -- Datos No Registrados - Tabla Vacía --
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(profesor,index) in profesores.data" :key="profesor.id">
                                        <td class="text-center">{{ index + profesores.from }}</td>
                                        <td>{{ profesor.persona.dni }}</td>
                                        <td>{{ profesor.persona?.apenom }}</td>
                                        <td>
                                            {{ profesor.institucion_educativa.nombre }}
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-xs" title="Editar Profesor" @click.prevent="editar(profesor.id)">
                                                <i class="fas fa-edit"></i>
                                            </button>&nbsp;
                                            <button class="btn btn-danger btn-xs" title="Eliminar Profesor" @click.prevent="eliminar(profesor.id)">
                                                <i class="fas fa-trash"></i>
                                            </button>&nbsp;
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-1">
                        Mostrando <b>{{profesores.from}}</b> a <b>{{ profesores.to }}</b> de <b>{{ profesores.total}}</b> Registros
                    </div>
                    <div class="col-md-7 mb-1 text-right">
                        <nav>
                            <ul class="pagination">
                                <li v-if="profesores.current_page >= 2" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Primera Página"
                                        @click.prevent="cambiarPagina(1)">
                                        <span><i class="fas fa-backward"></i></span>
                                    </a>
                                </li>
                                <li v-if="profesores.current_page > 1" class="page-item">
                                    <a href="#" aria-label="Previous" class="page-link"
                                        title="Página Anterior"
                                        @click.prevent="cambiarPagina(profesores.current_page - 1)">

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
                                <li v-if="profesores.current_page < profesores.last_page" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        title="Página Siguiente"
                                        @click.prevent="cambiarPagina(profesores.current_page + 1)">
                                        <span ><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </li>
                                    <li v-if="profesores.current_page <= profesores.last_page-1" class="page-item">
                                    <a href="#" aria-label="Next" class="page-link"
                                        @click.prevent="cambiarPagina(profesores.last_page)"
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
    <UsuarioForm :form="form" @onListar="listarProfesores" :currentPage="profesores.current_page"></UsuarioForm>
</template>