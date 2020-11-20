<template>
  <vue-ellipse-progress
    :data="circles"
    :progress="progress"
    :angle="-90"
    color="blue"
    :colorFill="colorFillGradient"
    emptyColor="#8ec5fc"
    :emptyColorFill="emptyColorFillGradient"
    :size="300"
    :thickness="10"
    emptyThickness="10%"
    lineMode="in 10"
    :legend="true"
    :legendValue="180"
    legendClass="legend-custom-style"
    dash="60 0.9"
    animation="reverse 700 400"
    :noData="false"
    :loading="false"
    fontColor="white"
    :half="false"
    :gap="10"
    dot="10 blue"
    fontSize="5rem">

    <span slot="legend-value">/200</span>
    <p slot="legend-caption">GOOD JOB</p>

  </vue-ellipse-progress>
</template>

<script>
    export default {
        name: "TestCircle"
    }
</script>

<style scoped>

</style>
