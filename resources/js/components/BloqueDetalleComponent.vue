<template>


    <div class="container">
        <br>
        <hr>


        <div class="jumbotron">
  <h1 class="display-4">{{bloque.nombre}}</h1>
  <p class="lead">Clave: {{bloque.clave}}</p>
  <hr class="my-4">
  <ul>
      <li><h5>Clave del curso: {{bloque.cve_curso}}</h5></li>
      <li><h5>Versión: {{bloque.version}}</h5></li>
  </ul>
    <span><h5> Ruta: </h5> <a href="#" class="btn btn-primary">{{bloque.ruta_portal}}</a></span>

</div>
        
        
       
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detalleBloque',
                
                bloque: {
                  clave  : "",
                  nombre : "",
                  cve_curso : "",
                  cve_status : "",
                  version : "",
                  ruta_portal: ""
                  
               },
                
            }
        },
        created() {

            this.bloque.clave = this.$route.params.clave;
            
           
        },

        mounted(){
            this.traerDatos();
            console.log('mounted')
        },

        methods:{
            traerDatos(clave){
                self = this
                axios.get(`/api/showBloque/${this.bloque.clave}`)
                   .then(response => {
                        this.bloque = response.data;
                        this.bloque.nombre = response.data.nombre
                        this.bloque.cve_curso = response.data.cve_curso
                        this.bloque.version = response.data.version
                        this.bloque.ruta_portal = response.data.ruta_portal
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })            }
        }

}
</script>

<style>

</style>