<template>
  <div>
    <!-- this is for the initial sign-in page -->
   <!-- <loginForm /> -->

    <!-- this is the redirected page to create a new resident user -->
    <CreateLoginForm></CreateLoginForm>
  </div>
</template>

<script>
import CreateLogin from '@/components/CreateLogin'
export default {
  name: 'CreateLogin',
  components: {
    CreateLoginForm: CreateLogin
  }
}
</script>

<style scoped>

</style>
