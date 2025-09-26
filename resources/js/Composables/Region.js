import axios from 'axios'
import { ref } from 'vue'
import { getConfigHeader, getdataParamsPagination } from '@/Helpers'
export default function useRegion() {
    const regiones = ref([])
    const errors = ref('')
    const respuesta = ref([])
    

    const listaRegiones = async()=>{
        let respuesta = await axios.get('region/todos',getConfigHeader())
        regiones.value = respuesta.data        
    }

    return {
        errors, regiones, listaRegiones, respuesta
    }
}