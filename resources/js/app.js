/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';
import vuetify from './vuetify';
import '../css/app.css';
import Slick from 'vue-slick';
import store from './store';
import i18n from './i18n';

import VueTransmit from "vue-transmit";
Vue.use(VueTransmit);

import HighchartsVue from 'highcharts-vue';
Vue.use(HighchartsVue);

import Particles from "particles.vue";
Vue.use(Particles);

import Spotlight from "spotlight.js";
Vue.use(Spotlight);

import DatetimePicker from 'vuetify-datetime-picker';
Vue.use(DatetimePicker);


axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers['Accept-Language'] = localStorage.getItem('lang') || 'fr';
axios.defaults.withCredentials = true;
axios.defaults.headers.common['Accept'] = `application/json`;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


export const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// axios.interceptors.response.use(
//     response => {
//         return response;
//     },
//     error => {
//         if (error.response.status === 401) {
//             localStorage.removeItem('auth');
//             router.push({ name: 'login' }).catch(() => {});
//         } else {
//             let routesNames = router.options.routes.map(route => route.name);
//             const errorPage = 'error' + error.response.status;

//             if (routesNames.includes(errorPage))
//                 router.push({ name: errorPage }).catch(() => {});
//             else
//                 router.push({ name: 'error404' }).catch(() => {});
//         }
//         return Promise.reject(error);
//     }
// );


Vue.component('Home', require('./components/UserSide/Pages/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ENSA`

    let auth = { authenticated: false}
    if (localStorage.getItem("auth"))
        auth = JSON.parse(localStorage.getItem("auth"))

    if (to.meta.middleware == "guest") {
        if (auth.authenticated) {
            next({ name: auth.to + "Dashboard" })
        }
        next()
    } else {
        if (auth.authenticated) {
            next()
        } else {
            if (to.path !== '/login')
                next({ name: "login" })
        }
    }
});

// Hahia hadi
// store.subscribe((mutation, state) => {
//     let auth = {
//         ...state.auth.store,
// 		version: state.auth.version
// 	};
// 	localStorage.setItem('auth', JSON.stringify(auth));
// });

const app = new Vue({
    el: '#app',
    vuetify,
    i18n,
    router: router,
    store: store,
    render: h => h(App),
});
