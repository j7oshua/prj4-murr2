<template>
  <div>
    Points Page!
  </div>
</template>
<script>
  import PointsComponent from '@/components/ProgressPoints'
  export default {
    name: 'Points',
    components: {PointsComponent},
  data () {
  return {
    id: Number,
    PointValue: Number,
    msg: String
  }
},
  computed: {
    refreshpage () {
      return 'Not Implemented'
    }
  },
  methods: {
    grabData () {
      throw new Error('Not Implemented')
    },
    grabError (errorparam1) {
      throw new Error('Not Implemented')
    }
  }
  }

</script>
<style scoped>
</style>
