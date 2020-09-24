<template>
    <div class="container">
      <form>
  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" v-model="usuario.nombre">
   
  </div>
  <div class="form-group">
    <label>Apellido Paterno</label>
    <input type="text" class="form-control" v-model="usuario.apepat">
  </div>

  <div class="form-group">
    <label>Apellido Materno</label>
    <input type="text" class="form-control" v-model="usuario.apemat">
  </div>

   <div class="form-group">
    <label>Mail</label>
    <input type="email" class="form-control" v-model="usuario.mail">
  </div>

  <div class="form-group">
    <label>Nickname</label>
    <input type="text" class="form-control" v-model="usuario.nickname">
  </div>

    <div class="form-group">
    <label>Pass</label>
    <input type="password" class="form-control" v-model="usuario.pass">
  </div>

  <button type="button" class="btn btn-primary" v-on:click="insert(usuario)">Submit</button>
</form>
    </div>
  
</template>

<script>
export default {
    mounted(){
        console.log('Montado')
    },

    data(){
        return {
            usuarios: [],

            usuario: {
                 clave: "",
                 nombre: "",
                 apepat: "",
                 apemat: "",
                 mail: "",
                 nickname: "",
                 pass: "",
                 status:"",
                 cve_tipousuario:""
               },
        }

    },

    created(){
        this.traer()
    },

    methods:{
        traer(){
            
        },

        
        insert(clave){


            self = this
            axios.post('api/usuarios',

                    {
                    nombre : this.usuario.nombre,
                    apepat : this.usuario.apepat,
                    apemat : this.usuario.apemat,
                    mail : this.usuario.mail,
                    nickname : this.usuario.nickname,
                    pass : this.usuario.pass,
                    status : 1,
                    cve_tipousuario : 3
                    })
                    
             .then(response => {

                    this.usuario.nombre = ""
                    this.usuario.apepat = ""
                    this.usuario.apemat = "" 
                    this.usuario.mail = ""
                    this.usuario.nickname = "" 
                    this.usuario.pass = ""

                   
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