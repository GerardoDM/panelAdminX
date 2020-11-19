<template>


    <div class="container">
        <br>
        <hr>
        
        
        <div class="card">
        <h5 class="card-header">Clave: {{bloque.clave}}</h5>
        

        <div class="card-body">
            <h5 class="card-title">Nombre: {{bloque.nombre}}</h5>
            <ul>
                <li class="card-text">Clave del curso: {{bloque.cve_curso}}</li>
                <li class="card-text">Versión: {{bloque.version}}</li>    
            </ul>
            
            <span>Ruta: <a href="#" class="btn btn-primary">{{bloque.ruta_portal}}</a></span>
        </div>
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