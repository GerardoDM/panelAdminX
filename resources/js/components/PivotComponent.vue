<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar relación</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form id="form">
                        <div class="form-group">
                           <label>Producto</label>
                            <select  id="selectProducto" v-model="selectedTwo">
                                <option :value="producto.clave" v-for="producto in productos" v-bind:key="producto.clave">{{producto.nombre}}</option>    
                            </select> 
                            <div>{{ errors.cve_producto }}</div>                          
                        </div>
                        <div class="form-group" >
                           <label>Proyecto</label>
                           <select id="selectProyecto" v-model="selected">
                               <option :value="proyecto.clave" v-for="proyecto in proyectos" v-bind:key="proyecto.clave">{{proyecto.nombre}}</option>
                           </select>
                           <div>{{ errors.cve_proyecto }}</div>
                        </div>
                        <div class="form-group">
                           <label># de Licencias</label>
                           <input type="numeric" class="form-control" v-model="pivot.nolicencias">
                           <div>{{ errors.nolicencias }}</div>
                        </div>
                                             
                        <button type="button" id="btnAgregar" class="btn btn-primary" v-on:click="insert(pivot)">Agregar</button>
                        <button type="button" id="btnActualizar" disabled class="btn btn-primary" v-on:click="update(pivot.clave)">Actualizar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container; mt-4" style="height:400px; overflow-y: scroll">
          <h2 class="mb-4">Productos-Proyectos</h2>
         <table class="table table-hover table-dark" >
            <thead>
               <tr>
                <th style="position:sticky; top:0; background: #000000">Clave</th>
                <th style="position:sticky; top:0; background: #000000">Clave Producto</th>
                <th style="position:sticky; top:0; background: #000000">Clave Proyecto</th>
                <th style="position:sticky; top:0; background: #000000"># de Licencias</th>
                <th style="position:sticky; top:0; background: #000000">Acción</th>
                <th style="position:sticky; top:0; background: #000000">Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="pivot in pivots" v-bind:key="pivot.clave">
                  <th>{{pivot.clave}}</th> 
                  <th>{{pivot.cve_producto}}</th>
                  <td>{{pivot.cve_proyecto}}</td>
                  <td>{{pivot.nolicencias}}</td>
                  <td>
                    <button type="button" class="btn btn-secondary" v-on:click="edit(pivot)" data-toggle="modal" data-target="#exampleModal">
                      Editar
                      </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(pivot.clave)">Eliminar</button></td>
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

            $("#selectProducto").change(function(){
                this.producto.clave = $("#selectProducto").val();
                }.bind(this)); 


                $("#selectProyecto").change(function(){
                this.proyecto.clave = $("#selectProyecto").val();
                }.bind(this)); 
        
            
       },
   
       data(){
           return {
               pivots: [],
               productos: [],
               proyectos: [],
   
                pivot: {
                    clave: "",
                    cve_producto: "",
                    cve_proyecto: "",
                    nolicencias: "",
                            
                },

                producto: {
                    clave: "",
                    nombre: "",
                    edicion: "",
                    logo_producto: "",
                    nomenclatura: "",
                   
                },

                proyecto: {
                    clave: "",
                    nombre: "",
                    fecha: "",
                    descripcion: "",
                    nomenclatura: "",
                },

                selected : "",
                selectedTwo : "",
                errors : {},
                valid : true,
                message : null
           
           }
   
       },
   
       created(){
           this.traer()
           this.traerProductos()
           this.traerProyectos()
       },
   
       methods:{

           validation(){

                const validateClaveProducto = cve_producto => {
               if (!cve_producto.length) {
                  
                  return { valid: false, error: "Este campo es requerido." };
               }
               return { valid: true, error: null };
               };

               const validateClaveProyecto = cve_proyecto => {
               if (!cve_proyecto.length) {
                  
                  return { valid: false, error: 'Este campo es requerido.' };
               }

               return { valid: true, error: null };
               }

               const validateNumLicencias = nolicencias => {
               if (!nolicencias.length) {
                  
                  return { valid: false, error: "Este campo es requerido." };
                  
               }

               return { valid: true, error: null };
               };


                this.errors = {}

               const validClaveProducto = validateClaveProducto(this.pivot.cve_producto);
               this.errors.cve_producto = validClaveProducto.error;
               if (this.valid) {
               this.valid = validClaveProducto.valid
               }

               const validClaveProyecto = validateClaveProyecto(this.pivot.cve_proyecto);
               this.errors.cve_proyecto = validClaveProyecto.error;
               if (this.valid) {
               this.valid = validClaveProyecto.valid
               }

               const validNumLicencias = validateNumLicencias(this.pivot.nolicencias);
               this.errors.nolicencias = validNumLicencias.error;
               if (this.valid) {
               this.valid = validNumLicencias.valid
               }

               return 1;

           },

           traer(){
   
              self = this
               axios.get('/api/pivot')
                   .then(response => {
                       this.pivots = response.data;
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
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
               
           },
            
           insert(clave){
   
               self = this
               axios.post('api/pivot',
   
                       {

                     clave : this.pivot.clave,
                     cve_producto : this.producto.clave,
                     cve_proyecto : this.proyecto.clave,
                     nolicencias : this.pivot.nolicencias,
                     
                       })
                       
                .then(response => {


                     this.pivot.clave = ""
                     this.pivot.cve_producto = ""
                     this.pivot.cve_proyecto = ""
                     this.pivot.nolicencias = "" 

                    this.selected = ""
                    this.selectedTwo = ""
                    
                       swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'La relación se ha creado',
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
               axios.delete(`/api/pivot/${clave}`)
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
                   'La relación ha sido borrada',
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

           edit(pivot){

              document.getElementById("btnActualizar").disabled = false;
              document.getElementById("btnAgregar").disabled = true;

            this.pivot.clave = pivot.clave
            this.pivot.cve_producto = pivot.cve_producto;
            this.pivot.cve_proyecto = pivot.cve_proyecto;
            this.pivot.nolicencias = pivot.nolicencias;


           },


           update(clave){
             self = this;
             axios.put(`api/pivot/${clave}`,
              {
                clave : this.pivot.clave,
                cve_producto : this.producto.clave,
                cve_proyecto : this.proyecto.clave,
                nolicencias : this.pivot.nolicencias,
                })
              
              
              .then(response => {

               this.pivot.clave = ""
               this.pivot.cve_producto = ""
               this.pivot.cve_proyecto = ""
               this.pivot.nolicencias = "" 

               this.selected = ""
               this.selectedTwo = ""
                
                      swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El producto se ha actualizado',
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





