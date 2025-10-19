<script setup>
import { toRefs, onMounted, ref } from 'vue';
import useUsuario from '@/Composables/Usuario';
import useHelper from '@/Helpers';
const { Toast } = useHelper();
const props = defineProps({
    usuario: Object,
    role: Object,
});

const foto = ref('storage/fotos/usuarios/');
const imagenNoEncontrada = (event)=>{
    event.target.src = "/storage/fotos/default.png";
}

const { usuario, role } = toRefs(props)
const {
    errors, respuesta, cambiarImagen
} = useUsuario();
const mostrarBotonGuardar = ref(false);

const cambiarImage = (event) => {
  const file = event.target.files[0];
  if (file) {
    mostrarBotonGuardar.value = true;
    const reader = new FileReader();
    reader.onload = () => {
      document.getElementById('inputImagen').src = reader.result;
    };
    reader.readAsDataURL(file);
  }
};
const guardarImagen = async () => {
  const inputFile = document.querySelector('input[type="file"]');
  const file = inputFile.files[0];

  if (!file) {
    console.warn("No se ha seleccionado una imagen.");
    return;
  }

  const formData = new FormData();
  formData.append('foto', file);
  formData.append('username', usuario.value.name); // ejemplo: 'cristian'

    await cambiarImagen(formData)
      if(errors.value)
      {
          alert('No se pudo conectar al servidor. '+errors.value);
      }
      if(respuesta.value.ok==1){
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        mostrarBotonGuardar.value = false
    }

};
</script>
<template>
  <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModal-label" >
      <div class="modal-dialog mt-6" role="document">
        <div class="modal-content border-0">
          <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
            <div class="position-relative z-1" data-bs-theme="light">
              <h4 class="mb-0 text-white" id="perfilModal-label">Perfil</h4>
            </div><button class="btn-close btn-close-white position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-4 px-5">
            <img id="inputImagen" :src="foto+usuario.name+'.webp'" class="img-fluid img-thumbnail" @error="imagenNoEncontrada">
            <div class="d-flex gap-2 mb-4">
              <label class="btn btn-outline-primary btn-sm">
                <i class="bi bi-image"></i> Cambiar imagen
                <input type="file" @change="cambiarImage" accept="image/*" class="d-none">
              </label>
            </div>
            <div class="card shadow-sm border-0" style="max-width: 400px;">
                <div class="card-body">
                    <p class="text-muted mb-1"><i class="bi bi-person-circle me-2"></i><strong>Rol:</strong> {{ role.nombre }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-person-circle me-2"></i><strong>Agencia:</strong> {{ usuario.agencia?.nombre }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-person-circle me-2"></i><strong>Name:</strong> {{ usuario.name }}</p>
                </div>
            </div>
            <div class="border-bottom border-dashed my-4 d-lg-none"></div>
          </div>
          <div class="modal-footer">
            <button v-if="mostrarBotonGuardar" class="btn btn-success btn-sm" @click="guardarImagen">
              Guardar <i class="fas fa-save"></i>
            </button>
          </div>
        </div>
      </div>
  </div> 
</template>
