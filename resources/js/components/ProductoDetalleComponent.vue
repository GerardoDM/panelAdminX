<template>


    <div class="container">
        <br>
        <hr>
        
        
        <div class="card">
        <h5 class="card-header">Clave: {{producto.clave}}</h5>
        

        <div class="card-body">
            <h5 class="card-title">Nombre: {{producto.nombre}}</h5>
            <ul>
                <li class="card-text">Edición: {{producto.edicion}}</li>
                <li class="card-text">Nomenclatura: {{producto.nomenclatura}}</li>    
            </ul>
            
            
        </div>
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