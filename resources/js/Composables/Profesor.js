import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'

export default function useProfesor() {
  const profesores = ref([])
  const errors = ref('')
  const profesor = ref({})
  const respuesta = ref([])

  const obtenerProfesor = async (id) => {
    const resp = await axios.get('profesor/mostrar?id=' + id, getConfigHeader())
    profesor.value = resp.data
  }

  const listaProfesores = async () => {
    const resp = await axios.get('profesor/todos', getConfigHeader())
    profesores.value = resp.data
  }

  const obtenerProfesores = async (data) => {
    const resp = await axios.get('profesor/listar' + getdataParamsPagination(data), getConfigHeader())
    profesores.value = resp.data
  }

  const agregarProfesor = async (data) => {
    errors.value = ''
    try {
      const resp = await axios.post('profesor/guardar', data, getConfigHeader())
      errors.value = ''
      if (resp.data.ok == 1) {
        respuesta.value = resp.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response && error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const actualizarProfesor = async (data) => {
    errors.value = ''
    try {
      const resp = await axios.post('profesor/actualizar', data, getConfigHeader())
      errors.value = ''
      if (resp.data.ok == 1) {
        respuesta.value = resp.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response && error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const eliminarProfesor = async (id) => {
    const resp = await axios.post('profesor/eliminar', { id }, getConfigHeader())
    if (resp.data.ok == 1) {
      respuesta.value = resp.data
    }
  }

  return {
    errors,
    profesores,
    listaProfesores,
    profesor,
    obtenerProfesor,
    obtenerProfesores,
    agregarProfesor,
    actualizarProfesor,
    eliminarProfesor,
    respuesta
  }
}
