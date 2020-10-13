

import BloqueComponent from './components/BloqueComponent.vue';
import CursoComponent from './components/CursoComponent.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

export const routes = [
    
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

   


];

export default new VueRouter({

})