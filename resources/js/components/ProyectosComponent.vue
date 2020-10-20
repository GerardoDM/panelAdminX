<template>


   <div class="container">
     
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalTitle">Agregar proyecto</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                   <validationObserver v-slot="{ handleSubmit }">
                     <form id="form" @submit.prevent="handleSubmit(insert)">
                        <div class="form-group">
                           
                           <label>Clave</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="proyecto.clave" >
                            <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Nombre</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="proyecto.nombre" >
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Fecha</label>
                           <validationProvider v-slot="v" rules='required'>
                           <datepicker id="dd" v-model="date" :value="date" :format="customFormatter"></datepicker>
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Descripción</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" class="form-control" v-model="proyecto.descripcion" >
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Nomenclatura</label>
                           <validationProvider v-slot="v" rules='required'>
                           <input type="text" :maxlength="2" class="form-control" v-model="proyecto.nomenclatura" >
                           <span>{{ v.errors[0] }}</span>
                           </validationProvider>
                        </div>
                        <button type="submit" id="btnAgregar" class="btn btn-primary">Agregar</button>
                        <!-- <button type="submit" id="btnActualizar" disabled class="btn btn-primary">Actualizar</button> -->
                     </form>
                   </validationObserver>
                  
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container; mt-4" style="height:400px; overflow-y: scroll;">
         <h2 class="mb-4">Proyectos</h2>
         <table class="table table-hover table-dark" >
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Clave</th>
                  <th style="position:sticky; top:0; background: #000000">Nombre</th>
                  <th style="position:sticky; top:0; background: #000000">Fecha</th>
                  <th style="position:sticky; top:0; background: #000000">Descripción</th>
                  <th style="position:sticky; top:0; background: #000000">Nomenclatura</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="proyecto in proyectos" v-bind:key="proyecto.clave">
                  <th>{{proyecto.clave}}</th>
                  <th>{{proyecto.nombre}}</th>
                  <td>{{proyecto.fecha}}</td>
                  <td>{{proyecto.descripcion}}</td>
                  <td>{{proyecto.nomenclatura}}</td>
                  <td>
                     <button type="button" class="btn btn-secondary" v-on:click="edit(proyecto)" data-toggle="modal" data-target="#exampleModal">
                     Editar
                     </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(proyecto.clave)">Eliminar</button></td>
               </tr>
            </tbody>
         </table>
      </div>
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>
   import Datepicker from 'vuejs-datepicker';
   import moment from 'moment'
   import { ValidationProvider } from 'vee-validate';

            
      export default {
   
         
   
          components: {
   
              Datepicker,
              ValidationProvider,
   
          },
      
          data(){

            
              return {
                  proyectos: [],
      
                  proyecto: {
                       clave: "",
                       nombre: "",
                       fecha: "",
                       descripcion: "",
                       nomenclatura: "",
                   },
   
                  date : "",
                  errors: {},
                  message: null,
                  valid: true,
                  val : 'standard',

                  
              }
      
          },
      
          created(){
              this.traer()
              console.log(this.val)
          },
      
          methods:{
   
              customFormatter(date) {
               
               date = moment(date).format('yyyy-MM-DD');
               this.proyecto.fecha = date;
               console.log(date);
               
               
               return moment(date).format('yyyy-MM-DD');
   
            },
   
              traer(){
      
                 self = this
                  axios.get('/api/proyectos')
                      .then(response => {
                          this.proyectos = response.data;
                      })
                      .catch(e => {
                          
                          console.log(e);
                      })
                  
              },
          
              
              insert(clave){
         
                  self = this

                  if (this.val == 'standard'){

                     console.log('Entró en el primer if')

                     axios.post('api/proyecto',
      
                          {
                           clave : this.proyecto.clave,
                          nombre : this.proyecto.nombre,
                          fecha : this.proyecto.fecha,
                          descripcion : this.proyecto.descripcion,
                          nomenclatura : this.proyecto.nomenclatura,
                          })
                          
                   .then(response => {
   
                        this.proyecto.clave = ""
                        this.proyecto.nombre = ""
                        this.proyecto.fecha = ""
                        this.proyecto.descripcion = "" 
                        this.proyecto.nomenclatura = ""
                        $("#dd").val('') 
                                               
                          swal.fire({
                            icon: 'success',
                            title: 'Hecho',
                            text: 'El proyecto se ha creado',
                            index: 0,
                           
                          })
      
                          this.traer();
                          
       
                      })
                      .catch(e => {
                          
                          console.log(e);
                      })
      
                  } 
   
                  else if (this.val == 'auto') {

                 
      
                  this.update(this.proyecto.clave)
                  this.val = 'standard'
                  document.getElementById("btnAgregar").innerHTML = 'Agregar'; 
                  document.getElementById("modalTitle").innerHTML = 'Agregar proyecto'; 
                          

                  }
   
              
                  
              },
      
               deleteU(clave){
      
                  self = this
                  axios.delete(`/api/proyecto/${clave}`)
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
                      'El proyecto ha sido borrado',
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
   
              edit(proyecto){

               //document.getElementById("btnActualizar").disabled = false;
                          
               document.getElementById("btnAgregar").innerHTML = 'Actualizar'; 
               
               this.val = 'auto';
               console.log(this.val);
   
               this.proyecto.clave = proyecto.clave
               this.proyecto.nombre = proyecto.nombre;
               this.proyecto.fecha = proyecto.fecha;
               this.proyecto.descripcion = proyecto.descripcion;
               this.proyecto.nomenclatura = proyecto.nomenclatura;
   
              },
   
              update(clave){
                self = this;
                axios.put(`api/proyecto/${clave}`,
                 {
                        clave : this.proyecto.clave,
                        nombre : this.proyecto.nombre,
                        fecha : this.proyecto.fecha,
                        descripcion : this.proyecto.descripcion,
                        nomenclatura : this.proyecto.nomenclatura,
                  })
                               
                 .then(response => {
   
                  this.proyecto.clave = ""
                  this.proyecto.nombre = ""
                  this.proyecto.fecha = ""
                  this.proyecto.descripcion = "" 
                  this.proyecto.nomenclatura = ""
                   
                         swal.fire({
                            icon: 'success',
                            title: 'Hecho',
                            text: 'El proyecto se ha actualizado',
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