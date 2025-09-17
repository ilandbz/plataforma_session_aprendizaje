<script setup>
import { toRefs, ref, nextTick  } from 'vue';
import { useAutenticacion } from '@/Composables/autenticacion';
import useHelper from '@/Helpers';
import useUsuario from '@/Composables/Usuario';
import FormPerfil from '@/Pages/Usuario/Profile.vue'

const  emit  =defineEmits(['cambiarRole', 'cambiarAgencia'])
const props = defineProps({
    usuario: Object,
    role: Object,

});
const form = ref({
  current_password : '',
  password : '',
  password_confirmation : '',
  errors : []
});

const { usuario, role } = toRefs(props);
const {
    errors, respuesta, cambiarClave
} = useUsuario();
  const { logoutUsuario }= useAutenticacion();
  const logout = async() => {
    await logoutUsuario(usuario.value.id)
  }
  const { Swal, hideModal, Toast } = useHelper();
  const cerrarSesion = async() => {
    Swal.fire({
        title:'¿Está seguro de Cerrar Sesión?',
        text:'SISTEMA FINANCIERO',
        icon:'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if(result.isConfirmed) {
            logout()
        }
    })
  }
  const guardar=async()=>{
    await cambiarClave(form.value)
    form.value.errors = []
    if(errors.value){
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        hideModal('#cambiarClaveModal')
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
    }
  }
  const cambiarRol = (id) => {
    emit('cambiarRole', id, agencia.value.id)
  }
  const cambiaAgencia = (id) => {
    emit('cambiarAgencia', id, role.value.id)
  }

const imagenNoEncontrada = (event)=>{
    event.target.src = "/imagenes/ironman.png";
}

</script>



<template>
  <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
    data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
    aria-expanded="false" aria-label="Navegacion"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="/">
      <div class="d-flex align-items-center"><img class="me-2" src="logo.jpg" alt="" width="40">
        <span class="font-sans-serif">
        PLATAFORMA DE ACTIVIDADES DE APRENDIZAJE
        </span>
      </div>
    </a>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

      <li class="nav-item px-2">
        <div class="theme-control-toggle fa-icon-wait">
          <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox" data-theme-control="theme" value="dark">
          <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar">
            <span class="fas fa-sun fs-0"></span>
          </label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Cambiar de Tema">
            <span class="fas fa-moon fs-0"></span>
          </label>
        </div>
      </li>
      <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-xl">
            <img class="rounded-circle" :src="'storage/fotos/usuarios/'+usuario.name+'.webp'" alt="" @error="imagenNoEncontrada">
          </div>
        </a>
        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
          <div class="bg-white dark__bg-1000 rounded-2 py-2">
            <a class="dropdown-item fw-bold text-info" href="#!">User : <span>{{ usuario.name }}</span></a>
            <a class="dropdown-item fw-bold text-warning" href="#!"><span>{{ role.nombre }}</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#agencias" data-bs-toggle="modal" v-if="usuario.agencias?.length>1">Agencias</a>
            <a class="dropdown-item" href="#perfilModal" data-bs-toggle="modal">Perfil</a>
            <a class="dropdown-item" href="#cambiarClaveModal" data-bs-toggle="modal">Cambiar Clave</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"
                  @click.prevent="cerrarSesion">
                  Cerrar Sesi&oacute;n
              </a>
          </div>
        </div>
      </li>
    </ul>
  </nav>
  <div class="modal fade" id="agencias" tabindex="-1" role="dialog" aria-labelledby="agencias-label" >
      <div class="modal-dialog mt-6" role="document">
        <div class="modal-content border-0">
          <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
            <div class="position-relative z-1" data-bs-theme="light">
              <h4 class="mb-0 text-white" id="agencias-label">Agencias</h4>
            </div><button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-4 px-5">
            <form>
              <h4 v-for="agencia in usuario.agencias">{{ agencia.nombre }}</h4>
            </form>
          </div>
        </div>
      </div>
  </div>
  <FormPerfil :usuario="usuario" :role="role"></FormPerfil>
  <div class="modal fade" id="cambiarClaveModal" tabindex="-1" role="dialog" aria-labelledby="cambiarClaveModal-label" >
    <div class="modal-dialog mt-6 modal-sm" role="document">
      <div class="modal-content border-0">
        <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
          <div class="position-relative z-1" data-bs-theme="light">
            <h4 class="mb-0 text-white" id="cambiarClaveModal-label">Cambiar Clave</h4>
          </div><button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                  <label for="clave_actual" class="form-label">Clave Actual</label>
                  <input type="password" class="form-control" v-model="form.current_password" :class="{ 'is-invalid': form.errors.current_password }">
                  <small class="text-danger" v-for="error in form.errors.current_password" :key="error">{{ error }}</small>
                </div>
                <div class="mb-3">
                  <label for="nueva_clave" class="form-label">Nueva Clave</label>
                  <input type="password" class="form-control" v-model="form.password" :class="{ 'is-invalid': form.errors.password }">
                  <small class="text-danger" v-for="error in form.errors.password" :key="error">{{ error }}</small>
                </div>
                <div class="mb-3">
                  <label for="confirmar_clave" class="form-label">Confirmar Nueva Clave</label>
                  <input type="password" class="form-control" v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.password_confirmation }">
                  <small class="text-danger" v-for="error in form.errors.password_confirmation" :key="error">{{ error }}</small>
                </div>
            </div>
            <div class="card-footer text-muted">
              <button type="button" class="btn btn-primary" @click="guardar">
                <i class="fas fa-key"></i> Cambiar Clave
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</template>