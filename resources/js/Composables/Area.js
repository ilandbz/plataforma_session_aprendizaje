import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'
export default function useArea() {
    const areas = ref([])
    const errors = ref('')
    const area = ref({})
    const respuesta = ref([])
    
    const obtenerArea = async(id) => {
        let respuesta = await axios.get('area/mostrar?id='+id,getConfigHeader())
        area.value = respuesta.data
    }
    const listaAreas = async()=>{
        let respuesta = await axios.get('area/todos',getConfigHeader())
        areas.value = respuesta.data        
    }
    const obtenerAreas = async(data) => {
        let respuesta = await axios.get('area/listar' + getdataParamsPagination(data),getConfigHeader())
        areas.value =respuesta.data
    }
    const agregarArea = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('area/guardar',data,getConfigHeader())
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
    const actualizarArea = async(data) => {
        errors.value = ''
        try {
            let respond = await axios.post('area/actualizar',data,getConfigHeader())
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
    const eliminarArea = async(id) => {
        const respond = await axios.post('area/eliminar', {id:id},getConfigHeader())
        if(respond.data.ok==1)
        {
            respuesta.value = respond.data
        }
    }
    return {
        errors, areas, listaAreas, area, obtenerArea, obtenerAreas, 
        agregarArea, actualizarArea, eliminarArea, respuesta
    }
}