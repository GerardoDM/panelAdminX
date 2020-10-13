<template>
     <!-- Navbar -->
<div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
     
       
        <router-link to='/cursos'>Cursos</router-link> 
        
          <router-link to='/bloques'>Bloques</router-link> 
        
       
          <router-link to='/productos' >Productos</router-link> 
    
       
          <router-link to='/proyectos'>Proyectos</router-link>

          <router-link to='/prueba'>Prueba</router-link>  
          
        
      </ul>
    </div>
  </nav>
  <div class="container">
            <router-view></router-view> 
        </div>
        </div>
</template>
<script>
    export default {
       
    }
</script>
 
          