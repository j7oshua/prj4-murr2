<template>
<div>
  <!-- Confirmation component that confirms the site to get points -->
  <confirm siteName="siteName" :pickUp="pickUp"></confirm>
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
      // *** PickupID needed for Story05 - pickupID is needed to be passed down to confirm component
      pickUp: {
        pickupID: 1,
        site: 1,
        numCollected: 5,
        numObstructed: 0,
        numContaminated: 0,
        dateTime: '2020-03-03'
      },
      // ***** Site name will be sent to SitePointsConfirmation component
      siteName: 'Wascana'
    }
  }
}

</script>

<style scoped>

</style>
