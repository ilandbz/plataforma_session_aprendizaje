<script setup>
import {useAutenticacion} from '@/Composables/autenticacion';
import { ref, onMounted } from 'vue';
import useHelper from '@/Helpers'; 
const { openModal, Toast, Swal } = useHelper();
const {errors, loginUsuario } = useAutenticacion();
    const user = ref({
        username:'',
        password:'',
        remember:false,
    });


    const autenticar = async() => {
        await loginUsuario(user.value);
    }




</script>
<template>



<div class="container-fluid">
    <div class="row min-vh-100 bg-100 flex-center g-0">
        <div class="col-lg-8 col-xxl-5 py-3 position-relative">
            <img class="bg-auth-circle-shape" src="falcon316/assets/img/icons/spot-illustrations/bg-shape.png" alt="Background Shape" width="250">
            <img class="bg-auth-circle-shape-2" src="falcon316/assets/img/icons/spot-illustrations/shape-1.png" alt="Background Shape 2" width="150">
            <div class="card overflow-hidden z-1">
            <div class="card-body p-0">
                <div class="row g-0 h-100">
                <div class="col-md-5 text-center bg-card-gradient">
                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                    <div class="bg-holder bg-auth-card-shape" style="background-image:url(falcon316/assets/img/icons/spot-illustrations/half-circle.png);"></div>
                    <div class="z-1 position-relative">
                        <a class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder" href="#">
                        <img src="imagenes/logo.png" alt="Logo" width="90%">
                        </a>
                        <p class="opacity-75 text-white">PLATAFORMA SESION DE APRENDIZAJE</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-7 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                        <div class="row flex-between-center">
                            <div class="col-auto">
                            <h3>Iniciar Sesión</h3>
                            </div>
                        </div>
                        <form action="" @submit.prevent="autenticar">
                            <div class="mb-3">
                                <label class="form-label" for="split-login-email">Nombre de Usuario</label>
                                <input class="form-control" id="split-login-email" type="text" v-model="user.username"
                                :class="{ 'is-invalid' : errors.username }">
                                <small class="text-danger" v-for="error in errors.username"
                                    :key="error">{{ error }}</small>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Contraseña</label>
                                </div>
                                <input class="form-control" id="split-login-password" type="password" v-model="user.password"
                                :class="{ 'is-invalid' : errors.password }">
                                <small class="text-danger" v-for="error in errors.password"
                                    :key="error">{{ error }}</small>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit">Iniciar Sesión</button>
                            </div>
                           
                        </form>

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


</template>
