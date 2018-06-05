<template>
  <div class="login col-md-6 col-md-offset-3">
    <h1 class="text-center text-muted">
      <u v-html="$t('profile.title')"></u>
    </h1>

    <div class="alert alert-success" v-if="success" v-html="$t('profile.updated')"></div>

    <div class="alert alert-danger" v-if="error" v-html="$t('profile.error')"></div>

    <hr />

    <user-form
      :user="{email: email, username: username}"
      :btnText="$t('profile.title')"
      v-if="userLogged"
      :isProfile="true"
      v-on:processUserForm="processProfile($event)"
    ></user-form>

  </div>
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions, mapGetters} from 'vuex';
  import UserForm from "../Auth/UserForm";
  export default {
    components: {UserForm},
    name: 'profile',
    data () {
      return {
        success: false,
        error: false
      }
    },
    computed: {
      ...mapGetters({
        userLogged: authTypes.getters.user
      }),
      email: {
        get () {
          return this.userLogged.data.email
        },
        set (email) {
          this.userLogged.data.email = email;
        }
      },
      username: {
        get () {
          return this.userLogged.data.username
        },
        set (username) {
          this.userLogged.data.username = username;
        }
      }
    },
    methods: {
      ...mapActions({
        updateProfile: authTypes.actions.updateProfile
      }),
      processProfile (user) {
        this.updateProfile({
          email: user.email,
          username: user.username
        })
          .then(
            res => {
              this.success = true;
              this.error = false;
            },
            err => {
              this.success = false;
              this.error = true;
            }
          )
      }
    }
  }
</script>
