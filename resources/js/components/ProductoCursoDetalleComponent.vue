<template>


    <div class="container">
        <br>
        <hr>

         <div class="jumbotron">
        <h1 class="display-4"></h1>

        <p class="lead">Datos Producto:</p>

        <hr>
        <ul>
            <li><h5>Nombre: {{pivote.nombreProducto}}</h5></li>
            <li><h5>Nomenclatura: {{pivote.productoNomenclatura}}</h5></li>
            <li><h5>Edición: {{pivote.productoEdicion}}</h5></li>
            
        </ul>

        <p class="lead">Datos Curso:</p>

        <hr>
        <ul>
            <li><h5>Nombre: {{pivote.nombreCurso}}</h5></li>
            <li><h5>Bloques Totales: {{pivote.cursoBtotales}}</h5></li>
            <li><h5>Bloques Liberados: {{pivote.cursoBlib}}</h5></li>
            <li><h5>Autor: {{pivote.cursoAutor}}</h5></li>
            
        </ul>
       
            

        </div>
        
        
       
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'productoCursoDetalle',
                
                 pivote:{


                  cve_producto: "",
                  cve_curso:null,
                  cursoBlib:"",
                  cursoBtotales:"",
                  cursoAutor:"",
                  productoEdicion:"",
                  productoNomenclatura:"",
                
                  nombreProducto:"",
                  nombreCurso:"",
                  key:"",
                  valorUno:"",
                  valorDos: ""

               },

              
                
            }
        },
        created() {

            this.pivote.cve_curso = this.$route.params.clave;
            this.pivote.cve_producto = this.$route.params.claveDos;
          
            
           
        },

        mounted(){
            
            this.traerJoin();
        },

        methods:{
            
                traerJoin(clave){
                self = this
                axios.get(`/api/pivotProductoCursoShow/${this.pivote.cve_curso}/${this.pivote.cve_producto}`)
                   .then(response => {

                    this.pivote = response.data
                    this.pivote.nombreCurso = response.data[0].cursoNombre
                    // console.log(response.data.cursoNombre)
                    this.pivote.nombreProducto = response.data[0].productoNombre
                    this.pivote.productoNomenclatura = response.data[0].productoNomenclatura
                    this.pivote.productoEdicion = response.data[0].productoEdicion
                    this.pivote.cursoBlib = response.data[0].cursoBlib
                    this.pivote.cursoBtotales = response.data[0].cursoBtotales
                    this.pivote.cursoAutor = response.data[0].cursoAutor
                       
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