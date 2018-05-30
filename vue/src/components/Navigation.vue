<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Vue.js 2</a>
    <button 
      class="navbar-toggler" 
      type="button" 
      data-toggle="collapse" 
      data-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" 
      aria-expanded="false" 
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"> 
        <li class="nav-item active">
          <router-link class="nav-link" to="/">
            <font-awesome-icon icon="map-marker"></font-awesome-icon>
            {{ $t('navigation.cinema') }}
          </router-link>
        </li>
        <li class="nav-item"><router-link class="nav-link" to="/profile" v-if="isLogged && userLogged != null">{{ $t('navigation.my_account') }}</router-link></li>
        <li class="nav-item"><router-link class="nav-link" to="/bookings" v-if="isLogged && userLogged != null">{{ $t('navigation.bookings') }}</router-link></li>
        <!--
        <language-selector></language-selector>          
        -->
      </ul>
      <ul class="navbar-nav my-auto"> 
          <li class="nav-item">
            <router-link class="nav-link" to="/login" v-if="!isLogged || userLogged == null">
              <font-awesome-icon icon="sign-in-alt"></font-awesome-icon>
              {{ $t('navigation.login') }}
            </router-link>
            
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/register" v-if="!isLogged || userLogged == null">
              <font-awesome-icon icon="user-plus"></font-awesome-icon>
              {{ $t('navigation.register') }}
            </router-link>
          </li>
          <li class="nav-item"><a class="nav-link" href="#" @click.prevent="logout()" v-if="isLogged && userLogged != null">{{ $t('navigation.logout') }}</a></li>
      </ul>      
    </div>   
  </nav>    
</template>

<script>
  import {mapGetters, mapActions} from 'vuex';
  import authTypes from '../types/auth';

  export default {
    name: 'navigation',
    methods: {
      ...mapActions({
        // alias : methods
        _logout: authTypes.actions.logout
      }),
      logout() {
          this._logout();
          this.$router.push({name: 'login'});
      }
    },
    computed: {
      ...mapGetters({
        isLogged: authTypes.getters.logged,
        userLogged: authTypes.getters.user
      })
    }
  }
</script>