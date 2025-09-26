import { createRouter, createWebHistory } from "vue-router";
import { jwtDecode } from 'jwt-decode'
//PLANTILLAS
import LayoutLogin from '@/Layouts/AppLayoutLogin.vue'
import LayoutDefault from '@/Layouts/AppLayoutDefault.vue'

//vistas
import Principal from '@/Pages/Principal.vue'
import Login from '@/Pages/Auth/Login.vue'
import Menu from '@/Pages/Menu/Inicio.vue'
import Usuario from '@/Pages/Usuario/Inicio.vue'
import Area from '@/Pages/Area/Inicio.vue'
import InstitucionEducativa from '@/Pages/InstitucionEducativa/Inicio.vue'
import TipoUnidadAprendizaje from '@/Pages/TipoUnidadAprendizaje/Inicio.vue'
import UnidadAprendizaje from '@/Pages/UnidadAprendizaje/Inicio.vue'
import PlantillaUnidadAprendizaje from '@/Pages/PlantillaUnidadAprendizaje/Inicio.vue'
import Profesor from '@/Pages/Profesor/Inicio.vue'

const routes = [
    {
        path: '/', name:'Principal', component: Principal ,
        meta:{layout: LayoutDefault}
    },
    {
        path: '/login',name: 'Login', component: Login,
        meta: {layout: LayoutLogin}
    },
    {
        path: '/gestion-menus',name: 'Menus', component: Menu,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/gestion-usuarios',name: 'Usuarios', component: Usuario,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/areas-aprendizaje',name: 'Areas', component: Area,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/tipo-unidad-aprendizaje',name: 'Tipo Unidad Aprendizaje', component: TipoUnidadAprendizaje,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/institucion-educativa',name: 'Institucion Educativa', component: InstitucionEducativa,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/unidad-aprendizaje',name: 'Unidad Aprendizaje', component: UnidadAprendizaje,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/plantilla-unidad-aprendizaje',name: 'Plantilla Unidad', component: PlantillaUnidadAprendizaje,
        meta: {layout: LayoutDefault}
    },
    {
        path: '/profesor',name: 'Profesor', component: Profesor,
        meta: {layout: LayoutDefault}
    },

]
export default createRouter({
    history: createWebHistory(),
    routes
})