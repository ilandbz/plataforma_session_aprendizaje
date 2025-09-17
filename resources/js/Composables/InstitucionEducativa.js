import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'

export default function useInstitucionEducativa() {
  const instituciones = ref([])     // lista (paginada o completa)
  const institucion   = ref({})     // registro actual
  const errors        = ref('')     // errores de validación 422
  const respuesta     = ref([])     // respuesta de acciones (ok, mensaje)

  const base = 'institucion-educativa'

  const obtenerInstitucion = async (id) => {
    const r = await axios.get(`${base}/mostrar?id=${id}`, getConfigHeader())
    institucion.value = r.data
  }

  const listaInstituciones = async () => {
    const r = await axios.get(`${base}/todos`, getConfigHeader())
    instituciones.value = r.data
  }

  const obtenerInstituciones = async (data) => {
    const r = await axios.get(`${base}/listar` + getdataParamsPagination(data), getConfigHeader())
    instituciones.value = r.data
  }

  const agregarInstitucion = async (data) => {
    errors.value = ''
    try {
      const r = await axios.post(`${base}/guardar`, data, getConfigHeader())
      if (r.data.ok === 1) respuesta.value = r.data
    } catch (e) {
      if (e.response?.status === 422) errors.value = e.response.data.errors
    }
  }

  const actualizarInstitucion = async (data) => {
    errors.value = ''
    try {
      const r = await axios.post(`${base}/actualizar`, data, getConfigHeader())
      if (r.data.ok === 1) respuesta.value = r.data
    } catch (e) {
      if (e.response?.status === 422) errors.value = e.response.data.errors
    }
  }

  const eliminarInstitucion = async (id) => {
    const r = await axios.post(`${base}/eliminar`, { id }, getConfigHeader())
    if (r.data.ok === 1) respuesta.value = r.data
  }

  return {
    // state
    instituciones,
    institucion,
    errors,
    respuesta,
    // actions
    obtenerInstitucion,
    listaInstituciones,
    obtenerInstituciones,
    agregarInstitucion,
    actualizarInstitucion,
    eliminarInstitucion,
  }
}
