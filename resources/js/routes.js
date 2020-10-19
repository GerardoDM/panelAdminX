

import BloqueComponent from './components/BloqueComponent.vue';
import CursoComponent from './components/CursoComponent.vue';
import ProductoComponent from './components/ProductosComponent.vue';
import ProyectoComponent from './components/ProyectosComponent.vue';
import PivotComponent from './components/PivotComponent.vue';
import DashComponent from './components/DashComponent.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);



export const router = new VueRouter({

    routes : [
        
        {
            name: 'dash',
            path: '/',
            component: DashComponent
        },
    
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
            name: 'pivot',
            path: '/pivot',
            component: PivotComponent
        },
    ],    


    mode: 'history',
    

})