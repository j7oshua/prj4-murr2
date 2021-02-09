<template>
  <div>
    <h1>Create Login</h1>
    <form @submit.prevent="submitForm">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input id="email" type="email" class="form-control" v-model.trim="$v.resident.email.$model"
                 :class="{'is-invalid':$v.resident.email.$error, 'is-valid':!$v.resident.email.$invalid }">
          <div class="valid-feedback">Your email is valid!</div>
          <div class="invalid-feedback">
            <span v-if="!$v.resident.email.email">Email is not in proper format</span>
            <span v-if="!$v.resident.email.checkForEmailOrPhone">Email or Phone is required</span>
          </div>

        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="phone">Phone Number</label>
          <input id="phone" type="text" class="form-control" v-model.trim="$v.resident.phone.$model"
                 :class="{'is-invalid':$v.resident.phone.$error, 'is-valid':!$v.resident.phone.$invalid }">
          <div class="valid-feedback">Your phone number is valid!</div>
          <div class="invalid-feedback">
            <span v-if="!$v.resident.phone.checkForPhoneOrEmail">Email or Phone is required</span>
            <span v-if="!$v.resident.phone.numeric">Phone Number must contain only digits! </span>
            <span v-if="!$v.resident.phone.minLength">Phone Number must be 10 digits! </span>
            <span v-if="!$v.resident.phone.maxLength">Phone Number must be 10 digits! </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control" v-model.trim="$v.resident.password.$model"
                 :class="{'is-invalid':$v.resident.password.$error, 'is-valid':!$v.resident.password.$invalid }">
          <div class="valid-feedback">Your password is valid!</div>
          <div class="invalid-feedback">
            <span v-if="!$v.resident.password.required">Password is required</span>
            <span v-if="!$v.resident.password.minLength">Password must be at least 7 characters! </span>
            <span v-if="!$v.resident.password.maxLength">Password can't be longer then 30 characters! </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group form-check">
          <input type="checkbox" id="showPassword" class="form-check-input" @click="togglePassword" v-model="showPassword">
          <label class="form-check-label" for="showPassword">Show password</label>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="repeatPassword">Repeat Password</label>
          <input id="repeatPassword" type="password" class="form-control" v-model.trim="$v.resident.repeatPassword.$model"
                 :class="{'is-invalid':$v.resident.repeatPassword.$error, 'is-valid': (resident.password !== '') ? !$v.resident.repeatPassword.$invalid : '' }">
          <div class="valid-feedback">Your passwords are identical!</div>
          <div class="invalid-feedback">
            <span v-if="!$v.resident.repeatPassword.sameAsPassword">Passwords must be identical!</span>
            <span v-if="!$v.resident.repeatPassword.required"> Please re-enter your password.</span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
</template>

<script>
import ResidentMixin from '@/mixins/resident-mixin'
import { required, email, minLength, maxLength, numeric, sameAs } from 'vuelidate/lib/validators'
export default {
  name: 'CreateLogin',
  mixins: [ResidentMixin],
  data () {
    return {
      tempNewResident: {},
      error: {},
      resident: {
        email: '',
        phone: '',
        password: '',
        repeatPassword: ''
      },
      showPassword: false
    }
  },
  validations: {
    resident: {
      email: {
        checkForEmailOrPhone (value) {
          return value !== '' || this.resident.phone !== ''
        },
        email,
        maxLength: maxLength(150)
      },
      phone: {
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
        sameAsPassword: sameAs('password'),
        required
      }
    }
  },
  methods: {
    submitForm: function () {
      this.$v.$touch()
      if (!this.$v.$invalid) {
        this.tempNewResident = {
          email: this.resident.email,
          phone: this.resident.phone,
          password: this.resident.password
        }
        this.error = {}
        this.callAPI('post', this.tempNewResident)
          .then(resp => {
            if (resp.status === 201) {
              this.$emit('added', resp.data)
              console.log(resp.data)
            }
          })
          .catch(err => {
            if (err.response.status === 404) {
              this.error = err && err.response ? err.response.data : {}
            }
          })
      }
    },
    togglePassword () {
      const show = document.getElementById('password')
      if (this.showPassword === false) {
        this.showPassword = true
        show.type = 'text'
      } else {
        this.showPassword = false
        show.type = 'password'
      }
    }
  }
}
</script>

<style scoped>

</style>
