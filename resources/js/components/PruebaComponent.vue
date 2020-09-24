<template>
    <div class="container">
        <table class="table table-hover table-dark">
  <thead>
    <tr>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Tipo Usuario</th>
        <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="usuario in usuarios" v-bind:key="usuario.clave">
      <th>{{usuario.nombre}}</th>
      <td>{{usuario.apepat}}</td>
      <td>{{usuario.apemat}}</td>
      <td>{{usuario.cve_tipousuario}}</td>
      <td><button type="button" class="btn btn-danger" v-on:click="deleteU(usuario.clave)">Eliminar</button></td>
    </tr>
  </tbody>
</table>
    </div>
  
</template>

<script>
export default {
    mounted(){
       
    },

    data(){
        return {
            usuarios: []
        }

    },

    created(){
        this.traer()
    },

    methods:{
        traer(){

            self = this
            axios.get('/api/usuarios')
                .then(response => {
                    this.usuarios = response.data;
                })
                .catch(e => {
                    
                    console.log(e);
                })
            
        },

        deleteU(clave){

            self = this
            axios.delete(`/api/usuarios/${clave}`)
                .then(response => {
                    this.traer();
                })
                .catch(e => {
                    
                    console.log(e);
                })

        },


        fireSW(){
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

        }

        
    
}
    }


</script>

<style>

</style>