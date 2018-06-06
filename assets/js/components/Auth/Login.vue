<template>
  <div class="login col-md-6 offset-md-3">
     <!-- Title of Form -->  
    <h1 class="text-center">
      <u v-html="$t('login.title')"></u>
    </h1>
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('login.error')"></div>
    <hr />
    <!-- Block Form Login -->
    <div class="card">
      <div class="card-body">
        <form
          autocomplete="off"
          class="form-horizontal"
          @submit.prevent="validateBeforeSubmit"
        >
          <div class="form-group">
            <label
              class="control-label col-md-12"
              for="email"
              v-html="$t('login.email')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('email') }"
            >
              <input
                autocomplete="off"
                name="email"
                v-model="user.email"
                v-validate
                data-vv-rules="required|email"
                class="form-control"
                type="text"
                id="email"
                :placeholder="$t('login.email')"
                :class="{ 'has-error' : errors.has('email') }"
              >
              <span
                v-show="errors.has('email')"
                class="text-danger"
              >
                {{ errors.first('email') }}
              </span>
            </div>
          </div>
          <div
            class="form-group"
          >
            <label
              class="control-label col-md-12"
              for="password"
              v-html="$t('login.password')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('password') }"
            >
              <input
                autocomplete="off"
                name="password"
                v-model="user.password"
                v-validate
                data-vv-rules="required|min:6"
                class="form-control"
                type="password"
                id="password"
                :placeholder="$t('login.password')"
                :class="{ 'has-error' : errors.has('password') }"
              >
              <span
                v-show="errors.has('password')"
                class="text-danger"
              >
                {{ errors.first('password') }}
              </span>
            </div>
          </div>
          <hr />

          <button
            type="submit"
            class="btn btn-success btn-block"
            v-html="$t('login.title')"
          >
          </button>
        </form>
      </div>
    </div>  
    <pre style="color:white;">{{$data}}</pre>                  
  </div>
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'login',
    data () {
      return {
        user:{
          // email: '',
          // password: '',
          email: 'admin@admin.com',
          password: 'admin_',
          getHash: null
        },
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.login' like 'login' alias
        login: authTypes.actions.login
      }),
      validateBeforeSubmit () {
        // validator for the login form
        this.$validator.validateAll()
          .then(result => {
            console.log(result);
            if ( ! result) {
              //There are errors
              console.log('Vee-Validate is not working correctly')
            } else {
              this.login({
                  email: this.user.email,
                  password: this.user.password,
                  getHash: this.user.getHash
                })
                .then(
                  user => {
                    this.$router.push('/');
                  },
                  error => {
                    this.error = true;
                  }
                )  
            }
          })
          .catch(error =>{
            console.log(error);
          })
      }
    }
  }
</script>
<style scope>

</style>