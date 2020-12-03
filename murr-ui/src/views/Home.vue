<template>
  <div class="home">
    <div>
    Point component
    </div>
  </div>
</template>

<script>
  import PointsComponent from '@/components/ProgressPoints'
  export default {
    name: 'Home',
    components: {PointsComponent},
    data () {
      return {
        id: Number,
        PointValue: Number
      }
    },
    computed: {
      refreshpage () {
        return 'Not Implemented'
      }
    },
    methods: {
      GETPoints (idparams) {
        throw new Error('Not Implemented')
      }
    }
  }
</script>
