<template>


    <div class="container">
        <br>
        <hr>
        
        
        <div class="card">
        <h5 class="card-header">Clave: {{curso.clave}}</h5>
        

        <div class="card-body">
            <h5 class="card-title">Nombre: {{curso.nombre}}</h5>
            <ul>
                <li class="card-text">Nombre Separado: {{curso.nom_sep}}</li>
                <li class="card-text">Bloques Totales: {{curso.btotales}}</li>
                <li class="card-text">Bloques Liberados: {{curso.blib}}</li>
                    
            </ul>
             <ul>   
            <li><span>Ruta Descarga: <a href="#" class="btn btn-primary">{{curso.ruta_descarga}}</a></span></li>
            <li><span>Ruta Versión: <a href="#" class="btn btn-primary">{{curso.ruta_ver}}</a></span></li>
            <li><span>Ruta Operación: <a href="#" class="btn btn-primary">{{curso.ruta_operacion}}</a></span></li>
            </ul>
        </div>
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