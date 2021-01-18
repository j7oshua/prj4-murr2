<template>
  <div class="home">
    <div>
      <PointsComponent>test</PointsComponent>
    </div>
  </div>
</template>

<script>
import PointsComponent from '@/components/ProgressPoints.vue'
export default {
  name: 'Home',
  components: PointsComponent
}
</script>
