<template>
  <div>
    Point Number!
  </div>
</template>

<script>
  export default {
  name: 'ProgressPoints',
  props: {
    id: Number,
    PointValue: Number,
    msg: String
  },
    data () {
      return {
        tempNum: null,
        tempText: null
      }
    },
  computed: {
    refreshpart () {
      return 'Not Implemented'
    }
  },
  methods: {
    assignAll (){
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
