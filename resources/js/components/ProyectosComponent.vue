<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar proyecto</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form>
                        <div class="form-group">
                           <label>Clave</label>
                           <input type="text" class="form-control" v-model="proyecto.clave">
                        </div>

                        <div class="form-group">
                           <label>Nombre</label>
                           <input type="text" class="form-control" v-model="proyecto.nombre">
                        </div>
                        <!-- <div class="form-group">
                           <label>Fecha</label>
                           <input type="text" class="form-control" v-model="proyecto.fecha">
                        </div> -->


                        <div class="form-group">
                           <label>Fecha</label>
                           <datepicker v-model="date" :value="date" :format="customFormatter"></datepicker>
                        </div>


                        <div class="form-group">
                           <label>Descripción</label>
                           <input type="text" class="form-control" v-model="proyecto.descripcion">
                        </div>
                        <div class="form-group">
                           <label>Nomenclatura</label>
                           <input type="text" class="form-control" v-model="proyecto.nomenclatura">
                        </div>
                       
                        <button type="button" class="btn btn-primary" v-on:click="insert(proyecto)">Agregar</button>
                         <button type="button" class="btn btn-primary" v-on:click="update(proyecto.clave)">Actualizar</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>


import Datepicker from 'vuejs-datepicker';
    import moment from 'moment'


      
   export default {


      
       mounted(){
           
       },

       components: {

           Datepicker

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

                date : ""
           }
   
       },
   
       created(){
           this.traer()
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

               axios.post('api/proyectos',
   
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
                         text: 'El proyecto se ha creado',
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
               axios.delete(`/api/proyectos/${clave}`)
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

            this.proyecto.clave = proyecto.clave
            this.proyecto.nombre = proyecto.nombre;
            this.proyecto.fecha = proyecto.fecha;
            this.proyecto.descripcion = proyecto.descripcion;
            this.proyecto.nomenclatura = proyecto.nomenclatura;

           },


           update(clave){
             self = this;
             axios.put(`api/proyectos/${clave}`,
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





