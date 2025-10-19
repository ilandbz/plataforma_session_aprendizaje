<script setup>
import { ref, onMounted, onUnmounted, watch  } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import useDatosSession from '@/Composables/session';
import NavBar from '@/Components/NavBar.vue';
import SideBar from '@/Components/SideBar.vue';

const { usuario, menus, role } = useDatosSession();

const router = useRouter();
const route = useRoute();

const tiempoRestante = ref(600);
let temporizador;

const autorizado = ref(false);
const cargando = ref(true);
const resetearTemporizador = () => {
  tiempoRestante.value = 600;
};

const iniciarTemporizador = () => {
  temporizador = setInterval(() => {
    tiempoRestante.value--;
    if (tiempoRestante.value <= 0) {
      clearInterval(temporizador);
      alert("Sesión suspendida por inactividad.");
      localStorage.removeItem('userSession');
      router.push('/login');
    }
  }, 1000);
};


onMounted(() => {
  iniciarTemporizador();
  window.addEventListener('mousemove', resetearTemporizador);
  window.addEventListener('keydown', resetearTemporizador);
  window.addEventListener('click', resetearTemporizador);


  const rutaActual = route.path; 
  const rutasPermitidas = menus.value.map(m => '/' + m.slug);
    watch(menus, (nuevoValor) => {
        // const rutasPermitidas = nuevoValor.flatMap(grupo => 
        //     grupo.menus.map(submenu => '/' + submenu.slug)
        // );
        const rutasPermitidas = [
            '/',
            ...nuevoValor.flatMap(grupo => 
                grupo.menus.map(submenu => '/' + submenu.slug)
            )
        ];
        const rutaActual = route.path;
        autorizado.value = rutasPermitidas.includes(rutaActual);
        cargando.value = false; // ← Listo para mostrar algo
    });
});

onUnmounted(() => {
  clearInterval(temporizador);
  window.removeEventListener('mousemove', resetearTemporizador);
  window.removeEventListener('keydown', resetearTemporizador);
  window.removeEventListener('click', resetearTemporizador);


});
</script>

<template>
  <nav-bar :menus="menus"></nav-bar>
  <div class="content">
    <side-bar
      :usuario="usuario"
      :role="role"
    ></side-bar>

    <div v-if="cargando" class="text-center mt-5">
    <div class="spinner-border" role="status"></div>
    <p>Cargando permisos...</p>
    </div>

    <div v-else>
    <div v-if="autorizado">
        <router-view :usuario="usuario"></router-view>
    </div>
    <div v-else class="text-center mt-4 text-danger">
        <!-- <h4>No tienes permiso para acceder a esta ruta.</h4> -->
    </div>
    </div>

    <footer></footer>
  </div>
</template>