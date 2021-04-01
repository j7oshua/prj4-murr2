<template>
  <div>
    <!-- this is for the initial sign-in page -->
   <!-- <loginForm /> -->

    <!-- this is the redirected page to create a new resident user -->
    <CreateLoginForm></CreateLoginForm>
  </div>
</template>

<script>
// import the component
import CreateLogin from '@/components/CreateLogin'

export default {
  // crates a names space for the component
  name: 'CreateLogin',
  components: {
    // creates a variable  that references the component name space
    CreateLoginForm: CreateLogin
  }
}
</script>

<style scoped>

</style>
