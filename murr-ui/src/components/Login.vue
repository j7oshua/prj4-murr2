<template>
  <div>
    <h1>Login</h1>
    <b-overlay :show="isDisabled">
    <!-- The form input -->
    <form @submit.prevent="handleSubmit()">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="username">Email or Phone</label>
          <input id="username" type="text" class="form-control" v-model.trim="$v.resident.username.$model"
          :class="{'is-invalid':$v.resident.username.$error, 'is-valid':!$v.resident.username.$invalid }">
          <div class="valid-feedback" id="properUsername">Your username is valid!</div>
          <div class="invalid-feedback" id="errorMessageUser">
            <span v-if="!$v.resident.username.required">Email or Phone is required</span>
            <span v-if="!$v.resident.username.minLength">Email or Phone be at least 6 characters! </span>
            <span v-if="!$v.resident.username.maxLength">Email or Phone can't be over 150 characters! </span>
          </div>
        </div>
      </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="password">Password</label>
              <input id="password" type="password" class="form-control" v-model="$v.resident.password.$model"
                     :class="{'is-invalid':$v.resident.password.$error, 'is-valid':!$v.resident.password.$invalid }">
              <div class="valid-feedback" id="properPassword">Your password is valid!</div>
            <div class="invalid-feedback" id="errorMessagePass">
              <span v-if="!$v.resident.password.required">Password is required</span>
              <span v-if="!$v.resident.password.minLength">Password must be at least 7 characters! </span>
              <span v-if="!$v.resident.password.maxLength">Password can't be over 30 characters! </span>
            </div>
            </div>
          </div>
      <div class="alert-danger" id="errorMessage" v-if='submitted && this.error.message === "Invalid credentials."'>Invalid credentials</div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </b-overlay>
  </div>
</template>

<script>
import ResidentMixin from '../mixins/resident-mixin'
import { validationMixin } from 'vuelidate'
import axios from 'axios'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
  name: 'Login',
  mixins: [ResidentMixin, validationMixin],
  data () {
    return {
      resident: {
        username: '',
        password: ''
      },
      tempNewResident: {},
      isBusy: false,
      url: '/points',
      error: {},
      responseCode: 0,
      submitted: false
    }
  },
  validations: { // validation requirements for the vuelidate to work
    // all requirements that a resident objects needs for input fields
    resident: {
      username: {
        required,
        minLength: minLength(6),
        maxLength: maxLength(150)
      },
      password: {
        required,
        minLength: minLength(7),
        maxLength: maxLength(30)
      }
    }
  },
  methods: {
    // this method will handle the submit of login information and make the axios request to the api
    handleSubmit () {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        // temp place holder that holds all the inputted information
        this.tempNewResident = {
          username: this.resident.username,
          password: this.resident.password
        }
        this.isBusy = true
        this.error = {}
        this.submitted = true
        axios.post('http://127.0.0.1:8000/login', {
          username: this.resident.username,
          password: this.resident.password
        })
          .then(response => {
            sessionStorage.setItem('token', response.data.token)
            sessionStorage.setItem('id', response.data.data.id)
            this.username = ''
            this.password = ''
            this.$router.push(this.url)
          }).catch(err => {
            this.responseCode = 401
            this.error = err && err.response ? err.response.data : {}
            console.log(this.error.message)
          }).finally(() => {
            this.isBusy = false
          })
      }
    },
    mounted () {
      this.handleSubmit()
    }
  },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    }
  }
}
</script>

<style scoped>

</style>
