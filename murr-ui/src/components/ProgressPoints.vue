<template>
  <div>
    <h2>Points: {{ tempNum }}</h2>
  </div>
</template>

<script>
export default {
  name: 'ProgressPoints',
  props: {
    residentid: Number,
    points: Number
  },
  data () {
    return {
      tempNum: null,
      tempResId: null
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
