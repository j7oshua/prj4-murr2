<template>
  <div>
    CollectionSite
    <!-- do a modal -->
    <DriverPickUpModal @site-id="1" @site-name="Wascana" @num-bins="4" ></DriverPickUpModal>
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
