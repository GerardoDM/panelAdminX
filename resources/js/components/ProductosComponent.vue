<template>
   <div class="container">
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form>
                        <div class="form-group">
                           <label>Nombre</label>
                           <input type="text" class="form-control" v-model="producto.nombre">
                        </div>
                        <div class="form-group">
                           <label>Apellido Paterno</label>
                           <input type="text" class="form-control" v-model="producto.edicion">
                        </div>
                        <div class="form-group">
                           <label>Apellido Materno</label>
                           <input type="text" class="form-control" v-model="producto.logo_producto">
                        </div>
                        <div class="form-group">
                           <label>Mail</label>
                           <input type="email" class="form-control" v-model="producto.nomenclatura">
                        </div>
                       
                        <button type="button" class="btn btn-primary" v-on:click="insert(producto)">Agregar</button>
                         <button type="button" class="btn btn-primary" v-on:click="update(producto.clave)">Actualizar</button>
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
                  <th style="position:sticky; top:0; background: #000000">Edicion</th>
                  <th style="position:sticky; top:0; background: #000000">Logo</th>
                  <th style="position:sticky; top:0; background: #000000">Nomenclatura</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
                  <th style="position:sticky; top:0; background: #000000">Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr v-for="producto in productos" v-bind:key="producto.clave">
                  <th>{{producto.nombre}}</th>
                  <td>{{producto.edicion}}</td>
                  <td>{{producto.logo_producto}}</td>
                  <td>{{producto.nomenclatura}}</td>
                  <td>
                    <button type="button" class="btn btn-secondary" v-on:click="edit(producto)" data-toggle="modal" data-target="#exampleModal">
                      Editar
                      </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(producto.clave)">Eliminar</button></td>
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
               productos: [],
   
               producto: {
                    clave: "",
                    nombre: "",
                    edicion: "",
                    logo_producto: "",
                    nomenclatura: "",
                },
           }
   
       },
   
       created(){
           this.traer()
       },
   
       methods:{
           traer(){
   
              self = this
               axios.get('/api/productos')
                   .then(response => {
                       this.productos = response.data;
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })
               
           },
   
           
           insert(clave){
   
   
               self = this
               axios.post('api/productos',
   
                       {
                       nombre : this.producto.nombre,
                       edicion : this.producto.edicion,
                       logo_producto : this.producto.logo_producto,
                       nomenclatura : this.producto.nomenclatura,
                       })
                       
                .then(response => {
   
                       this.producto.nombre = ""
                       this.producto.edicion = ""
                       this.producto.logo_producto = "" 
                       this.producto.nomenclatura = ""
                       
                                        
   
                       swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El producto se ha creado',
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
               axios.delete(`/api/productos/${clave}`)
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
                   'El producto ha sido borrado',
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

           edit(producto){

            this.producto.clave = producto.clave
            this.producto.nombre = producto.nombre;
            this.producto.edicion = producto.edicion;
            this.producto.logo_producto = producto.logo_producto;
            this.producto.nomenclatura = producto.nomenclatura;

           },


           update(clave){
             self = this;
             axios.put(`api/productos/${clave}`,
              {
                       nombre : this.producto.nombre,
                       edicion : this.producto.edicion,
                       logo_producto : this.producto.logo_producto,
                       nomenclatura : this.producto.nomenclatura,
                       })
              
              
              .then(response => {

               this.producto.nombre = ""
               this.producto.edicion = ""
               this.producto.logo_producto = "" 
               this.producto.nomenclatura = ""
                
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





