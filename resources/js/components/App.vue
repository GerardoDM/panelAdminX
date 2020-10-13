<template>
    <div>
        <h1>Vue Router Demo App</h1>

        <p>
            <!-- <router-link :to="{ name: 'bloques' }">Bloques</router-link>
            <router-link :to="{ name: 'cursos' }">Cursos</router-link>
            <router-link :to="{ name: 'productos' }">Productos</router-link>
            <router-link :to="{ name: 'proyectos' }">Proyectos</router-link>
            <router-link :to="{ name: 'pivot' }">Productos-Proyectos</router-link>  -->
            <router-link to="/bloques">FSFS</router-link> 
             <router-view></router-view>  
           
        </p>

        <div class="container">
             
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
   
           console.log('Mount')
           
       },
    }
</script>
