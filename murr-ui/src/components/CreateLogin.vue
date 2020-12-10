<template>
  <create-login>
    Login Form
  </create-login>
</template>

<script>
  import CreateLogin from '../components/CreateLogin'
  import Vuelidate from "vuelidate";
  import VuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

  Vue.use(Vuelidate);
  Vue.use(VuelidateErrorExtractor, {
    attributes: {
      email: "Email",
      phone: "Phone",
      password: "Password"
    },
    messages: {
      required: "{attribute} is required.",
      maxLength: "{attribute} must be shorter than {limit} characters.",
      minLength: "{attribute} must be longer than {limit} characters.",
    }
  })

  export default {
    name: 'CreateLogin',
    components: { CreateLogin },
    props: {
      Resident: Object,
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
        tempResident: {},
      }
    },
    validations: {
      tempResident: {
        email: {
          required: this.phone === '' || this.phone === null,
          maxLength: maxLength(150),
        },
        phone: {
          required: this.email === '' || this.email === null,
          minLength: minLength(10),
          maxLength: maxLength(10),
        },
        password: {
          required: true,
          minLength: minLength(7),
          maxLength: maxLength(30),
        }
      }
    },
    methods: {
      postLogin () {
        throw new Error('Not Implemented')
      },
      checkPhone () {
        throw new Error('Not Implemented')
      },
      checkEmail () {
        throw new Error('Not Implemented')
      },
      checkPassword () {
        throw new Error('Not Implemented')
      },
      checkCreatedLogin () {
        throw new Error('Not Implemented')
      },
      hashPassword () {
        throw new Error('Not Implemented')
      },
      errorMessage () {
        throw new Error('Not Implemented')
      }
    }
  }
</script>

<style scoped>

</style>
