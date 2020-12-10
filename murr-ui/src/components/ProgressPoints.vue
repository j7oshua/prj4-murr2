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
        tempNum: null //used for placeholder
      }
    },
    methods: {
      GetPoints(){ //grab points from database based of resident id or url router index
        throw new Error('Not Implemented')

        //if null returned or 404 error then display 0
      }
    }
  }
</script>

<style scoped>

</style>
