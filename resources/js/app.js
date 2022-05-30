require('./bootstrap');
import Vue from 'vue';
import routes from './router/index';
import { HasError, AlertError } from 'vform/src/components/bootstrap5'
import Toaster from "v-toaster";
import store from './store/index';


import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('app-header', require('./components/Header.vue').default);

function isLoggedIn() {
    return store.getters.getAuthenticated;
}

routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    }else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: 'dashboard',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})


// check authentication
let auth = localStorage.getItem("auth");

if(auth){
    store.dispatch('authUser').then(() => {
        const app = new Vue({
            el: '#app',
            router: routes,
            store,
        });
    });
}else {
    const app = new Vue({
        el: '#app',
        router: routes,
        store,
    });
}
