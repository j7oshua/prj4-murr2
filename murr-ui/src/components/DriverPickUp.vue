<template>
  <div>
    <!-- Confirmation component that confirms the site to get points. Used in Story05 -->
    <confirm :showModal="showModal" :siteName="siteName" :pickUp="pickup" @finished="confirmFinished"></confirm>
    <!-- **********This button can be merged into the button for story03 postPickup button ************** -->
    <button @click="postPickup">Submit</button>
  </div>
</template>

<script>
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
export default {
  name: 'DriverPickUp',
  components: {
    confirm: SitePointsConfirmation
  },
  data () {
    return {
      // ***PickupObject needed for Story05 - pickup Object with pickupID and siteId is needed to be passed down to confirm component
      pickup: {
        pickupID: 1,
        siteId: 1,
        numCollected: 5,
        numObstructed: 0,
        numContaminated: 0,
        dateTime: '2021-01-01'
      },
      // ********* Site name will be sent to SitePointsConfirmation component. Used to demonstrate story. Can be removed
      // as long as the siteName from the props is sent to the confirm component. ***************************
      siteName: 'Brighton',
      showModal: false
    }
  },
  methods: {
    // Hides modal when the SitePointsConfirmation component is finished
    confirmFinished () {
      this.showModal = false
    },
    // ********* This is for the API call. ***this.showModal should be called in the .finally() of the call to the API
    // After the $emit('finished') of Story3 **********************************
    postPickup () {
      this.showModal = true
    }
  }
}

</script>

<style scoped>

</style>
