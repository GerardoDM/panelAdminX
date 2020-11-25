<template>


    <div class="container">
        <br>
        <hr>
        
        
        <div class="card">
        <h5 class="card-header">Clave: {{proyecto.clave}}</h5>
        

        <div class="card-body">
            <h5 class="card-title">Nombre: {{proyecto.nombre}}</h5>
            <ul>
                <li class="card-text">Fecha: {{proyecto.fecha}}</li>
                <li class="card-text">Descripción: {{proyecto.descripcion}}</li>
                <li class="card-text">Nomenclatura: {{proyecto.nomenclatura}}</li>    
            </ul>
            
            
        </div>
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