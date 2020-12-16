<template>


    <div class="container">
          <hr>
                  
 <router-link to='/pivot' class="nav-link"><button type="button" class="btn btn-primary btn-lg">Regresar</button></router-link>
        
        <hr>

         <div class="jumbotron">
        <h1 class="display-4">Clave: {{pivot.clave}}</h1>

        <p class="lead">Datos:</p>

        <hr>
        <ul>
            <li><h5>Clave Producto: {{pivot.cve_producto}}</h5></li>
            <li><h5>Nombre Producto: {{pivot2.productoNombre}}</h5></li>
            <li><h5>Clave Proyecto: {{pivot.cve_proyecto}}</h5></li>
            <li><h5>Nombre Proyecto: {{pivot2.proyectoNombre}}</h5></li>
            <li><h5>Número de Licencias: {{pivot.nolicencias}}</h5></li>
            <li><h5>Proyecto Descripción: {{pivot2.proyectoDescripcion}}</h5></li>
            <li><h5>Producto Edición: {{pivot2.productoEdicion}}</h5></li>
        </ul>
       
            

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
                   proyectoNombre:"",
                   productoEdicion:"",
                   proyectoDescripcion:""
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
                    this.pivot2.proyectoDescripcion = response.data[0].proyectoDescripcion
                    this.pivot2.productoEdicion = response.data[0].productoEdicion



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