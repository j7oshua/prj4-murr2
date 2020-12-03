<template>
  <div>Login Form</div>
</template>

<script>
  import CreateLogin from '../components/CreateLogin'
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
        dt:{
          em: 'Email',
          pn: 'Phone Number',
          pw: 'Password'
        },
        tempResident:{},
        tempEmail: null,
        tempPhone: null,
        tempPassword: null
      }
    },
    validations: {
      tempResident: {
        email: {
          required: this.phone === '' || this.phone === null,
          maxLength: maxLength(150),
          maxMessage: 'Invalid email entered, email must be less than 150 characters, please try again.',
          email: 'Invalid email entered, please try again.'
        },
        phone: {
          required: this.email === '' || this.email === null,
          minLength: minLength(10),
          minMessage: 'Phone number must be 10 digits.',
          maxLength: maxLength(10),
          maxMessage: 'Phone number must be 10 digits.'
        },
        password: {
          required: true,
          requiredMessage: 'Must enter a password.',
          minLength: minLength(7),
          minMessage: 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters',
          maxLength: maxLength(30),
          maxMessage: 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
        }
      }
    },
    methods: {
      postLogin (){
        throw new Error('Not Implemented')
      },
      isValidPhone (){
        throw new Error('Not Implemented')
      },
      isValidEmail (){
        throw new Error('Not Implemented')
      },
      isValidPassword (){
        throw new Error('Not Implemented')
      },
      isValidCreatedLogin () {
        throw new Error('Not Implemented')
      },
      hashPassword (){
        throw new Error('Not Implemented')
      },
      errorMessage (){
        throw new Error('Not Implemented')
      }
    }
  }
</script>

<style scoped>

</style>
