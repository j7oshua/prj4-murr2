<template>
  <div>
    <h1>Collection Page</h1>
    <!-- Confirmation component that confirms the site to get points -->
    <confirm :showModal="showModal" :siteName="siteName" :pickUp="pickUp" @finished="confirmFinished"></confirm>
    <button @click="confirmPoints">Submit</button>
  </div>
</template>

<script>
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
export default {
  name: 'DriverPickup',
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
      showModal: false
    }
  },
  methods: {
    // Hides modal when the SitePointsConfirmation component is finished
    confirmFinished () {
      this.showModal = false
    },
    // This is for the API call. ***this.showModal should be called in the .finally() of the call to the API
    // this.$bvToast.toast should be placed in the .catch part of the call to the API to display the pickupID error
    confirmPoints () {
      this.$bvToast.toast('Pickup ID: ' + this.pickUp.pickupID + ' was not found', {
        title: 'Error: Bad Request',
        variant: 'danger',
        toaster: 'b-toaster-top-center',
        noAutoHide: true
      })
      this.showModal = true
    }
  }
}

</script>

<style scoped>

</style>
