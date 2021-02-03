<template>
  <div class="home">
    <div>
      <PointsComponent></PointsComponent>
    </div>
  </div>
</template>

<script>
import PointsComponent from '../components/ResidentPoints'

export default {
  name: 'Home',
  components: {
    PointsComponent
  }
}
</script>
