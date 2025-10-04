import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'

export default function useActividadAprendizaje() {
    const actividades = ref([])
    const actividad = ref({})
    const errors = ref('')
    const respuesta = ref([])

    const obtenerActividad = async (id) => {
        let respond = await axios.get('actividad-aprendizaje/mostrar?id=' + id, getConfigHeader())
        actividad.value = respond.data
    }

    const listaActividades = async () => {
        let respond = await axios.get('actividad-aprendizaje/todos', getConfigHeader())
        actividades.value = respond.data
    }

    const obtenerActividades = async (data) => {
        let respond = await axios.get('actividad-aprendizaje/listar' + getdataParamsPagination(data), getConfigHeader())
        actividades.value = respond.data
    }

    const agregarActividad = async (data) => {
        errors.value = ''
        try {
            let respond = await axios.post('actividad-aprendizaje/guardar', data, getConfigHeader())
            errors.value = ''
            if (respond.data.ok == 1) {
                respuesta.value = respond.data
            }
        } catch (error) {
            errors.value = ''
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }

    const actualizarActividad = async (data) => {
        errors.value = ''
        try {
            let respond = await axios.post('actividad-aprendizaje/actualizar', data, getConfigHeader())
            errors.value = ''
            if (respond.data.ok == 1) {
                respuesta.value = respond.data
            }
        } catch (error) {
            errors.value = ''
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }

    const eliminarActividad = async (id) => {
        const respond = await axios.post('actividad-aprendizaje/eliminar', { id: id }, getConfigHeader())
        if (respond.data.ok == 1) {
            respuesta.value = respond.data
        }
    }

    return {
        errors,
        actividades,
        actividad,
        respuesta,
        obtenerActividad,
        listaActividades,
        obtenerActividades,
        agregarActividad,
        actualizarActividad,
        eliminarActividad
    }
}
