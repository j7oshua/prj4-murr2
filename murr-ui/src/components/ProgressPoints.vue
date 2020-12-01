<template>
  <vue-ellipse-progress
    :progress="PointValue"
    :half="true"
    color="green"
    emptyColor="white" >
  <p slot="legend-caption">{{ msg }}</p>
  </vue-ellipse-progress>
</template>

<script>export default {
  name: 'PointsPage',
  props: {
    PointValue: Number,
    msg: String
  }
}
</script>

<style scoped>

</style>
