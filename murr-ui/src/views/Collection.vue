<template>
<div>
  <DriverConfirms :pickupID="pickUp.pickupID"></DriverConfirms>
</div>
</template>

<script>
import DriverConfirms from '@/components/DriverConfirms'
export default {
  name: 'Collection',
  components: {
    DriverConfirms: DriverConfirms
  },
  data () {
    return {
      pickUp: {
        pickupID: 1,
        siteID: 1,
        numCollected: 5,
        numObstructed: 0,
        numContaminated: 0,
        date: '24-02-2021'
      }
    }
  }
}

</script>

<style scoped>

</style>
