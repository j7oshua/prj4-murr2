<template>
  <div>
    <h1>Create Login</h1>
    <!-- The form input -->
    <form @submit.prevent="submitForm">
      <div class="form-row">
        <!-- email input box -->
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input id="email" type="email" class="form-control" v-model.trim="$v.resident.email.$model"
                 :class="{'is-invalid':$v.resident.email.$error, 'is-valid':!$v.resident.email.$invalid }">
         <!-- vuelidate  valid feedback -->
          <div class="valid-feedback" id="properEmail">Your email is valid!</div>
          <!-- vuelidate  invalid feedback -->
          <div class="invalid-feedback" id="improperEmail">
            <!-- feedback error message for improper format -->
            <span v-if="!$v.resident.email.email">Email is not in proper format</span>
            <!-- feedback error message for blank input -->
            <span v-if="!$v.resident.email.checkForEmailOrPhone">Email or Phone is required</span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- phone number input box -->
        <div class="form-group col-md-6">
          <label for="phone">Phone Number</label>
          <input id="phone" type="text" class="form-control" v-model.trim="$v.resident.phone.$model"
                 :class="{'is-invalid':$v.resident.phone.$error, 'is-valid':!$v.resident.phone.$invalid }">
          <!-- vuelidate  valid feedback -->
          <div class="valid-feedback" id="properPhoneNumber">Your phone number is valid!</div>
          <!-- vuelidate  invalid feedback -->
          <div class="invalid-feedback" id="improperPhone">
            <!-- feedback error message for checking if there is an email or phone number -->
            <span v-if="!$v.resident.phone.checkForPhoneOrEmail">Email or Phone is required</span>
            <!-- feedback error message for only containing digits -->
            <span v-if="!$v.resident.phone.numeric">Phone Number must contain only digits! </span>
            <!-- feedback error message for improper phone numbers less the 10 -->
            <span v-if="!$v.resident.phone.minLength">Phone Number must be 10 digits! </span>
            <!-- feedback error message for improper phone numbers more than 10 -->
            <span v-if="!$v.resident.phone.maxLength">Phone Number must be 10 digits! </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- password input box -->
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control" v-model.trim="$v.resident.password.$model"
                 :class="{'is-invalid':$v.resident.password.$error, 'is-valid':!$v.resident.password.$invalid }">
          <!-- vuelidate  valid feedback -->
          <div class="valid-feedback" id="properPassword">Your password is valid!</div>
          <!-- vuelidate  invalid feedback -->
          <div class="invalid-feedback" id="improperPassword">
            <!-- feedback error message for blank passwords -->
            <span v-if="!$v.resident.password.required">Password is required</span>
            <!-- feedback error message for improper passwords are less than 7 characters -->
            <span v-if="!$v.resident.password.minLength">Password must be at least 7 characters! </span>
            <!-- feedback error message for improper are greater than 30 characters -->
            <span v-if="!$v.resident.password.maxLength">Password can't be over 30 characters! </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <!-- repeat password input box -->
        <div class="form-group col-md-6">
          <label for="repeatPassword">Repeat Password</label>
          <input id="repeatPassword" type="password" class="form-control" v-model.trim="$v.resident.repeatPassword.$model"
                 :class="{'is-invalid':$v.resident.repeatPassword.$error, 'is-valid': (resident.password !== '') ? !$v.resident.repeatPassword.$invalid : '' }">
          <!-- vuelidate  valid feedback -->
          <div class="valid-feedback" id="properRepeatedPassword">Your passwords are identical!</div>
          <!-- vuelidate  invalid feedback -->
          <div class="invalid-feedback" id="improperRepeatedPassword">
            <!-- feedback error message for un-matching passwords -->
            <span v-if="!$v.resident.repeatPassword.sameAsPassword">Passwords must be identical!</span>
            <!-- feedback error message for blank repeats-->
            <span v-if="!$v.resident.repeatPassword.required"> Please re-enter your password</span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
</template>

<script>
import ResidentMixin from '@/mixins/resident-mixin'
import { validationMixin } from 'vuelidate'
import { required, email, minLength, maxLength, numeric, sameAs } from 'vuelidate/lib/validators'
import axios from 'axios'
export default {
  name: 'CreateLogin',
  mixins: [ResidentMixin, validationMixin],
  data () {
    return {
      // variables
      tempNewResident: {},
      // ******** Used for login after creation ************
      loginResident: {
        username: '',
        password: ''
      },
      error: {},
      resident: {
        email: '',
        phone: '',
        password: '',
        repeatPassword: ''
      },
      url: '/points'
    }
  },

  validations: { // validation requirements for the vuelidate to work
    // all requirements that a resident objects needs for input fields
    resident: {
      email: { // custom function to check that either a phone or email has been entered
        checkForEmailOrPhone (value) {
          return value !== '' || this.resident.phone !== ''
        },
        email,
        maxLength: maxLength(150)
      },
      phone: { // custom function to check that either a phone or email has been entered
        checkForPhoneOrEmail (value) {
          return value !== '' || this.resident.email !== ''
        },
        minLength: minLength(10),
        maxLength: maxLength(10),
        numeric
      },
      password: {
        required,
        minLength: minLength(7),
        maxLength: maxLength(30)
      },
      repeatPassword: {
        // must match the first password object
        sameAsPassword: sameAs('password'),
        required
      }
    }
  },
  methods: {
    submitForm: function () { // submits the form to the database and creates the login
      this.$v.$touch()
      // if all fields that have input in them are valid

      if (!this.$v.$invalid) {
        // temp place holder that holds all the inputted information
        this.tempNewResident = {
          email: this.resident.email,
          phone: this.resident.phone,
          plainPassword: this.resident.password
        }
        this.error = {}
        // call the function from the resident mixin
        // method type is a post
        // data information is from tempResident
        this.callAPI('post', this.tempNewResident)
          .then(resp => {
            // if response status equals 201
            if (resp.status === 201) {
              // this is the redirect to point page if the login is successful
              // add onto url response data.id to string (this would be the resident id added on to url)
              // this.url += resp.data.id.toString()
              // have the router push the points page
              // this.$router.push(this.url)
            }
          })
          .catch(err => {
            // if response code equals 404
            if (err.response.status === 404) {
              // send error message
              this.error = err && err.response ? err.response.data : {}
            }
          }).finally(() => {
            // ************* Trying out to login resident after creation, may have to delete **************************
            if (this.tempNewResident.email != null) {
              this.loginResident.username = this.tempNewResident.email
            } else {
              this.loginResident.username = this.tempNewResident.phone
            }
            this.loginResident.password = this.tempNewResident.plainPassword
            console.log(this.loginResident)
            axios.post('http://127.0.0.1:8000/login', {
              username: this.loginResident.username,
              password: this.loginResident.password
            }, {
              headers: {
                Authorization: 'Bearer ' + sessionStorage.getItem('token')
              }
            })
              .then(response => {
                sessionStorage.setItem('token', response.data.token)
                sessionStorage.setItem('id', response.data.data.id)
                this.username = ''
                this.password = ''
              }).catch(error => {
                if (error.response) {
                  // this.error = error.response
                } else {
                  // this.error = 'Unknown error'
                }
              }).finally(() => {
                this.isBusy = false
                this.$router.push(this.url)
              })
          })
      }
    }
  }
}
</script>
