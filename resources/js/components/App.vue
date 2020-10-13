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
     
       <li class="nav-item">
        <router-link to='/cursos' class="nav-link">Cursos</router-link> 
       </li>
        <li class="nav-item">
          <router-link to='/bloques' class="nav-link">Bloques</router-link> 
        </li>
        <li class="nav-item">
          <router-link to='/productos' class="nav-link">Productos</router-link> 
        </li>
       <li class="nav-item">
          <router-link to='/proyectos' class="nav-link">Proyectos</router-link>
        </li>
        <li class="nav-item">
          <router-link to='/pivot' class="nav-link">Productos-Proyectos</router-link>  
        </li>
        
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
 
          