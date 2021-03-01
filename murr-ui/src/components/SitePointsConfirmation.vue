<template>
  <div>
    <!-- Code for Story05 to be added here -->
  </div>
</template>

<script>
export default {
  name: 'DriverConfirms',
  // Prop pickupID is sent from the parent. Used in the API call.
  props: {
    pickup: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      // Site is used to display site name within the HTML confirmation messages
      site: {
        siteID: 0,
        siteName: ''
      },
      resp: 0
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints: {
    },
    // User cancels and the modal is closed
    cancel: {
    },
    // Makes a call to the API to get the site name
    getSite: {
    }
  },
  // When component is loaded will load the site name in the confirmation message
  mounted () {
  }
}
</script>

<style scoped>

</style>
