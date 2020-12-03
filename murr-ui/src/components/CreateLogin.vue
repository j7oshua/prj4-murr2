<template>
  <div>Login Form</div>
</template>

<script>
  import CreateLogin from '../components/CreateLogin'
  export default {
    name: 'CreateLogin',
    components: { CreateLogin },
    props: {
      id: Number,
      email: String,
      phone: String,
      password: String
    },
    data () {
      return {
        tempEmail: null,
        tempPhone: null,
        tempPassword: null
      }
    },
    methods: {
      postLogin (){
        throw new Error('Not Implemented')
      },
      callAPI (){
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
      },
      handleCreated () {
        throw new Error('Not Implemented')
      }
    }
  }
</script>

<style scoped>

</style>
