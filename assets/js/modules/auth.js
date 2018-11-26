import types from '../types/auth';
import globalTypes from '../types/global';
import Vue from 'vue';
import Axios from 'axios';

const state = {
  user: null,
  // convert to boolean the _token in localStorage
  logged: !!window.localStorage.getItem('_token')
};
const actions = {
  [types.actions.login]: ({commit}, userInput) => {
    // start processing
    commit(globalTypes.mutations.startProcessing);    
    return new Promise((resolve, reject) => {
      let json = JSON.stringify({user: userInput});
      let params = "json=" + json;
      let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
      // Vue.prototype.$hostname is defined in main.js and is the url of query
      Axios
        .post(Vue.prototype.$hostname+'/login',
          params,
          {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
        .then(response => {
          window.localStorage.setItem('_token', response.data);
          commit(types.mutations.setUser);
          resolve(response);
        })
        .catch(error => {
          reject(error);
        });
        // end processing
        commit(globalTypes.mutations.stopProcessing);
    })
  },
  [types.actions.register]: ({commit}, userInput) => {
    // start processing
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      let json = JSON.stringify({user: userInput});
      let params = "json=" + json;
      let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
      // Vue.prototype.$hostname is defined in main.js and is the url of query
      Axios
        .post(Vue.prototype.$hostname+'/register',
          params,
          {headers: headers})
        .then(response => {
          resolve(response);
        })
        .catch(error => {
          reject(error);
        });
        // end processing
        commit(globalTypes.mutations.stopProcessing);
    })
  },
  [types.actions.updateProfile]: ({commit}, userInput) => {
    // start processing
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      Vue.http.put('profile', {user: userInput})
        .then(user => {
          window.localStorage.setItem('_token', user.body.token);
          commit(types.mutations.setUser);
          resolve(user);
        })
        .catch(error => {
          reject(error);
        })
        .finally(() => {
          // finally processing
          commit(globalTypes.mutations.stopProcessing);
        })
    })
  },
  [types.actions.logout]: ({commit}) => {
    window.localStorage.removeItem('_token');
    commit(types.mutations.setUser);
  }
};
const getters = {
  // to get the user
  [types.getters.user]: (state) => {
    return state.user;
  },
  // to be logged in?
  [types.getters.logged]: (state) => {
    return state.logged;
  }
};
const mutations = {
  // to set the user through the token jwt
  [types.mutations.setUser]: (state) => {
    if(window.localStorage.getItem('_token')) {
      const token = window.localStorage.getItem('_token');
      const jwtDecode = require('jwt-decode');
      state.user = jwtDecode(token);
      state.logged = true;
    } else {
      state.logged = false;
      state.user = null;
    }
  },
  // to establish the user's status
  [types.mutations.setLogged]: (state, logged) => {
    state.logged = logged;
  }
};
export default {
  state,
  actions,
  getters,
  mutations
}