<template>
  <div>
    <!-- this is for the initial sign-in page -->
    <Login></Login>

    <!-- this is the redirected page to create a new resident user -->
    <CreateLoginForm></CreateLoginForm>
  </div>
</template>

<script>
// import the component
import CreateLogin from '@/components/CreateLogin'
import Login from '@/components/Login'
import axios from 'axios'

export default {
  // crates a names space for the component
  name: 'CreateLogin',
  components: {
    // creates a variable that references the component name space
    CreateLoginForm: CreateLogin,
    Login: Login
  },
  data () {
    return {
      user: null
    }
  },
  methods: {
    onUserAuthenticated (userUri) {
      axios.get(userUri)
        .then(response => (this.user = response.data))
    }
  }
}
</script>

<style scoped>

</style>
