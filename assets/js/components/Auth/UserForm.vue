<template>
  <div>

    <div class="well">
      <form
        autocomplete="off"
        class="form-horizontal"
        @submit.prevent="validateBeforeSubmit"
      >
        <div class="form-group">
          <label
            class="control-label col-md-4"
            for="email"
            v-html="$t('register.email')"
          >
          </label>

          <div
            class="col-md-8"
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
          v-if="isProfile"
        >
          <label
            class="control-label col-md-4"
            for="email"
            v-html="$t('profile.username')"
          >
          </label>
          <div
            class="col-md-8"
            :class="{ 'has-error' : errors.has('username') }"
          >
            <input
              autocomplete="off"
              name="username"
              v-model="user.username"
              v-validate
              data-vv-rules="required"
              class="form-control"
              type="text"
              id="username"
              :placeholder="$t('profile.username')"
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

        <div
          class="form-group"
          v-if="isRegister || isLogin"
        >
          <label
            class="control-label col-md-4"
            for="password"
            v-html="$t('register.password')"
          >
          </label>

          <div
            class="col-md-8"
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
          v-if="isRegister"
        >
          <label
            for="password_confirmation"
            class="control-label col-md-4"
            v-html="$t('register.password_confirmation')"
          ></label>

          <div
            class="col-md-8"
            :class="{ 'has-error' : errors.has('password_confirmation') }"
          >
            <input
              type="password"
              v-model="user.password_confirmation"
              name="password_confirmation"
              class="form-control"
              id="password_confirmation"
              :placeholder="$t('register.password_confirmation')"
              v-validate="'required|confirmed:password'"
              :class="{'has-errors': errors.has('password_confirmation')}"
            >
            <span
              v-show="errors.has('password_confirmation')"
              class="text-danger"
            >
              {{ errors.first('password_confirmation') }}
            </span>
          </div>
        </div>

        <hr />

        <button
          type="submit"
          class="btn btn-success btn-block"
          v-html="btnText"
        >
        </button>
      </form>
    </div>

  </div>
</template>

<script>
  import authTypes from '../../types/auth';
  import {mapActions} from 'vuex';
  export default {
    name: 'user-form',
    props: {
      user: {
        type: Object,
        required: true
      },
      isLogin: {
        type: Boolean
      },
      isRegister: {
        type: Boolean
      },
      isProfile: {
        type: Boolean
      },
      btnText: {
        type: String,
        required: true
      }
    },
    data () {
      return {
        error: null
      }
    },
    methods: {
      validateBeforeSubmit () {
        this.$validator.validateAll().then(result => {
          if ( ! result) {
            //hay errores
          } else {
            this.$emit('processUserForm', this.user);
          }
        })
      }
    }
  }
</script>