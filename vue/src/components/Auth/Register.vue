<template>
  <div class="register col-md-6 offset-md-3">
     <!-- Title of Form -->  
    <h1 class="text-center">
      <u v-html="$t('register.title')"></u>
    </h1>
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('register.error')"></div>
    <hr />
    <!-- Block Form username -->
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
              for="username"
              v-html="$t('register.username')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('username') }"
            >
              <input
                autocomplete="off"
                name="username"
                v-model="username"
                v-validate
                data-vv-rules="required"
                class="form-control"
                type="text"
                id="username"
                :placeholder="$t('register.username')"
                :class="{ 'has-error' : errors.has('username') }"
              >
              <span
                v-show="errors.has('username')"
                class="text-danger"
              >
                {{ errors.first('username') }}
              </span>
            </div>
          </div>
          <div class="form-group">
            <label
              class="control-label col-md-12"
              for="email"
              v-html="$t('register.email')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('email') }"
            >
              <input
                autocomplete="off"
                name="email"
                v-model="email"
                v-validate
                data-vv-rules="required|email"
                class="form-control"
                type="text"
                id="email"
                :placeholder="$t('register.email')"
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
              v-html="$t('register.password')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('password') }"
            >
              <input
                autocomplete="off"
                name="password"
                v-model="password"
                v-validate
                data-vv-rules="required|min:6"
                class="form-control"
                type="password"
                id="password"
                :placeholder="$t('register.password')"
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
          <div
            class="form-group"
          >
            <label
              class="control-label col-md-12"
              for="password_confirmation"
              v-html="$t('register.password_confirmation')"
            >
            </label>

            <div
              class="col-md-12"
              :class="{ 'has-error' : errors.has('password_confirmation') }"
            >
              <input
                autocomplete="off"
                name="password_confirmation"
                v-model="password_confirmation"
                v-validate
                data-vv-rules="required|confirmed:password"
                class="form-control"
                type="password"
                id="password_confirmation"
                :placeholder="$t('register.password_confirmation')"
                :class="{ 'has-error' : errors.has('password_confirmation') }"
              >
              <span
                v-show="errors.has('password_confirmation')"
                class="text-danger"
              >
                {{ errors.first('password_confirmation') }}
              </span>
            </div>
          </div>
          <button
            type="submit"
            class="btn btn-success btn-block"
            v-html="$t('register.title')"
          >
          </button>
        </form>
      </div>
    </div>                
  </div>
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';

  export default {
    name: 'register',
    data () {
      return {
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
        error: null
      }
    },
    methods: {
      ...mapActions({
        // we define the action of model auth.js 'authTypes.actions.register' like 'register' alias
        register: authTypes.actions.register
      }),
      validateBeforeSubmit () {
        // validator for the register form
        this.$validator.validateAll()
          .then(result => {
            if ( ! result) {
              //There are errors
              console.log('Vee-Validate is not working correctly')
            } else {
              this.register({
                  email: this.email,
                  password: this.password,
                  username: this.username
                })
                .then(
                  response => {
                    this.$router.push('/login');
                  },
                  error => {
                    this.error = true;
                  }
                )  
            }
          })
          .catch(error =>{
            console.log(error);
            this.error = true;
          })
      }
    }
  }
</script>