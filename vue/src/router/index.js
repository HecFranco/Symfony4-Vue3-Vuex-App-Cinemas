import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);

//types and components
import authTypes from '../types/auth';
import global from '../types/global';
import Login from '../components/Auth/Login';
import Register from '../components/Auth/Register';
import Cinemas from '../components/Cinemas/Cinemas';
//.types and components

//global store
import {store} from '../main';
//.global store

//configure the router
const router = new Router({
  routes: [
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: { Auth: false, title: 'Iniciar sesión' },
      beforeEnter: (to, from, next) => {
        // if the user is loggin
        if(store.state.authModule.logged && store.state.authModule.user!=null) {
          next({ path: '/' });
        } else {
          next();
        }
      }
    },  
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: { Auth: false, title: 'Registrarse' },
      beforeEnter: (to, from, next) => {
        // if the user is loggin
        if(store.state.authModule.logged && store.state.authModule.user!=null) {
          next({ path: '/' });
        } else {
          next();
        }
      }
    } ,
    {
      path: '/',
      name: 'cinemas',
      component: Cinemas,
      meta: { Auth: false, title: 'Cines' },
    },
  ]
});
//.configure the router

//for each route change
router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  // check if the route need authentication and the user is auth
  if (to.meta.Auth && !store.state.authModule.logged) {
    next({path: '/login'});
  } else {
    if (store.state.authModule.logged) {
      store.commit(authTypes.mutations.setUser);
    }
    next();
  }
});
//.for each route change

export default router;