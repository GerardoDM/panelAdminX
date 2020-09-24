<template>
    <div class="container">
        <table class="table table-hover table-dark">
  <thead>
    <tr>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Tipo Usuario</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="usuario in usuarios" v-bind:key="usuario.clave">
      <th>{{usuario.nombre}}</th>
      <td>{{usuario.apepat}}</td>
      <td>{{usuario.apemat}}</td>
      <td>{{usuario.cve_tipousuario}}</td>
    </tr>
  </tbody>
</table>
    </div>
  
</template>

<script>
export default {
    mounted(){
        console.log('Montado')
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
            
        }
    }

}
</script>

<style>

</style>