<template>
  <div class="register col-md-6 offset-md-3">
     <!-- Title of Form -->  
    <h1 class="text-center">
      <u v-html="$t('profile.title')"></u>
    </h1>    
    <!-- Message of Error --> 
    <div class="alert alert-danger" v-if="error" v-html="$t('profile.error')"></div>
    <hr />
    <!-- Message of Success -->     
    <div class="alert alert-success" v-if="success" v-html="$t('profile.updated')"></div>
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
                autocomplete = "off"
                name = "username"
                v-model = "userlogged.username"
                v-validate
                data-vv-rules = "required"
                ref = "password"
                class = "form-control"
                type = "text"
                id = "username"
                :placeholder = "userlogged.username"
                :class = "{ 'has-error' : errors.has('username') }"
              >
              <span
                v-show="errors.has('username')"
                class="text-danger"
              >
                {{ errors.first('username') }}
              </span>
            </div>
          </div>
        </form>       
      </div> 
    </div>  
    <pre>{{$data}}</pre>
  </div>
  
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions, mapGetters} from 'vuex';

  export default {
    // components: {UserForm},
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
          return this.userLogged.email
        },
        set (email) {
          this.userLogged.email = email;
        }
      },
      username: {
        get () {
          return this.userLogged.username
        },
        set (username) {
          this.userLogged.username = username;
        }
      }
    },
    methods: {
      ...mapActions({
        updateProfile: authTypes.actions.updateProfile
      }),
      validateBeforeSubmit () {
        this.$validator.validateAll().then(result => {
          if ( ! result) {
            //hay errores
          } else {
            this.$emit('processUserForm', this.user);
          }
        })
      },      
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
