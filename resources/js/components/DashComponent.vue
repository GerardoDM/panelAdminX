<template>
        <div>
    <hr>
    <h5>Dashboard</h5>
    <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <h5 class="card-title">Bloques</h5>
    <p class="card-text">Cantidad actual de registros: {{contadorBloques}}</p>
    <a href="#" class="btn btn-primary">Ver</a>
  </div>
</div>

  <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <h5 class="card-title">Cursos</h5>
    <p class="card-text">Cantidad actual de registros: {{contadorCursos}}</p>
    <a href="#" class="btn btn-primary">Ver</a>
  </div>
</div>


  <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <h5 class="card-title">Productos</h5>
    <p class="card-text">Cantidad actual de registros: {{contadorProductos}}</p>
    <a href="#" class="btn btn-primary">Ver</a>
  </div>
</div>


  <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <h5 class="card-title">Proyectos</h5>
    <p class="card-text">Cantidad actual de registros: {{contadorProyectos}}</p>
    <a href="#" class="btn btn-primary">Ver</a>
  </div>
</div>
</div>

  
</template>

<script>
export default {

    mounted(){

    },

    data(){


        return {

            bloques: [],
            cursos: [],
            productos: [],
            proyectos: [],

            contadorBloques: null,
            contadorCursos: null,
            contadorProductos: null,
            contadorProyectos: null


        }

    

    },

    created(){

        this.traerCursos()
        this.traerBloques()
        this.traerProductos()
        this.traerProyectos()
     

    },
    

    methods: {

        traerBloques(){

             self = this
               axios.get('/api/bloques')
                   .then(response => {
                       this.bloques = response.data;
                       this.contadorBloques = this.bloques.length
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })

        },

        traerCursos(){

             self = this
               axios.get('/api/cursos')
                   .then(response => {
                       this.cursos = response.data;
                       this.contadorCursos = this.cursos.length
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })

        },

        traerProductos(){

             self = this
               axios.get('/api/productos')
                   .then(response => {
                       this.productos = response.data;
                       this.contadorProductos = this.productos.length
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })

        },

        traerProyectos(){

             self = this
               axios.get('/api/proyectos')
                   .then(response => {
                       this.proyectos = response.data;
                       this.contadorProyectos = this.proyectos.length
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })

        },

       

    }


    
    
    



    

}
</script>

<style>

</style>    