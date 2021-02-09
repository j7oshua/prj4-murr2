<template>
  <div>
<!--   email or phone login field    -->
<!--   password field  -->
<!--   confirm login button    -->
  </div>
</template>

<script>
import ResidentMixin from '../mixins/resident-mixin'

export default {
  name: 'ResidentLogin',
  mixins: [ResidentMixin],
  props: {
    resident: {
      type: Object
    }
  },
  data () {
    return {
      tempResident: {},
      badLogin: false
    }
  },
  methods: {
    residentSignIn () {
      //Would call api with a get sending tempCustomer login info and password
      //If completes then sends to resident page
      //Would call bad login if get fails
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
