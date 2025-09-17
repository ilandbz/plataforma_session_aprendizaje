<script setup>
import { toRefs, onMounted } from 'vue';
import useInstitucionEducativa from '@/Composables/InstitucionEducativa.js';
import useHelper from '@/Helpers';  
const { hideModal, Toast } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number
});
const { form, currentPage } = toRefs(props)
const {
    errors, respuesta, agregarInstitucion, actualizarInstitucion
} = useInstitucionEducativa();
const  emit  =defineEmits(['onListar'])
const crud = {
    'nuevo': async() => {
        await agregarInstitucion(form.value)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modalinstitucion')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)

            
        }
    },
    'editar': async() => {
        await actualizarInstitucion(form.value)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modalinstitucion')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)
        }
    }
}
const guardar = () => {
    crud[form.value.estadoCrud]()
}
onMounted(() => {

})
</script>
<template>
    <form @submit.prevent="guardar">
    <div class="modal fade" id="modalinstitucion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalinstitucionLabel" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalinstitucionLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" v-model="form.codigo" 
                            :class="{ 'is-invalid': form.errors.codigo }" placeholder="Código">
                    <small class="text-danger" v-for="error in form.errors.codigo" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" v-model="form.nombre" 
                            :class="{ 'is-invalid': form.errors.nombre }" placeholder="Nombre">
                    <small class="text-danger" v-for="error in form.errors.nombre" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" v-model="form.direccion" 
                            :class="{ 'is-invalid': form.errors.direccion }" placeholder="Dirección">
                    <small class="text-danger" v-for="error in form.errors.direccion" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" v-model="form.telefono" 
                            :class="{ 'is-invalid': form.errors.telefono }" placeholder="Teléfono">
                    <small class="text-danger" v-for="error in form.errors.telefono" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="form.email" 
                            :class="{ 'is-invalid': form.errors.email }" placeholder="Correo electrónico">
                    <small class="text-danger" v-for="error in form.errors.email" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" class="form-control" v-model="form.director" 
                            :class="{ 'is-invalid': form.errors.director }" placeholder="Director">
                    <small class="text-danger" v-for="error in form.errors.director" :key="error">{{ error }}</small>
                    </div>

                    <div class="mb-3">
                    <label for="sub_director" class="form-label">Sub Director</label>
                    <input type="text" class="form-control" v-model="form.sub_director" 
                            :class="{ 'is-invalid': form.errors.sub_director }" placeholder="Sub Director">
                    <small class="text-danger" v-for="error in form.errors.sub_director" :key="error">{{ error }}</small>
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