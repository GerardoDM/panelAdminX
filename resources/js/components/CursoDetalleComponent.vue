<template>


    <div class="container">
        <br>
        <hr>

          <div class="jumbotron">
  <h1 class="display-4">{{curso.nombre}}</h1>

  <p class="lead">Clave: {{curso.clave}}</p>
  <p class="lead">Autor: {{curso.autor}}</p>

  <hr class="my-4">
  <ul>
      <li><h5>Nombre separado: {{curso.nom_sep}}</h5></li>
      <li><h5>Bloques Totales: {{curso.totales}}</h5></li>
      <li><h5>Bloques Liberados: {{curso.blib}}</h5></li>
  </ul>
  <ul>
      <li><span><h5>Ruta Descarga:</h5> <a href="#" class="btn btn-primary">{{curso.ruta_descarga}}</a></span></li>
        <li><span><h5>Ruta Versión:</h5> <a href="#" class="btn btn-primary">{{curso.ruta_ver}}</a></span></li>
      <li><span><h5>Ruta Operación:</h5> <a href="#" class="btn btn-primary">{{curso.ruta_operacion}}</a></span></li>

  </ul>
    

</div>
        
        
       
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detalleCurso',

                
                curso: {
                  clave  : "",
                  nombre : "",
                  nom_sep : "",
                  btotales : "",
                  blib : "",
                  ruta_descarga : "",
                  ruta_ver : "",
                  ruta_operacion : "",
                  cve_status: ""
                  
               },
                
            }
        },
        created() {

            this.curso.clave = this.$route.params.clave;
            
           
        },

        mounted(){
            this.traerDatos();
            console.log('mounted')
        },

        methods:{
            traerDatos(clave){
                self = this
                axios.get(`/api/showCurso/${this.curso.clave}`)
                   .then(response => {
                        this.curso = response.data;
                        this.curso.nombre = response.data.nombre
                        this.curso.autor = response.data.autor
                        this.curso.btotales = response.data.btotales
                        this.curso.blib = response.data.blib
                        this.curso.ruta_descarga = response.data.ruta_descarga
                        this.curso.ruta_ver = response.data.ruta_ver
                        this.curso.ruta_operacion = response.data.ruta_operacion
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })            }
        }

}
</script>

<style>

</style>