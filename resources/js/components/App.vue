<template>
     <!-- Navbar -->
<div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <router-link to='/' class="navbar-brand">Admin-Xvolution</router-link>
  
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
    <form class="form-inline">
          <button class="btn btn-outline-success my-2 my-sm-0" type="button">Usuario: {{user.nickname}}</button>
          <button class="btn btn-outline-danger my-2 my-sm-0 ml-4" type="button" v-on:click="logout()">Logout</button>
          <!-- <input type="hidden" name="_token" v-bind:value="csrf"> -->
          
    </form>

  </nav>
  <div class="container">
            <router-view></router-view> 
        </div>
        </div>
</template>
<script>
    export default {

       props: ['user'],

       data(){
            return {

            }
        },


         mounted() {
            console.log(this.user)
        },

        methods : {
          logout(){
            axios.post('usuario/logout')   
                               
                 .then(response => {

                   console.log('logged out');
                   window.location.href = 'usuario/login';

   
                          
                      })
   
                      
                      .catch(e => {
                          
                          console.log(e);
                      })


          }
        }
       
    }
</script>
 
          