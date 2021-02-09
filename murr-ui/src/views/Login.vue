<template>
  <div>
    <!-- this is for the initial sign-in page -->
   <!-- <loginForm /> -->

    <!-- this is the redirected page to create a new resident user -->
    <CreateLoginForm ref="CreateLogin"  />
  </div>
</template>

<script>
import CreateLogin from '@/components/CreateLogin'
export default {
  name: 'CreateLogin',
  components: {
    CreateLoginForm: CreateLogin
  },
  methods: {
    handleCreated () {
      // if creation was successful we need to redirect to the user points page
      // ** ASk Josh about directional routing here ??
      // does it go here or index?
      // throw new Error('Not Implemented')
    },
    callAPI () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
