<template>
  <div>
    <!-- this is for the initial sign-in page -->
    <Login/>

    <!-- this is the redirected page to create a new resident user -->
    <CreateLoginForm></CreateLoginForm>
  </div>
</template>

<script>
// import the component
import CreateLogin from '@/components/CreateLogin'
import Login from '@/components/Login'

export default {
  // crates a names space for the component
  name: 'CreateLogin',
  components: {
    // creates a variable that references the component name space
    CreateLoginForm: CreateLogin,
    Login: Login,
  }
}
</script>

<style scoped>

</style>
