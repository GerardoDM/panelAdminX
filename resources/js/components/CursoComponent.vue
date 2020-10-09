<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar curso</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <validationObserver v-slot="{ handleSubmit }">
                     <form id="form" @submit.prevent="handleSubmit(insert)">
                        <div class="form-group">
                           <label>Nombre</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="curso.nombre">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>nom_sep</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="curso.nom_sep">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>btotales</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="numeric" class="form-control" v-model="curso.btotales">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>blib</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="numeric" class="form-control" v-model="curso.blib">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Autor</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="curso.autor">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>cve_usuario</label>
                           <validationProvider v-slot="v" rules='required'>
                           <select id="selectUsuario" v-model="selected">
                              <option :value="usuario.clave" v-for="usuario in usuarios" v-bind:key="usuario.clave">Nombre : {{usuario.nombre}}</option>
                           </select>
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Ruta descarga</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="url" class="form-control" v-model="curso.ruta_descarga">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Ruta ver</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="url" class="form-control" v-model="curso.ruta_ver">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Status</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="curso.status">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                           
                        </div>
                        <div class="form-group">
                           <label>Ruta Operación</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="url" class="form-control" v-model="curso.ruta_operacion">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Clave Status</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="numeric" class="form-control" v-model="curso.cve_status">
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <button type="submit" id="btnAgregar" class="btn btn-primary" >Agregar</button>
                        <!-- <button type="button" id="btnActualizar" disabled class="btn btn-primary" v-on:click="update(curso.clave)">Actualizar</button> -->
                     </form>
                     </validationObserver>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container; mt-4" style="height:400px; width:max; overflow-y: scroll">
         <h2 class="mb-4">Cursos</h2>
         <table class="table table-hover table-dark">
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Clave</th>
                  <th style="position:sticky; top:0; background: #000000">Nombre</th>
                  <th style="position:sticky; top:0; background: #000000">nom sep</th>
                  <th style="position:sticky; top:0; background: #000000">btotales</th>
                  <th style="position:sticky; top:0; background: #000000">blib</th>
                  <th style="position:sticky; top:0; background: #000000">Autor</th>
                  <th style="position:sticky; top:0; background: #000000">Clave Usuario</th>
                  <th style="position:sticky; top:0; background: #000000">Ruta descarga</th>
                  <th style="position:sticky; top:0; background: #000000">Ruta ver</th>
                  <th style="position:sticky; top:0; background: #000000">Status</th>
                  <th style="position:sticky; top:0; background: #000000">Ruta operación</th>
                  <th style="position:sticky; top:0; background: #000000">Clave status</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="curso in cursos" v-bind:key="curso.clave">
                  <th>{{curso.clave}}</th>
                  <th>{{curso.nombre}}</th>
                  <td>{{curso.nom_sep}}</td>
                  <td>{{curso.btotales}}</td>
                  <td>{{curso.blib}}</td>
                  <th>{{curso.autor}}</th>
                  <th>{{curso.cve_usuario}}</th>
                  <td>{{curso.ruta_descarga}}</td>
                  <td>{{curso.ruta_ver}}</td>
                  <td>{{curso.status}}</td>
                  <td>{{curso.ruta_operacion}}</td>
                  <td>{{curso.cve_status}}</td>
                  <td>
                     <button type="button" class="btn btn-secondary" v-on:click="edit(curso)" data-toggle="modal" data-target="#exampleModal">
                     Editar
                     </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(curso.clave)">Eliminar</button></td>
               </tr>
            </tbody>
         </table>
      </div>
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>

 import { ValidationProvider } from 'vee-validate';


   //v-on:click="insert(curso)"

   export default {
   
       mounted(){
   
            $("#selectUsuario").change(function(){
                this.usuario.clave = $("#selectUsuario").val();
                }.bind(this)); 
           
       },

       components:{

          ValidationProvider

       },
   
       data(){
           return {
               cursos: [],
               usuarios: [],
   
               curso: {
                  clave  : "",
                  nombre : "",
                  nom_sep : "",
                  btotales : "",
                  blib : "",
                  autor : "",
                  cve_usuario : "",
                  ruta_descarga : "",
                  ruta_ver : "",
                  status : "",
                  ruta_operacion : "",
                  cve_status : "",
                },
   
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
   
                  selected: "",
                  errors : {},
                  valid : true,
                  message : null,
                  val : 'standard'
   
           }
   
       },
   
       created(){
           this.traer()
           this.traerUsuarios()
       },
   
       methods:{
   
   
           traer(){
   
              self = this
               axios.get('/api/cursos')
                   .then(response => {
                       this.cursos = response.data;
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
               
           },
   
            traerUsuarios(){
   
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
   
               axios.post('api/curso',
   
                       {
   
                  clave  : this.curso.clave,
                  nombre : this.curso.nombre,
                  nom_sep : this.curso.nom_sep,
                  btotales : this.curso.btotales,
                  blib : this.curso.blib,
                  autor : this.curso.autor,
                  cve_usuario : this.usuario.clave,
                  ruta_descarga : this.curso.ruta_descarga,
                  ruta_ver : this.curso.ruta_ver,
                  status : this.curso.status,
                  ruta_operacion : this.curso.ruta_operacion,
                  cve_status : this.curso.cve_status
                       
                       })
                       
                .then(response => {
   
                this.curso.clave  = ""
                this.curso.nombre = ""
                this.curso.nom_sep = ""
                this.curso.btotales = ""
                this.curso.blib = ""
                this.curso.autor = ""
                this.curso.cve_usuario = ""
                this.curso.ruta_descarga = ""
                this.curso.ruta_ver = ""
                this.curso.status = ""
                this.curso.ruta_operacion = ""
                this.curso.cve_status = ""
   
                this.selected = ""
   
                     
                                            
                       swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El curso se ha creado',
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
               axios.delete(`/api/curso/${clave}`)
                   .then(response => {
   
            swal.fire({
               title: '¿Estás seguro?',
               text: "No podrás revertir la acción",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, eliminar'
            }).then((result) => {
               if (result.isConfirmed) {
                  swal.fire(
                   'Eliminado',
                   'El curso ha sido borrado',
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
   
           edit(curso){


            document.getElementById("btnAgregar").innerHTML = 'Actualizar'; 
               
            this.val = 'auto';

   
            this.curso.clave = curso.clave
            this.curso.nombre = curso.nombre
            this.curso.nom_sep = curso.nom_sep
            this.curso.btotales = curso.btotales
            this.curso.blib = curso.blib
            this.curso.autor = curso.autor
            this.curso.cve_usuario = curso.cve_usuario
            this.curso.ruta_descarga = curso.ruta_descarga
            this.curso.ruta_ver = curso.ruta_ver
            this.curso.status = curso.status
            this.curso.ruta_operacion = curso.ruta_operacion
            this.curso.cve_status = curso.cve_status
            
   
           },
   
   
           update(clave){
             self = this;
             axios.put(`api/curso/${clave}`,
              {
   
                  clave  : this.curso.clave,
                  nombre : this.curso.nombre,
                  nom_sep : this.curso.nom_sep,
                  btotales : this.curso.btotales,
                  blib : this.curso.blib,
                  autor : this.curso.autor,
                  cve_usuario : this.usuario.clave,
                  ruta_descarga : this.curso.ruta_descarga,
                  ruta_ver : this.curso.ruta_ver,
                  status : this.curso.status,
                  ruta_operacion : this.curso.ruta_operacion,
                  cve_status : this.curso.cve_status
                    
               })
              
              
              .then(response => {
   
                this.curso.clave  = ""
                this.curso.nombre = ""
                this.curso.nom_sep = ""
                this.curso.btotales = ""
                this.curso.blib = ""
                this.curso.autor = ""
                this.curso.cve_usuario = ""
                this.curso.ruta_descarga = ""
                this.curso.ruta_ver = ""
                this.curso.status = ""
                this.curso.ruta_operacion = ""
                this.curso.cve_status = ""
   
                this.selected = ""
                
                      swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El curso se ha actualizado',
                         index: 0,
                        
                         })
   
               this.traer();
                       
                   })
   
                   
                   .catch(e => {
                       
                       console.log(e);
                   })
               
           }
   
       }
   
   }
</script>
<style>
   .body{
   background-color: darkslategrey;
   }
</style>