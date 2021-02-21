<template>
  <div>
    <h1>Create Login</h1>
    <form @submit.prevent="submitForm">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input id="email" type="email" class="form-control" v-model.trim="$v.resident.email.$model"
                 :class="{'is-invalid':$v.resident.email.$error, 'is-valid':!$v.resident.email.$invalid }">
          <div class="valid-feedback" id="properEmail">Your email is valid!</div>
          <div class="invalid-feedback" id="improperEmail">
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
          <div class="valid-feedback" id="properPhoneNumber">Your phone number is valid!</div>
          <div class="invalid-feedback" id="improperPhone">
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
          <div class="valid-feedback" id="properPassword">Your password is valid!</div>
          <div class="invalid-feedback" id="improperPassword">
            <span v-if="!$v.resident.password.required">Password is required</span>
            <span v-if="!$v.resident.password.minLength">Password must be at least 7 characters! </span>
            <span v-if="!$v.resident.password.maxLength">Password can't be over 30 characters! </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="repeatPassword">Repeat Password</label>
          <input id="repeatPassword" type="password" class="form-control" v-model.trim="$v.resident.repeatPassword.$model"
                 :class="{'is-invalid':$v.resident.repeatPassword.$error, 'is-valid': (resident.password !== '') ? !$v.resident.repeatPassword.$invalid : '' }">
          <div class="valid-feedback" id="properRepeatedPassword">Your passwords are identical!</div>
          <div class="invalid-feedback" id="improperRepeatedPassword">
            <span v-if="!$v.resident.repeatPassword.sameAsPassword">Passwords must be identical!</span>
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
export default {
  name: 'CreateLogin',
  mixins: [ResidentMixin, validationMixin],
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
      url: '/points/'
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
              this.url += resp.data.id.toString()
              this.$router.push(this.url)
            }
          })
          .catch(err => {
            if (err.response.status === 404) {
              this.error = err && err.response ? err.response.data : {}
            }
          })
      }
    }
  }
}
</script>
