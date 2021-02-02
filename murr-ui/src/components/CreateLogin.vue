<template>
  <div>
    <h1>Create Login</h1>
    <b-form @submit="saveResident" @reset="resetForm" v-if="show">
      <b-form-group
        id="emailInput"
        label="Email Address:"
        label-for="input-1"
        description="Your email will be kept private."
      >
        <b-form-input
          id="input-1"
          type="email"
          v-model="form.em"
          placeholder="Please enter your email here"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="phoneInput"
        label="Phone Number:"
        label-for="input-2"
        description="Your phone number will be kept private."
      >
        <b-form-input
          id="input-2"
          type="phone"
          v-model="form.pn"
          placeholder="Please enter your phone number here"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="passwordInput"
        label="Password:"
        label-for="input-3"
        description=""
      >
        <b-form-input
          id="input-3"
          type="password"
          v-model="form.pw"
          placeholder="Please a password"
          required
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Cancel</b-button>
    </b-form>
  </div>
</template>

<script>
/* import Vue from 'vue'
import Vuelidate from 'vuelidate' */

/* import VuelidateErrorExtractor, { templates } from 'vuelidate-error-extractor' */

/* Vue.use(Vuelidate)
 Vue.use(VuelidateErrorExtractor, {
  attributes: {
    email: 'Email',
    phone: 'Phone',
    password: 'Password'
  },
  messages: {
    required: '{attribute} is required.',
    maxLength: '{attribute} must be shorter than {limit} characters.',
    minLength: '{attribute} must be longer than {limit} characters.'
  }
}) */
export default {
  name: 'CreateLogin',
  props: {
    email: String,
    phone: String,
    password: String
  },
  data () {
    return {
      form: {
        em: '',
        pn: '',
        pw: ''
      },
      show: true,
      tempResident: {},
      error: {}
    }
  },
  /* validations: {
    tempResident: {
      email: {
        required: this.phone === '' || this.phone === null,
        maxLength: maxLength(150)
      },
      phone: {
        required: this.email === '' || this.email === null,
        minLength: minLength(10),
        maxLength: maxLength(10)
      },
      password: {
        required: true,
        minLength: minLength(7),
        maxLength: maxLength(30)
      }
    }
  }, */
  methods: {
    // postLogin () {
    //   throw new Error('Not Implemented')
    // },
    // checkPhone () {
    //   throw new Error('Not Implemented')
    // },
    // checkEmail () {
    //   throw new Error('Not Implemented')
    // },
    // checkPassword () {
    //   throw new Error('Not Implemented')
    // },
    // checkCreatedLogin () {
    //   throw new Error('Not Implemented')
    // }, /*
    // hashPassword () {
    //   throw new Error('Not Implemented')
    // }, */
    // errorMessage () {
    //   throw new Error('Not Implemented')
    // }
    saveResident: function () {
      //  clear validation messages if they are wrong
      //  might need this?
      //  this.error = {};

      this.callAPI('post', this.tempResident)
        .then(resp => {
          console.log(resp)
          this.tempResident = {}
          this.$emit('added', resp.data)
        })
        .catch(err => {
          console.log(err)
          this.err = err && err.response ? err.response.data : {}
        })
    },
    resetForm: function (event) {
      event.preventDefault()

      //Reset all the form values
      this.form.em = ''
      this.form.pn = ''
      this.form.pw = ''
    }
  }
}
</script>

<style scoped>

</style>
