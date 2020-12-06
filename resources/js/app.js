/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.swal = swal;
Vue.use(VeeValidate);



import * as VeeValidate from 'vee-validate'
import { numeric } from 'vee-validate/dist/rules';

import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import swal from 'sweetalert2'
import {  router } from './routes.js';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faAngleDown } from '@fortawesome/free-solid-svg-icons'
import { faAngleUp } from '@fortawesome/free-solid-svg-icons'
import { faSearch } from '@fortawesome/free-solid-svg-icons'




library.add(faAngleDown)
library.add(faAngleUp)
library.add(faSearch)


extend('numeric', numeric);

extend('numeric', {
  
  message: 'Debe ser numerico'
});




extend('positive', value => {
    return value >= 0;
    
});

extend('required', {
    validate (value) {
      return {
        required: true,
        valid: ['', null, undefined].indexOf(value) === -1
      };
    },
    computesRequired: true,
    message: 'Este campo es requerido'

  });

  // extend('numeric', {
  //   validate (value) {
  //     return {
        
  //       regex: /\.(js|ts)$/ }
      
  //   },
  //   computesRequired: true,
  //   message: 'Este campo debe ser numerico'

  // });






// router.onError(callback)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('form-component', require( './components/FormComponent.vue').default);
Vue.component('productos-component', require( './components/ProductosComponent.vue').default);
Vue.component('proyectos-component', require( './components/ProyectosComponent.vue').default);
Vue.component('pivot-component', require( './components/PivotComponent.vue').default);
Vue.component('curso-component', require( './components/CursoComponent.vue').default);
Vue.component('bloque-component', require( './components/BloqueComponent.vue').default);
Vue.component('bloqueDetalle-component', require( './components/BloqueDetalleComponent.vue').default);
Vue.component('cursoDetalle-component', require( './components/CursoDetalleComponent.vue').default);
Vue.component('productoDetalle-component', require( './components/ProductoDetalleComponent.vue').default);
Vue.component('proyectoDetalle-component', require( './components/ProyectoDetalleComponent.vue').default);
Vue.component('pivotDetalle-component', require( './components/PivotDetalleComponent.vue').default);
Vue.component('productoCurso-component', require( './components/ProductoCursoComponent.vue').default);
Vue.component('app-component', require( './components/App.vue').default);
Vue.component('dash-component', require( './components/DashComponent.vue').default);
Vue.component('validationProvider', ValidationProvider);
Vue.component('validationObserver', ValidationObserver);
Vue.component('font-awesome-icon', FontAwesomeIcon)





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,

       

});


const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  window.toast = toast;





