<template>
  <div class="home">
    <div>
    <PointsComponent></PointsComponent>
    </div>
  </div>
</template>

<script>
  import PointsComponent from '@/components/ProgressPoints'
  export default {
    name: 'Home',
    components: PointsComponent
  }
</script>
