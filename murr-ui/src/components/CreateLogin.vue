<template>
  <div>
    <h1>Create Login</h1>
    <b-form @submit="saveResident" @reset="resetForm" v-if="show">
      <b-form-group :state="state.em" :invalid-feedback="error.email"
        id="emailInput"
        label="Email Address:"
        label-for="input-1"
        description=""
      >
        <b-form-input :state="state.em"
          id="input-1"
          type="email"
          v-model="form.em"
          placeholder="Please enter your email here"
        ></b-form-input>
      </b-form-group>

      <b-form-group :state="state.pn" :invalid-feedback="error.phone"
        id="phoneInput"
        label="Phone Number:"
        label-for="input-2"
        description=""
      >
        <b-form-input :state="state.pn"
          id="input-2"
          type="phone"
          v-model="form.pn"
          placeholder="Please enter your phone number here"
        ></b-form-input>
      </b-form-group>

      <b-form-group :state="state.pw" :invalid-feedback="error.password"
        id="passwordInput"
        label="Password:"
        label-for="input-3"
        description="Must contain Letters and numbers"
      >
        <b-form-input :state="state.pw"
          id="input-3"
          type="password"
          v-model="form.pw"
          placeholder="Please enter a password"
          required
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary" @click.stop.prevent="saveResident">Submit</b-button>
      <b-button type="reset" variant="danger">Cancel</b-button>
    </b-form>
  </div>
</template>

<script>
/*
import Vue from 'vue'
Vue.use({
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
import ResidentMixin from '@/mixins/resident-mixin'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
export default {
  name: 'CreateLogin',
  mixins: [ResidentMixin],
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
  validations: {
    em: {
      required, // this.pn === '' || this.pn === null,
      maxLength: maxLength(150)
    },
    pn: {
      required, // this.em === '' || this.em === null,
      minLength: minLength(10),
      maxLength: maxLength(10)
    },
    pw: {
      required,
      minLength: minLength(7),
      maxLength: maxLength(30)
    }
  },
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
          this.$router.push('/points')
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 400) {
            this.error = err.response.data
            console.log(this.error)
            console.log(this.error.violations[0].message)
          }
        })
    },
    resetForm: function (event) {
      event.preventDefault()

      // Reset all the form values
      this.form.em = ''
      this.form.pn = ''
      this.form.pw = ''
    }
  },
  computed: {
    state: function () {
      return {
        em: this.error.email ? false : null,
        pn: this.error.phone ? false : null,
        pw: this.error.password ? false : null
      }
    }
  }
}
</script>

<style scoped>

</style>
