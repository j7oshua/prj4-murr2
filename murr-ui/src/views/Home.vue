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
      CallPoints () { //send current resident id
        throw new Error('Not Implemented')

        //if null returned or 404 error then display 0
      }
    }
  }
</script>
