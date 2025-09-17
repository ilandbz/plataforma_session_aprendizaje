import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination, getConfigHeaderpdf } from '@/Helpers'

export default function useUnidadAprendizaje() {
  const unidades  = ref([])
  const unidad    = ref({}) 
  const errors    = ref('')
  const respuesta = ref([]) 
  const pdfUrl = ref('')
  const base = 'unidad-aprendizaje'

  const obtenerUnidad = async (id) => {
    const r = await axios.get(`${base}/mostrar?id=${id}`, getConfigHeader())
    unidad.value = r.data
  }

  const listaUnidades = async () => {
    const r = await axios.get(`${base}/todos`, getConfigHeader())
    unidades.value = r.data
  }

  const obtenerUnidades = async (data) => {
    const r = await axios.get(`${base}/listar` + getdataParamsPagination(data), getConfigHeader())
    unidades.value = r.data
  }

  const agregarUnidad = async (data) => {
    errors.value = ''
    try {
      const r = await axios.post(`${base}/guardar`, data, getConfigHeader())
      if (r.data.ok === 1) respuesta.value = r.data
    } catch (e) {
      if (e.response?.status === 422) errors.value = e.response.data.errors
    }
  }


  const generarPdf = async (data) => {
      errors.value = "";
      try {
          let response = await axios.post(`${base}/generar-pdf`,data,getConfigHeaderpdf());
  
          const file = new Blob([response.data], { type: "application/pdf" });
          pdfUrl.value = URL.createObjectURL(file);
  
      } catch (error) {
          console.error("Error al generar el PDF:", error);
          if (error.response && error.response.status === 422) {
              errors.value = error.response.data.errors;
          }
      }
  }

  const actualizarUnidad = async (data) => {
    errors.value = ''
    try {
      const r = await axios.post(`${base}/actualizar`, data, getConfigHeader())
      if (r.data.ok === 1) respuesta.value = r.data
    } catch (e) {
      if (e.response?.status === 422) errors.value = e.response.data.errors
    }
  }

  const eliminarUnidad = async (id) => {
    const r = await axios.post(`${base}/eliminar`, { id }, getConfigHeader())
    if (r.data.ok === 1) respuesta.value = r.data
  }

  return {
    // state
    unidades,
    unidad,
    errors,
    respuesta,
    pdfUrl,
    // actions
    obtenerUnidad,
    listaUnidades,
    obtenerUnidades,
    agregarUnidad,
    actualizarUnidad,
    eliminarUnidad,
    generarPdf
  }
}
