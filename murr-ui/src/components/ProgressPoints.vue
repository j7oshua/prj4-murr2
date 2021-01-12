<template>
  <div>
    <h2>Points: Number</h2>
  </div>
</template>

<script>
export default {
  name: 'ProgressPoints',
  props: {
    id: Number,
    residentid: Number,
    points: Number
  },
  data () {
    return {
      tempNum: null
    }
  },
  methods: {
    GetPoints () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
