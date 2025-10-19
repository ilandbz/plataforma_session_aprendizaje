<script setup>
import { toRefs, onMounted, ref } from 'vue';
import useProfesor from '@/Composables/Profesor.js';
import usePersona from '@/Composables/Persona.js';
import useInstitucionEducativa from '@/Composables/InstitucionEducativa.js';
import useRol from '@/Composables/Rol.js';
import useHelper from '@/Helpers';  
const { hideModal, Toast, slugify } = useHelper();
const props = defineProps({
    form: Object,
    currentPage : Number
});
const { form, currentPage } = toRefs(props)
const {
    errors, respuesta, agregarProfesor, actualizarProfesor
} = useProfesor();
const {
    listaInstituciones, instituciones, obtenerInstitucion, institucion
} = useInstitucionEducativa();
const {
    persona, obtenerPorDni
} = usePersona();
const {
    listaRoles, roles
} = useRol();
const  emit  =defineEmits(['onListar'])
const crud = {
    'nuevo': async() => {
        let formData = new FormData();
        formData.append('name', form.value.name);
        formData.append('dni', form.value.dni);
        formData.append('apepat', form.value.apepat);
        formData.append('apemat', form.value.apemat);
        formData.append('primernombre', form.value.primernombre);
        formData.append('otrosnombres', form.value.otrosnombres);
        formData.append('celular', form.value.celular);
        formData.append('email', form.value.email);
        formData.append('institucion_educativa_id', form.value.institucion_educativa_id);
        await agregarProfesor(formData)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modaldocente')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)
        }
    },
    'editar': async() => {
        let formData = new FormData();
        formData.append('id', form.value.id);
        formData.append('name', form.value.name);
        formData.append('dni', form.value.dni);
        formData.append('apepat', form.value.apepat);
        formData.append('apemat', form.value.apemat);
        formData.append('primernombre', form.value.primernombre);
        formData.append('otrosnombres', form.value.otrosnombres);
        formData.append('celular', form.value.celular);
        formData.append('email', form.value.email);
        formData.append('institucion_educativa_id', form.value.institucion_educativa_id);
        await actualizarProfesor(formData)
        form.value.errors = []
        if(errors.value)
        {
            form.value.errors = errors.value
        }
        if(respuesta.value.ok==1){
            form.value.errors = []
            hideModal('#modaldocente')
            Toast.fire({icon:'success', title:respuesta.value.mensaje})
            emit('onListar', currentPage.value)
        }
    }
}
const guardar = () => {
    crud[form.value.estadoCrud]()
}
const onlyNumbers=(event)=> {
    if (!/[0-9]/.test(event.key)) {
        event.preventDefault();
    }
}
const file = ref(null);
const buscarPersona= async(dni)=>{
    await obtenerPorDni(dni)
    if(persona.value){
        form.value.apepat = persona.value.ape_pat
        form.value.apemat = persona.value.ape_mat
        form.value.primernombre = persona.value.primernombre
        form.value.otrosnombres = persona.value.otrosnombres
    }
}
onMounted(() => {
    listaRoles()
    listaInstituciones()
})
</script>
<template>
    <form @submit.prevent="guardar">
        <div class="modal fade" id="modaldocente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modaldocenteLabel">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-1" id="modaldocenteLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Datos de Profesor</h6>
                                <div class="mb-3">
                                    <label for="name" class="form-label">DNI</label>
                                    <input type="text" class="form-control" v-model="form.dni" :class="{ 'is-invalid': form.errors.dni }"
                                    maxlength="8"
                                    placeholder="00000000"
                                    @keypress="onlyNumbers"
                                    @change="buscarPersona(form.dni)"
                                    :readonly="form.estadoCrud=='editar'">
                                    <small class="text-danger" v-for="error in form.errors.dni" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" v-model="form.apepat" @input="form.apepat = form.apepat.toUpperCase()"
                                    :class="{ 'is-invalid': form.errors.apepat }" placeholder="Apellido Paterno"
                                    :readonly="form.estadoCrud=='editar'">
                                    <small class="text-danger" v-for="error in form.errors.apepat" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" v-model="form.apemat"
                                    @input="form.apemat = form.apemat.toUpperCase()" :class="{ 'is-invalid': form.errors.apemat }" placeholder="Apellido Materno"
                                    :readonly="form.estadoCrud=='editar'">
                                    <small class="text-danger" v-for="error in form.errors.apemat" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Primer Nombre</label>
                                    <input type="text" class="form-control" v-model="form.primernombre"
                                    @input="form.primernombre = form.primernombre.toUpperCase()" :class="{ 'is-invalid': form.errors.primernombre }" placeholder="Primer Nombre"
                                    :readonly="form.estadoCrud=='editar'">
                                    <small class="text-danger" v-for="error in form.errors.primernombre" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Otros Nombres</label>
                                    <input type="text" class="form-control" v-model="form.otrosnombres"
                                    @input="form.otrosnombres = form.otrosnombres.toUpperCase()" :class="{ 'is-invalid': form.errors.otrosnombres }" placeholder="Otros Nombres"
                                    :readonly="form.estadoCrud=='editar'">
                                    <small class="text-danger" v-for="error in form.errors.otrosnombres" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="institucion_educativa_id" class="form-label">Institución Educativa</label>
                                    <select class="form-select" v-model="form.institucion_educativa_id"
                                            :class="{ 'is-invalid': form.errors.institucion_educativa_id }">
                                        <option value="" hidden>-- Seleccione --</option>
                                        <option v-for="ie in instituciones" :key="ie.id" :value="ie.id">{{ ie.nombre }}</option>
                                    </select>
                                    <small class="text-danger" v-for="error in form.errors.institucion_educativa_id" :key="error">{{ error }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Celular</label>
                                    <input type="text" class="form-control" v-model="form.celular" :class="{ 'is-invalid': form.errors.celular }"
                                    maxlength="9"
                                    placeholder="000000000"
                                    @keypress="onlyNumbers"
                                    >
                                    <small class="text-danger" v-for="error in form.errors.celular" :key="error">{{ error
                                            }}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="form.email" :class="{ 'is-invalid': form.errors.email }"
                                    placeholder="a@gmail.com"
                                    >
                                    <small class="text-danger" v-for="error in form.errors.email" :key="error">{{ error
                                            }}</small>
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