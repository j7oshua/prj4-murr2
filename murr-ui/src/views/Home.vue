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
        residentid: Number,
        points: Number
      }
    },
    methods: {
      CallPoints () { //send current resident id to component or call component to refresh get from database
        throw new Error('Not Implemented')
      }
    }
  }
</script>
