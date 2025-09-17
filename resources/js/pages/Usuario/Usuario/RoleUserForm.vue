<script setup>
import { toRefs, onMounted, ref } from 'vue';
import useUsuario from '@/Composables/Usuario.js';
import useHelper from '@/Helpers';  
const { hideModal, Toast, slugify } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number,
    roles: Array,
});
const  emit  =defineEmits(['onListar'])
const { form, currentPage, roles } = toRefs(props)
const {
    agregarRole, respuesta, errors
} = useUsuario();
const guardar =async() => {
    await agregarRole(form.value)
    form.value.errors = []
    if(errors.value)
    {
        form.value.errors = errors.value
    }
    if(respuesta.value.ok==1){
        form.value.errors = []
        hideModal('#modalRoleUser')
        Toast.fire({icon:'success', title:respuesta.value.mensaje})
        emit('onListar', currentPage.value)
    }
}

</script>
<template>
    <form @submit.prevent="guardar">
    <div class="modal fade" id="modalRoleUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalRoleUserLabel">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-1" id="modalRoleUserLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group has-validation input-group-sm pb-1">
                                <div class="form-floating is-invalid">
                                    <input type="text" class="form-control form-control-sm" :value="form.dni" readonly>
                                    <label for="floatingInputGroup1">DNI</label>
                                </div>
                                <span class="input-group-text">{{ form.apenom }}</span>                                                                   
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Rol</label>
                                <select v-model="form.role_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.role_id }">
                                    <option value="" disabled>--Seleccione--</option>
                                    <option v-for="role in roles" :key="role.id" :value="role.id"
                                        :title="role.nombre">
                                        {{ role.nombre }}
                                    </option>
                                </select>
                                <small class="text-danger" v-for="error in form.errors.role_id" :key="error">{{ error
                                        }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</template>