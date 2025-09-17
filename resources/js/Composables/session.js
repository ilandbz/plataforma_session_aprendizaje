import { onMounted, provide, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useUsuarioStore } from '@/Store';
import { jwtDecode } from 'jwt-decode'
import axios from 'axios'
export default function useDatosSession() {

    const user_id = localStorage.getItem('userSession') ? JSON.parse( JSON.stringify(jwtDecode(localStorage.getItem('userSession')).user)) : null
    ;

    const usuarioStore = useUsuarioStore();
    const  menuactivo = ref();
    const { usuario, menus, role } = storeToRefs(usuarioStore)

    const { cargarDatosSession, modificarFoto, cambiarAgencia, cambiarRole} = useUsuarioStore()

    const obtenerUsuarioSesion = async() => {
        if(user_id != null)
        {
            await cargarDatosSession();
            //cargarMenus();
        }
    }

    onMounted(() => {
        obtenerUsuarioSesion()
    })

    const cambiarFoto = async(foto) => {
        modificarFoto(foto);
    }

    return {
        usuario, menus, cambiarFoto, menuactivo, role, cambiarRole, cambiarAgencia
    }
}