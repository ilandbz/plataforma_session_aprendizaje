import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'

export default function usePropositoAprendizaje() {
  const propositos = ref([])         // lista paginada o completa
  const errors = ref('')
  const proposito = ref({})          // item individual
  const respuesta = ref([])          // respuesta estándar del backend

  const obtenerProposito = async (id) => {
    const resp = await axios.get('proposito-aprendizaje/mostrar?id=' + id, getConfigHeader())
    proposito.value = resp.data
  }

  const listaPropositos = async (id) => {
    const resp = await axios.get('proposito-aprendizaje/todos?id='+id, getConfigHeader())
    propositos.value = resp.data
  }

  const obtenerPropositos = async (data) => {
    const resp = await axios.get('proposito-aprendizaje/listar' + getdataParamsPagination(data), getConfigHeader())
    propositos.value = resp.data
  }

  const agregarProposito = async (data) => {
    errors.value = ''
    try {
      const resp = await axios.post('proposito-aprendizaje/guardar', data, getConfigHeader())
      errors.value = ''
      if (resp.data.ok == 1) {
        respuesta.value = resp.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const actualizarProposito = async (data) => {
    errors.value = ''
    try {
      const resp = await axios.post('proposito-aprendizaje/actualizar', data, getConfigHeader())
      errors.value = ''
      if (resp.data.ok == 1) {
        respuesta.value = resp.data
      }
    } catch (error) {
      errors.value = ''
      if (error.response?.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const eliminarProposito = async (id) => {
    const resp = await axios.post('proposito-aprendizaje/eliminar', { id }, getConfigHeader())
    if (resp.data.ok == 1) {
      respuesta.value = resp.data
    }
  }

  return {
    errors,
    propositos,
    listaPropositos,
    proposito,
    obtenerProposito,
    obtenerPropositos,
    agregarProposito,
    actualizarProposito,
    eliminarProposito,
    respuesta
  }
}