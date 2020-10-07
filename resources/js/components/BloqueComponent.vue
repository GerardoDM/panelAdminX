<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar bloque</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form id="form">
                        <div class="form-group">
                           <label>Nombre</label>
                           <input type="text" class="form-control" v-model="bloque.nombre">
                        </div>

                        <div class="form-group">
                           <label>Clave Curso</label>
                           <select id="selectCurso" v-model="selected">
                               <option :value="curso.clave" v-for="curso in cursos" v-bind:key="curso.clave">Nombre : {{curso.nombre}}</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <label>Clave Status</label>
                           <input type="numeric" class="form-control" v-model="bloque.cve_status">
                        </div>

                        <div class="form-group">
                           <label>Versión</label>
                           <input type="numeric" class="form-control" v-model="bloque.version">
                        </div>

                        <div class="form-group">
                           <label>Ruta Portal</label>
                           <input type="url" class="form-control" v-model="bloque.ruta_portal">
                        </div>
                       
                        <button type="button" id="btnAgregar" class="btn btn-primary" v-on:click="insert(bloque)">Agregar</button>
                        <button type="button" id="btnActualizar" disabled class="btn btn-primary" v-on:click="update(bloque.clave)">Actualizar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container; mt-4" style="height:400px; width:max; overflow-y: scroll">
          <h2 class="mb-4">Bloques</h2>
         <table class="table table-hover table-dark">
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Clave</th>
                  <th style="position:sticky; top:0; background: #000000">Nombre</th>
                  <th style="position:sticky; top:0; background: #000000">Clave Curso</th>
                  <th style="position:sticky; top:0; background: #000000">Clave Status</th>
                  <th style="position:sticky; top:0; background: #000000">Versión</th>
                  <th style="position:sticky; top:0; background: #000000">Ruta Portal</th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="bloque in bloques" v-bind:key="bloque.clave">
                  <th>{{bloque.clave}}</th>
                  <th>{{bloque.nombre}}</th>
                  <td>{{bloque.cve_curso}}</td>
                  <td>{{bloque.cve_status}}</td>
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

      
   export default {

       mounted(){

            $("#selectCurso").change(function(){
                this.curso.clave = $("#selectCurso").val();
                }.bind(this)); 
           
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

                selected : ""

           }
   
       },
   
       created(){
           this.traer()
           this.traerCursos()
       },
   
       methods:{

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

               axios.post('api/bloque',
   
                       {

                  clave  : this.bloque.clave,
                  nombre : this.bloque.nombre,
                  cve_curso : this.curso.clave,
                  cve_status : this.bloque.cve_status,
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


            document.getElementById("btnActualizar").disabled = false;
            document.getElementById("btnAgregar").disabled = true;

            this.bloque.clave = bloque.clave
            this.bloque.nombre = bloque.nombre
            this.bloque.cve_curso = bloque.cve_curso
            this.bloque.cve_status = bloque.cve_status
            this.bloque.version = bloque.version
            this.bloque.ruta_portal = bloque.ruta_portal
    
           },


           update(clave){
             self = this;
             axios.put(`api/bloque/${clave}`,
              {
                  clave  : this.bloque.clave,
                  nombre : this.bloque.nombre,
                  cve_curso : this.curso.clave,
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





