<template>
  <div>
    <h1>Hello</h1>
    <loginForm></loginForm>
  </div>
</template>

<script>
import CreateLogin from '@/components/CreateLogin'
export default {
  name: 'CreateLogin',
  components: {
    loginForm: CreateLogin
  },
  methods: {
    handleCreated () {
      throw new Error('Not Implemented')
    },
    callAPI () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
