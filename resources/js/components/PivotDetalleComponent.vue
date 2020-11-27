<template>


    <div class="container">
        <br>
        <hr>
        
        
        <div class="card">
        <h5 class="card-header">Clave: {{pivot.clave}}</h5>
        

        <div class="card-body">
            <h5 class="card-title">Datos:</h5>
            <ul>
                <li class="card-text">Clave: {{pivot.cve_producto}}</li>
                <li class="card-text">Nombre Producto: {{pivot2.productoNombre}}</li> 
                <li class="card-text">Clave Producto: {{pivot.cve_proyecto}}</li>
                <li class="card-text">Nombre Proyecto: {{pivot2.proyectoNombre}}</li> 
                <li class="card-text">Clave Proyecto: {{pivot.nolicencias}}</li>    
            </ul>
            
            
        </div>
        </div>
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detallePivot',
                
                pivot: {
                  clave  : "",
                  cve_producto: "",
                  cve_proyecto: "",
                  nolicencias:"",
                  

                  
               },

               pivot2:{
                   productoNombre:"",
                   proyectoNombre:""
               }
                
            }
        },
        created() {

            this.pivot.clave = this.$route.params.clave;
            
           
        },

        mounted(){
            this.traerDatos();
            this.traerJoin();
        },

        methods:{
            traerDatos(clave){
                self = this
                axios.get(`/api/showPivot/${this.pivot.clave}`)
                   .then(response => {
                        this.pivot = response.data;
                        this.pivot.clave = response.data.clave
                        this.pivot.cve_producto = response.data.cve_producto
                        this.pivot.cve_proyecto = response.data.cve_proyecto
                        this.pivot.nolicencias = response.data.nolicencias
                        })
                   .catch(e => {
                       
                       console.log(e);
                   })            
                },

                traerJoin(clave){
                self = this
                axios.get(`/api/showJoin/${this.pivot.clave}`)
                   .then(response => {

                    this.pivot2 = response.data
                    this.pivot2.productoNombre = response.data[0].productoNombre
                    this.pivot2.proyectoNombre = response.data[0].proyectoNombre
                       
                    })
                   .catch(e => {
                       
                       console.log(e);
                   })            
                }
        }

        

}
</script>

<style>

</style>