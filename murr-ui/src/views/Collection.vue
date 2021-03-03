<template>
<div>
  <!-- Confirmation component that confirms the site to get points -->
  <confirm :pickupID="pickUp.pickupID"></confirm>
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
        pickupID: 1
      }
    }
  }
}

</script>

<style scoped>

</style>
