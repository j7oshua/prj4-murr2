<template>
  <div>
    CollectionSite
    <!-- do a modal -->
    <DriverPickUpModal></DriverPickUpModal>
  </div>
</template>

<script>
import DriverPickUp from '@/components/DriverPickUp'

export default {
  name: 'DriverCollection',
  components: { DriverPickUpModal: DriverPickUp }
}
</script>

<style scoped>

</style>
