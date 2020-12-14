<template>
   <div class="container">
      
      <div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalTitle">Agregar relación</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <validationObserver v-slot="{ handleSubmit }">
                     <form id="form" @submit.prevent="handleSubmit(insert)">
                        <div class="form-group">
                           <label>Producto</label>
                           <validationProvider v-slot="v" rules='required'>
                           <select id="selectProducto" v-model="selectedTwo">
                              <option :value="producto.clave" v-for="producto in productos" v-bind:key="producto.clave">{{producto.nombre}}</option>
                           </select>
                           <span>{{v.errors[0]}}</span>
                           </validationProvider>
                        </div>
                        <div class="form-group">
                           <label>Curso</label>
                           <validationProvider v-slot="v" rules='required'>
                           <select id="selectCurso" v-model="selected">
                              <option :value="curso.clave" v-for="curso in cursos" v-bind:key="curso.clave">{{curso.nombre}}</option>
                           </select>
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
      <h2 class="mb-4">Producto-Curso</h2>

          
      <div class="container; mt-2" style="height:450px; width:max; overflow-y: scroll">
       
         <hr>

         <table class="table table-hover table-dark">
            <thead>
               <tr>
                  <th style="position:sticky; top:0; background: #000000">Nombre Producto <font-awesome-icon icon="angle-down" @click="sortBy('nombreCurso')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Nombre Curso <font-awesome-icon icon="angle-down" @click="sortBy('nombreProducto')"/></th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
                  <th style="position:sticky; top:0; background: #000000">Acciòn</th>
               </tr>
            </thead>
            <tbody>
               
               <tr v-for="pivote in sortedPivotes" v-bind:key="pivote.key">
                  <td><router-link :to="{ name: 'productoCursoDetalle', params: { clave: pivote.cve_curso, claveDos: pivote.cve_producto }  }" style="color:white">{{pivote.nombreProducto}}</router-link></td>
                  <td><router-link :to="{ name: 'productoCursoDetalle', params: { clave: pivote.cve_curso, claveDos: pivote.cve_producto }  }" style="color:white">{{pivote.nombreCurso}}</router-link></td>

                  <td>
                     <button type="button" class="btn btn-secondary" v-on:click="edit(pivote)" data-toggle="modal" data-target="#exampleModal">
                     Editar
                     </button>
                  </td>
                  <td><button type="button" class="btn btn-danger" v-on:click="deleteU(pivote)">Eliminar</button></td>
               </tr>
            </tbody>
         </table>
      </div>
      <button type="button" class="btn btn-primary btn-block mt-4" data-toggle="modal" data-target="#exampleModal">Agregar</button>
   </div>
</template>
<script>

 import { ValidationProvider } from 'vee-validate';
 var hash = require('object-hash');



   export default {
   
       mounted(){
   
            $("#selectCurso").change(function(){
                this.pivote.cve_curso = $("#selectCurso").val();
                }.bind(this)); 

             $("#selectProducto").change(function(){
                 this.pivote.cve_producto = $("#selectProducto").val();
                 }.bind(this)); 

           
       },

       components:{
          ValidationProvider
       },
   
       data(){
   
          
           return {
               productos: [],
               cursos:[],
               pivotes:[],
   
               pivote:{


                  cve_producto: "",
                  cve_curso:null,

                  nombreProducto:"",
                  nombreCurso:"",
                  key:"",
                  valorUno:"",
                  valorDos: ""

               },

               producto: {
                    clave: "",
                    nombre: "",
                    edicion: "",
                    logo_producto: "",
                    nomenclatura: "",
                   
                },

               curso:{
                  clave: "",
                  nombre: ""
               },
   
               selected : "",
               selectedTwo : "",
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
           this.traerProductos()
           this.traerCursos()
           this.traerJoin()
          
       },

        computed:{
          sortedPivotes:function() {
            
             return this.pivotes.sort((a,b) => {

                try {

                let modifier = 1;
              
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
                  
                } catch (error) {

                  
                  
                }


               
            
             });
          },
         itemsWithHash:function() {
               return this.pivotes.map(i => ({ ...i, key: hash(i) }));
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


         
          traerJoin(){
   
              self = this
               axios.get('/api/pivotProductoCursoJoin')
                   .then(response => {
                       this.pivotes = response.data;
                       
                      
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

                  axios.post('api/pivotProductoCurso',
   
                       {
   
                  cve_curso : this.pivote.cve_curso,
                  cve_producto : this.pivote.cve_producto,
                  
                  
                       
                       })


                   .then(response => {
   
                this.pivote.cve_curso  = ""
                this.pivote.cve_producto = ""
   
                this.selected = ""
                this.selectedTwo = ""
                $("#dd").val('') 
                                            
                       swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El pivote se ha creado',
                         index: 0,
                        
                       })
   

                       this.traerJoin();
    
                   })
                   .catch(e => {
                       
                       console.log(e);
                   })


               }

               else if (this.val == 'auto'){
                  // this.update(this.pivote.cve_producto, this.pivote.cve_producto)
                  
             axios.put(`api/pivotProductoCurso/${this.valorUno}/${this.valorDos}`,
              {
                  
                   cve_curso : this.pivote.cve_curso,
                   cve_producto : this.pivote.cve_producto,
                                      
               })
              
              
              .then(response => {


                 this.pivote.key=""
   
                this.pivote.cve_curso  = ""
                this.pivote.cve_producto = ""
               
                
                this.selected = ""
                this.selectedTwo = ""
                                
                      swal.fire({
                         icon: 'success',
                         title: 'Hecho',
                         text: 'El pivote se ha actualizado',
                         index: 0,
                        
                         })
   
               this.traerJoin();
                       
                   })
   
                   
                   .catch(e => {
                       
                       console.log(e);
                         swal.fire({
               title: 'Error',
               text: "Esta relación ya existe." + " " +
               "Elija de nuevo para volver a editar",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Ok'
            })

             this.pivote.key=""
   
                this.pivote.cve_curso  = ""
                this.pivote.cve_producto = ""
               
                
                this.selected = ""
                this.selectedTwo = ""

                   })

                this.val = 'standard'
                  document.getElementById("btnAgregar").innerHTML = 'Agregar'; 
                  document.getElementById("modalTitle").innerHTML = 'Agregar pivote';
               
           }
                  
                  
               
   
               
                       
               
   
           },
   
            deleteU(pivote){

               this.pivote.key = pivote.key

               this.pivote.cve_producto = pivote.cve_producto
               this.pivote.cve_curso = pivote.cve_curso
   
               self = this
               axios.delete(`/api/pivotProductoCurso/${this.pivote.cve_curso}/${this.pivote.cve_producto}`)
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
                   'El pivote ha sido borrado',
                   'success'
                   )
   
                    this.traerJoin();
   
   
               }
               })
   
                      
                   })
                   .catch(e => {

                     
                     console.log(e);
                   
                   })
   
           },
   
           edit(pivote){
   
   
            document.getElementById("btnAgregar").innerHTML = 'Actualizar';
            document.getElementById("modalTitle").innerHTML = 'Actualizar pivote'; 
               
            this.val = 'auto';

            this.pivote.key = pivote.key;
            this.pivote.cve_curso = pivote.cve_curso
            this.pivote.cve_producto = pivote.cve_producto
            this.selected = pivote.cve_curso
            this.selectedTwo = pivote.cve_producto

            this.valorUno = this.pivote.cve_curso
            this.valorDos = this.pivote.cve_producto

            console.log(this.pivote.cve_producto)
            console.log(this.pivote.cve_curso)

            // if (this.pivote.key.length == 0){
            //    console.log('Llave vacía')
            // }

            // if (this.pivote.key.length > 0){
            //    console.log('Llave NO vacia')
            // }    
            
           },
   
   
         //   update(key){
              
         //     self = this;
         //     axios.put(`api/pivotProductoCurso/${this.pivote.cve_curso}/${this.pivote.cve_producto}`,
         //      {
                  
         //           cve_curso : 3,
         //           cve_producto : 'ggg',
                                      
         //       })
              
              
         //      .then(response => {


         //         this.pivote.key=""
   
         //        this.pivote.cve_curso  = ""
         //        this.pivote.cve_producto = ""
               
                
         //        this.selected = ""
         //        this.selectedTwo = ""
                                
         //              swal.fire({
         //                 icon: 'success',
         //                 title: 'Hecho',
         //                 text: 'El pivote se ha actualizado',
         //                 index: 0,
                        
         //                 })
   
         //       this.traerJoin();
                       
         //           })
   
                   
         //           .catch(e => {
                       
         //               console.log(e);
         //           })
               
         //   }
   
       }
   
   }
</script>
<style>
   .body{
   background-color: darkslategrey;
   }