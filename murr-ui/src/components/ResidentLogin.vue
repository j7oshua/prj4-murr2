<template>
  <div>

  </div>
</template>

<script>
import ResidentMixin from "../mixins/resident-mixin";

export default {
  name: 'ResidentLogin',
  mixins: [ResidentMixin],
  props: {
    resident: {
      type: Object
    }
  },
  data() {
    return {
      tempResident: {}
    }
  },
  methods: {
    residentSignIn() {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
