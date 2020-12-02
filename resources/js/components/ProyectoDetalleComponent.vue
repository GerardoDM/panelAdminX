<template>


    <div class="container">
        <br>
        <hr>

                <div class="jumbotron">
        <h1 class="display-4">{{proyecto.nombre}}</h1>

        <p class="lead">Clave: {{proyecto.clave}}</p>

        <hr class="my-4">
        <ul>
            <li><h5>Fecha: {{proyecto.fecha}}</h5></li>
            <li><h5>Descripción: {{proyecto.descripcion}}</h5></li>
            <li><h5>Nomenclatura: {{proyecto.nomenclatura}}</h5></li>
        </ul>
       
            

        </div>
        
       
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detalleProyecto',
                
                proyecto: {
                clave  : "",
                nombre : "",
                fecha : "",
                descripcion : "",
                nomenclatura : "",
                  
               },
                
            }
        },
        created() {

            this.proyecto.clave = this.$route.params.clave;
            
           
        },

        mounted(){
            this.traerDatos();
            console.log('mounted')
        },

        methods:{
            traerDatos(clave){
                self = this
                axios.get(`/api/showProyecto/${this.proyecto.clave}`)
                   .then(response => {
                        this.proyecto = response.data;
                        this.proyecto.nombre = response.data.nombre
                        this.proyecto.fecha = response.data.fecha
                        this.proyecto.descripcion = response.data.descripcion
                        this.proyecto.nomenclatura = response.data.nomenclatura
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })            }
        }

}
</script>

<style>

</style>