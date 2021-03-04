<template>
<div>
  <h1>Collection Page</h1>
  <!-- Confirmation component that confirms the site to get points -->
  <div v-if="loadConfirm">
    <confirm :siteName="siteName" :pickUp="pickUp" @finished="confirmFinished"></confirm>
  </div>
  <button @click="confirmPoints">Confirm</button>
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
      siteName: 'Wascana',
      loadConfirm: false
    }
  },
  methods: {
    // Hides modal when the SitePointsConfirmation component is finished
    confirmFinished () {
      this.loadConfirm = false
    },
    // This is for the API call. ***this.loadConfirm should be called in the .finally() of the call to the API
    confirmPoints () {
      this.loadConfirm = true
    }
  }
}

</script>

<style scoped>

</style>
