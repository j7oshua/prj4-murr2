<template>
  <div>Create Login Page</div>
  <loginform></loginform>
</template>

<script>
  import CreateLogin from '../components/CreateLogin'
  export default {
    name: 'CreateLoginForm',
    components: {
      loginform: CreateLogin
    },
    methods: {
      handleCreated(){
        throw new Error('Not Implemented')
      }
    }
  }
</script>

<style scoped>

</style>
