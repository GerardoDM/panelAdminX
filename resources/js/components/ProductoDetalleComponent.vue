<template>


    <div class="container">
        <br>
        <hr>

         <div class="jumbotron">
  <h1 class="display-4">{{producto.nombre}}</h1>

  <p class="lead">Clave: {{producto.clave}}</p>

  <hr class="my-4">
  <ul>
      <li><h5>Edición: {{producto.edicion}}</h5></li>
      <li><h5>Nomenclatura: {{producto.nomenclatura}}</h5></li>
      
  </ul>
 
    

</div>
        
        
    
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detalleProducto',
                
                producto: {
                clave  : "",
                nombre : "",
                edicion : "",
                logo_producto : "",
                nomenclatura : ""
                  
               },
                
            }
        },
        created() {

            this.producto.clave = this.$route.params.clave;
            
           
        },

        mounted(){
            this.traerDatos();
            console.log('mounted')
        },

        methods:{
            traerDatos(clave){
                self = this
                axios.get(`/api/showProducto/${this.producto.clave}`)
                   .then(response => {
                        this.producto = response.data;
                        this.producto.nombre = response.data.nombre
                        this.producto.edicion = response.data.edicion
                        this.producto.logo_producto = response.data.logo_producto
                        this.producto.nomenclatura = response.data.nomenclatura
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })            }
        }

}
</script>

<style>

</style>