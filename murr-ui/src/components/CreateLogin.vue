<template>
  <div>
    <h1>Create Login</h1>
    <b-form>
      <b-form-group
        id="emailInput"
        label="Email Address:"
        label-for="input-1"
        description="Your email will be kept private."
      >
        <b-form-input
          id="input-1"
          type="email"
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
      dt: {
        em: 'Email',
        pn: 'Phone Number',
        pw: 'Password'
      },
      tempResident: {}
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
  }
}
</script>

<style scoped>

</style>
