require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router'; 
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';

import MainApp from './components/MainApp.vue';

import Buefy from 'buefy';
import 'buefy/dist/buefy.css';

Vue.use(Buefy);
Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
