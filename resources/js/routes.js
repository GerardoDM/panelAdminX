

import BloqueComponent from './components/BloqueComponent.vue';
import CursoComponent from './components/CursoComponent.vue';
import ProductoComponent from './components/ProductosComponent.vue';
import ProyectoComponent from './components/ProyectosComponent.vue';
import PivotComponent from './components/PivotComponent.vue';
import ProductoCursoComponent from './components/ProductoCursoComponent.vue'
import DashComponent from './components/DashComponent.vue';
import BloqueDetalleComponent from './components/BloqueDetalleComponent.vue';
import CursoDetalleComponent from './components/CursoDetalleComponent.vue';
import ProductoDetalleComponent from './components/ProductoDetalleComponent.vue';
import ProyectoDetalleComponent from './components/ProyectoDetalleComponent.vue';
import PivotDetalleComponent from './components/PivotDetalleComponent.vue';
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

        {
            name: 'pivotProductoCurso',
            path: '/pivotProductoCurso',
            component: ProductoCursoComponent
        },

        {
            name: 'bloqueDetalle',
            path: '/bloqueDetalle/:clave',
            component: BloqueDetalleComponent
        },
        {
            name: 'cursoDetalle',
            path: '/cursoDetalle/:clave',
            component: CursoDetalleComponent
        },
        {
            name: 'productoDetalle',
            path: '/productoDetalle/:clave',
            component: ProductoDetalleComponent
        },
        {
            name: 'proyectoDetalle',
            path: '/proyectoDetalle/:clave',
            component: ProyectoDetalleComponent
        },
        {
            name: 'pivotDetalle',
            path: '/pivotDetalle/:clave',
            component: PivotDetalleComponent
        },
    ],    


    mode: 'history',
    

})