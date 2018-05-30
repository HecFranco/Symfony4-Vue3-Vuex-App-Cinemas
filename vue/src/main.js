import Vue from 'vue'
import App from './App.vue'
import router from './router/index'

//bootstrapVue
  import BootstrapVue from 'bootstrap-vue'
  Vue.use(BootstrapVue);
  import jQuery from 'jquery';
  import bootstrap from 'bootstrap'; 
  import fontAwesomeIcon from './utils/fa.config.js';
//.bootstrapVue

//vue axios
// https://github.com/paweljw/bookstore-frontend/tree/master/src
// https://paweljw.github.io/2017/09/vue.js-front-end-app-part-3-authentication/
import Axios from 'axios';
  // Vue.use(Axios, axiosConfig)
//.vue axios

//blockui
  import BlockUI from 'vue-blockui';
  Vue.use(BlockUI);
//.blockui

//vee-validate
  import VeeValidate, {Validator} from 'vee-validate';
  // To make validator with translations......
  Vue.use(VeeValidate);
//.vee-validate

//vue-tables-2
  import {ClientTable} from 'vue-tables-2';
  Vue.use(ClientTable, {}, false, 'bootstrap4', 'default');
//.vue-tables-2

//modules and types
  import globalTypes from './types/global';
  import authModule from './modules/auth';
  import cinemaModule from './modules/cinema';
//.modules and types

//vuex
  import Vuex from 'vuex'
  Vue.use(Vuex)
    //global data warehouse with vuex
    export const store = new Vuex.Store({
    state: {
      processing: false,
      language: 'es'      
    },
    actions: {
      [globalTypes.actions.changeLanguage]: ({commit}, lang) => {
        commit(globalTypes.mutations.setLanguage, lang);
        switch (lang) {
          case 'en': {
            Validator.localize('en', validatorEn);
            break;
          }
          case 'es': {
            Validator.localize('es', validatorEs);
            break;
          }
        }
      }      
    },
    getters: {
      // get the value of data
      [globalTypes.getters.processing]: state => state.processing,
      [globalTypes.getters.language]: state => state.language,      
    },
    mutations: {
      // manage the change in the data
      [globalTypes.mutations.startProcessing] (state) {
        state.processing = true;
      },
      [globalTypes.mutations.stopProcessing] (state) {
        state.processing = false;
      },
      [globalTypes.mutations.setLanguage] (state, lang) {
        state.language = lang;
      }     
    },
    modules: {
      authModule,
      cinemaModule,
    }
    });
    //.global data warehouse with vuex
//.vuex

//vue translations
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);
import messages from './translations';
const i18n = new VueI18n({
  locale: store.state.language,
  messages
});
//.vue translations

//vue-router
  import VueRouter from 'vue-router'
  Vue.use(VueRouter)
//.vue-router

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  store,
  i18n,
  router
}).$mount('#app')
