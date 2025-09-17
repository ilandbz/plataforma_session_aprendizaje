import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'

export default function useTipoUnidadAprendizaje() {
  const tipoUnidadAprendizajes = ref([])
  const tipoUnidadAprendizaje = ref({})
  const errors = ref('')
  const respuesta = ref([])

  const obtenerTipoUnidadAprendizaje = async (id) => {
    const res = await axios.get(
      'tipo-unidad-aprendizaje/mostrar?id=' + id,
      getConfigHeader()
    )
    tipoUnidadAprendizaje.value = res.data
  }

  const listaTipoUnidadAprendizajes = async () => {
    const res = await axios.get(
      'tipo-unidad-aprendizaje/todos',
      getConfigHeader()
    )
    tipoUnidadAprendizajes.value = res.data
  }

  const obtenerTipoUnidadAprendizajes = async (data) => {
    const res = await axios.get(
      'tipo-unidad-aprendizaje/listar' + getdataParamsPagination(data),
      getConfigHeader()
    )
    tipoUnidadAprendizajes.value = res.data
  }

  const agregarTipoUnidadAprendizaje = async (data) => {
    errors.value = ''
    try {
      const res = await axios.post(
        'tipo-unidad-aprendizaje/guardar',
        data,
        getConfigHeader()
      )
      if (res.data.ok == 1) {
        respuesta.value = res.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const actualizarTipoUnidadAprendizaje = async (data) => {
    errors.value = ''
    try {
      const res = await axios.post(
        'tipo-unidad-aprendizaje/actualizar',
        data,
        getConfigHeader()
      )
      if (res.data.ok == 1) {
        respuesta.value = res.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const eliminarTipoUnidadAprendizaje = async (id) => {
    const res = await axios.post(
      'tipo-unidad-aprendizaje/eliminar',
      { id },
      getConfigHeader()
    )
    if (res.data.ok == 1) {
      respuesta.value = res.data
    }
  }

  return {
    // state
    errors,
    respuesta,
    tipoUnidadAprendizajes,
    tipoUnidadAprendizaje,
    // actions
    obtenerTipoUnidadAprendizaje,
    listaTipoUnidadAprendizajes,
    obtenerTipoUnidadAprendizajes,
    agregarTipoUnidadAprendizaje,
    actualizarTipoUnidadAprendizaje,
    eliminarTipoUnidadAprendizaje
  }
}