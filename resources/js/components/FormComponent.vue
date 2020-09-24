<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
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
                        <button type="button" class="btn btn-primary" v-on:click="insert(usuario)">Agregar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container" style="height:400px; overflow-y: scroll">
         <table class="table table-hover table-dark" >
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Nombre</th>
                  <th style="position:sticky; top:0; background: #000000">Apellido Paterno</th>
                  <th style="position:sticky; top:0; background: #000000">Apellido Materno</th>
                  <th style="position:sticky; top:0; background: #000000">Tipo Usuario</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="usuario in usuarios" v-bind:key="usuario.clave">
                  <th>{{usuario.nombre}}</th>
                  <td>{{usuario.apepat}}</td>
                  <td>{{usuario.apemat}}</td>
                  <td>{{usuario.cve_tipousuario}}</td>
                  <td>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                      Editar
                      </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(usuario.clave)">Eliminar</button></td>
               </tr>
            </tbody>
         </table>
      </div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>
   export default {
       mounted(){
           
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
   
              self = this
               axios.get('/api/usuarios')
                   .then(response => {
                       this.usuarios = response.data;
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
               
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
                      
                    
   
                       swal.fire({
                         icon: 'success',
                         title: 'Oops...',
                         text: 'Something went wrong!',
                         index: 0,
                        
                       })
   
                       this.traer();
   
                      
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
   
           },
   
            deleteU(clave){
   
               self = this
               axios.delete(`/api/usuarios/${clave}`)
                   .then(response => {
   
   
   
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
                   swal.fire(
                   'Deleted!',
                   'Your file has been deleted.',
                   'success'
                   )
   
                    this.traer();
   
   
               }
               })
   
                      
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





