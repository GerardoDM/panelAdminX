

import BloqueComponent from './components/BloqueComponent.vue';
import CursoComponent from './components/CursoComponent.vue';
import ProductoComponent from './components/ProyectosComponent.vue';
import ProyectoComponent from './components/ProductosComponent.vue';
import PruebaComponent from './components/PruebaComponent.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// export const routes = [
    
    
//     {
//         name: 'bloques',
//         path: '/bloques',
//         component: BloqueComponent
//     },


//     {
//         name: 'cursos',
//         path: '/cursos',
//         component: CursoComponent
//     },

//     {
//         name: 'productos',
//         path: '/productos',
//         component: ProductoComponent
//     },

//     {
//         name: 'proyectos',
//         path: '/proyectos',
//         component: ProyectoComponent
//     },

//     {
//         name: 'prueba',
//         path: '/prueba',
//         component: PruebaComponent
//     },

   


// ];

export const router = new VueRouter({

    routes : [
    
    
        {
            name: 'bloques',
            path: '/bloques',
            component: BloqueComponent
        },
    
    
        {
            name: 'cursos',
            path: '/cursos',
            component: CursoComponent
        },
    
        {
            name: 'productos',
            path: '/productos',
            component: ProductoComponent
        },
    
        {
            name: 'proyectos',
            path: '/proyectos',
            component: ProyectoComponent
        },
    
        {
            name: 'prueba',
            path: '/prueba',
            component: PruebaComponent
        },
    ],    


    mode: 'history',
    

})