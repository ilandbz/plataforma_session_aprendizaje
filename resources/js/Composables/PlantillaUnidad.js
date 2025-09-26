import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'
export default function usePlantillaUnidad() {
    const registros = ref([])
    const errors = ref('')
    const registro = ref({})
    const respuesta = ref([])
    
    const obtenerRegistro = async(id) => {
        let respuesta = await axios.get('plantilla-unidad-aprendizaje/mostrar?id='+id,getConfigHeader())
        registro.value = respuesta.data
    }
    const listaRegistros = async()=>{
        let respuesta = await axios.get('plantilla-unidad-aprendizaje/todos',getConfigHeader())
        registros.value = respuesta.data        
    }
    const obtenerRegistros = async(data) => {
        let respuesta = await axios.get('plantilla-unidad-aprendizaje/listar' + getdataParamsPagination(data),getConfigHeader())
        registros.value =respuesta.data
    }
    const agregarRegistro = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('plantilla-unidad-aprendizaje/guardar',data,getConfigHeader())
            errors.value =''
            if(respond.data.ok==1){
                respuesta.value=respond.data
            }
        } catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }
    const actualizarRegistro = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('plantilla-unidad-aprendizaje/actualizar',data,getConfigHeader())
            errors.value =''
            if(respond.data.ok==1){
                respuesta.value=respond.data
            }

        } catch (error) {
            errors.value=""
            if(error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        }
    }
    const eliminarRegistro = async(id) => {
        const respond = await axios.post('plantilla-unidad-aprendizaje/eliminar', {id:id},getConfigHeader())
        if(respond.data.ok==1)
        {
            respuesta.value = respond.data
        }
    }
    return {
        errors, registros, listaRegistros, registro, obtenerRegistro, obtenerRegistros, 
        agregarRegistro, actualizarRegistro, eliminarRegistro, respuesta
    }
}