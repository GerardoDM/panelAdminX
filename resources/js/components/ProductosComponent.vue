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
                     <form id="form">
                         <div class="form-group">
                           <label>Clave</label>
                           <input type="text" class="form-control" v-model="producto.clave" required>
                        </div>
                        <div class="form-group">
                           <label>Nombre</label>
                           <input type="text" class="form-control" v-model="producto.nombre" required>
                        </div>
                        <div class="form-group">
                           <label>Edicion</label>
                           <input type="text" class="form-control" v-model="producto.edicion">
                        </div>
                        <div class="form-group">
                           <label>Logo Producto</label>
                           <input type="file" class="form-control-file" @change="onFileChange" >
                        </div>

                        <img v-bind:src="imagePreview" width="200" height="200" v-show="showPreview"/>

                        <div class="form-group">
                           <label>Nomenclatura</label>
                           <input type="text" :maxlength="3"  class="form-control" v-model="producto.nomenclatura" required>
                        </div>
  
                            
                                           
                        <button type="button" id="btnAgregar" class="btn btn-primary" v-on:click="insert(producto)">Agregar</button>
                         <button type="button" id="btnActualizar" disabled class="btn btn-primary" v-on:click="update(producto.clave)">Actualizar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container; mt-4" style="height:400px; overflow-y: scroll">
         <h2 class="mb-4">Productos</h2>
         <table class="table table-hover table-dark" >
            <thead>
               <tr>
                <th style="position:sticky; top:0; background: #000000">Clave</th>
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
                  <th>{{producto.clave}}</th> 
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
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">Agregar</button>
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

                imagePreview: null,
                showPreview: false,
           }
   
       },
   
       created(){
           this.traer()
       },
   
       methods:{

           onFileChange(event){

            this.producto.logo_producto = event.target.files[0];
            console.log(event.target.files[0]);

                    /*
            Initialize a File Reader object
            */
            let reader  = new FileReader();

            /*
            Add an event listener to the reader that when the file
            has been loaded, we flag the show preview as true and set the
            image to be what was read from the reader.
            */
            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);

            /*
            Check to see if the file is not empty.
            */
            if( this.producto.logo_producto ){
                /*
                    Ensure the file is an image file.
                */
                if ( /\.(jpe?g|png|gif)$/i.test( this.producto.logo_producto.name ) ) {

                    console.log("here");
                    /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
                    reader.readAsDataURL( this.producto.logo_producto );
                }
            }

        },

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

                     clave : this.producto.clave,
                     nombre : this.producto.nombre,
                     edicion : this.producto.edicion,
                     logo_producto : this.producto.logo_producto.name,
                     nomenclatura : this.producto.nomenclatura,
                       })
                       
                .then(response => {


                     this.producto.clave = ""
                     this.producto.nombre = ""
                     this.producto.edicion = ""
                     this.producto.logo_producto = "" 
                     this.producto.nomenclatura = ""
                     this.imagePreview = false
                       
                                        
   
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

              document.getElementById("btnActualizar").disabled = false;
              document.getElementById("btnAgregar").disabled = true;

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
                       logo_producto : this.producto.logo_producto.name,
                       nomenclatura : this.producto.nomenclatura,
                       })
              
              
              .then(response => {


               this.producto.clave = ""
               this.producto.nombre = ""
               this.producto.edicion = ""
               this.producto.logo_producto = "" 
               this.producto.nomenclatura = ""
               this.imagePreview = false
                
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





