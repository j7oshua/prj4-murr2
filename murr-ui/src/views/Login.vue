<template>
  <loginform>Create Login Page</loginform>
</template>

<script>
  import CreateLogin from '../components/CreateLogin'
  export default {
    name: 'CreateLogin',
    components: {
      loginform: CreateLogin
    },
    methods: {
      handleCreated(){
        throw new Error('Not Implemented')
      },
      callAPI (){
        throw new Error('Not Implemented')
      }
    }
  }
</script>

<style scoped>

</style>
