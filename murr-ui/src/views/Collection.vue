<template>
<div>
  <!-- Confirmation component that confirms the site to get points -->
  <confirm :pickup="pickUp"></confirm>
</div>
</template>

<script>
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
export default {
  name: 'Collection',
  components: {
    confirm: SitePointsConfirmation
  },
  data () {
    return {
      // Hardcoded Pickup object needed for Story05 - pickupID is needed to be passed down to child component
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
