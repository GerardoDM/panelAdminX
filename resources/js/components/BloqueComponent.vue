<template>
   <div class="container">
      
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalTitle">Agregar bloque</h5>
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
                           <input type="text" class="form-control" v-model="bloque.nombre">
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Clave Curso</label>
                           <validationProvider v-slot="v" rules='required'>
                           <select id="selectCurso" v-model="selected">
                              <option :value="curso.clave" v-for="curso in cursos" v-bind:key="curso.clave">Nombre : {{curso.nombre}}</option>
                           </select>
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div>
                        <!-- <div class="form-group">
                           <label>Clave Status</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="numeric" class="form-control" v-model="bloque.cve_status">
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div> -->
                        <div class="form-group">
                           <label>Versión</label>
                           <validationProvider v-slot="v" rules='required|numeric'>
                           <input type="numeric" class="form-control" v-model="bloque.version">
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Ruta Portal</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="url" class="form-control" v-model="bloque.ruta_portal">
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div>
                        <button type="submit" id="btnAgregar" class="btn btn-primary" >Agregar</button>
                     </form>
                     </validationObserver>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr>  
      <h2 class="mb-4">Bloques</h2>

           <div class="form-inline">
          
            <input class="form-control mr-sm-2" v-model="search" type="search" @keyup.enter="searchit()" placeholder="Buscar por nombre">
             <button class="btn btn-success my-2 my-sm-0" type="button"><font-awesome-icon icon="search" @click="searchit()"/></button>
         </div>
      <div class="container; mt-2" style="height:450px; width:max; overflow-y: scroll">
       
         <hr>

         <table class="table table-hover table-dark">
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Nombre <font-awesome-icon icon="angle-down" @click="sortBy('nombre')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Clave Curso <font-awesome-icon icon="angle-down" @click="sortBy('cve_curso')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Versión <font-awesome-icon icon="angle-down" @click="sortBy('version')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Ruta Portal <font-awesome-icon icon="angle-down" @click="sortBy('ruta_portal')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
               </tr>
            </thead>
            <tbody>
               
               <tr v-for="bloque in sortedBloques" v-bind:key="bloque.clave">
                  <td><router-link :to="{ name: 'bloqueDetalle', params: { clave: bloque.clave }  }" style="color:white">{{bloque.nombre}}</router-link></td>
                  <td>{{bloque.cve_curso}}</td>
                  <td>{{bloque.version}}</td>
                  <td>{{bloque.ruta_portal}}</td>
                  <td>
                     <button type="button" class="btn btn-secondary" v-on:click="edit(bloque)" data-toggle="modal" data-target="#exampleModal">
                     Editar
                     </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(bloque.clave)">Eliminar</button></td>
               </tr>
            </tbody>
         </table>
      </div>
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>

 import { ValidationProvider } from 'vee-validate';


   export default {
   
       mounted(){
   
            $("#selectCurso").change(function(){
                this.curso.clave = $("#selectCurso").val();
                }.bind(this)); 
           
       },

       components:{
          ValidationProvider
       },
   
       data(){
   
          
           return {
               bloques: [],
               cursos:[],
   
               bloque: {
                  clave  : "",
                  nombre : "",
                  cve_curso : "",
                  cve_status : "",
                  version : "",
                  ruta_portal: ""
                  
               },
   
               curso:{
                  clave: "",
                  nombre: ""
               },
   
               selected : "",
               errors: {},
               message: null,
               valid: true,
               val : 'standard',
               search:"",
               query: "",
               currentSort:'clave',
               currentSortDir:'asc',
              
               
            }
   
         },
   
       created(){
           this.traer()
           this.traerCursos()
       },

        computed:{
         sortedBloques:function() {
            
            return this.bloques.sort((a,b) => {

               try {

               let modifier = 1;
              
               if(this.currentSortDir === 'desc') modifier = -1;
               if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
               if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
               return 0;
                  
               } catch (error) {

                  
                  
               }


               
            
            });
         }
         },
   
       methods:{

        


              sortBy(s) {
         //if s == current sort, reverse
         if(s === this.currentSort) {
            this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
         }
         this.currentSort = s;
        
         },


         searchit(){

             
              self = this

              let query = this.search;

              axios.get('api/searchBloque?q=' + query)
             .then(response => {
                       this.bloques = response.data;
            
                       console.log('success')
                   })
                   .catch(e => {
                       console.log(e);
                   })
           

          },

      
           traer(){
   
              self = this
               axios.get('/api/bloques')
                   .then(response => {
                       this.bloques = response.data;
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
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
               
           },
   
           
           insert(clave){
      
               self = this

               if (this.val == 'standard'){

                  axios.post('api/bloque',
   
                       {
   
                  clave  : this.bloque.clave,
                  nombre : this.bloque.nombre,
                  cve_curso : this.curso.clave,
                  cve_status : 5,
                  version : this.bloque.version,
                  ruta_portal : this.bloque.ruta_portal
                       
                       })


                   .then(response => {
   
                this.bloque.clave  = ""
                this.bloque.nombre = ""
                this.curso.clave = ""
                this.bloque.cve_status = ""
                this.bloque.version = ""
                this.bloque.ruta_portal = ""
   
                this.selected = ""
                $("#dd").val('') 
                                            
                       swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El bloque se ha creado',
                         index: 0,
                        
                       })
   

                       this.traer();
    
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })


               }

               else if (this.val == 'auto'){
                  this.update(this.bloque.clave)
                  
                  this.val = 'standard'
                  document.getElementById("btnAgregar").innerHTML = 'Agregar'; 
                  document.getElementById("modalTitle").innerHTML = 'Agregar bloque'; 
               }
   
               
                       
               
   
           },
   
            deleteU(clave){
   
               self = this
               axios.delete(`/api/bloque/${clave}`)
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
                   'El bloque ha sido borrado',
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
   
           edit(bloque){
   
   
            document.getElementById("btnAgregar").innerHTML = 'Actualizar';
            document.getElementById("modalTitle").innerHTML = 'Actualizar producto'; 
               
            this.val = 'auto';
   
            this.bloque.clave = bloque.clave
            
            this.bloque.nombre = bloque.nombre
            this.bloque.cve_curso = bloque.cve_curso
            this.bloque.cve_status = bloque.cve_status
            this.bloque.version = bloque.version
            this.bloque.ruta_portal = bloque.ruta_portal
            
            this.selected = bloque.cve_curso
    
           },
   
   
           update(clave){
             self = this;
             axios.put(`api/bloque/${clave}`,
              {
                  clave  : this.bloque.clave,
                  nombre : this.bloque.nombre,
                  cve_curso : this.bloque.cve_curso,
                  cve_status : this.bloque.cve_status,
                  version : this.bloque.version,
                  ruta_portal : this.bloque.ruta_portal                    
               })
              
              
              .then(response => {
   
                this.bloque.clave  = ""
                this.bloque.nombre = ""
                this.bloque.cve_curso = ""
                this.bloque.cve_status = ""
                this.bloque.version = ""
                this.bloque.ruta_portal = ""
                
                this.selected = ""
                                
                      swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El bloque se ha actualizado',
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