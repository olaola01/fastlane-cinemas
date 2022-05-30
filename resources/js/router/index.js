import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import Login from './../components/auth/Login.vue'
import Register from './../components/auth/Register.vue'
import Home from './../components/pages/Home.vue'
import MovieList from './../components/pages/movie/Index.vue'
import CreateMovie from './../components/pages/movie/Create.vue'
import EditMovie from './../components/pages/movie/Edit.vue'
import CinemaList from './../components/pages/cinema/Index.vue'
import CreateCinema from './../components/pages/cinema/Create.vue'
import EditCinema from './../components/pages/cinema/Edit.vue'

const routes = new VueRouter({
    mode: 'history',
    fallback: true,
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/auth/login',
            component: Login,
            name: 'login',
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/auth/register',
            component: Register,
            name: 'register',
            meta: {
                requiresVisitor: true,
            }
        },
        {
            path: '/movies',
            component: MovieList,
            name: 'movie-list',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/movies/create',
            component: CreateMovie,
            name: 'create-movie',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/cinema/edit/:id',
            component: EditMovie,
            name: 'edit-movie',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/cinema',
            component: CinemaList,
            name: 'cinema-list'
        },
        {
            path: '/cinemas/create',
            component: CreateCinema,
            name: 'create-cinema',
            meta: {
                requiresAuth: true,
            }
        },
        {
            path: '/cinema/edit/:id',
            component: EditCinema,
            name: 'edit-cinema',
            meta: {
                requiresAuth: true,
            }
        },

    ]
})


export default routes
