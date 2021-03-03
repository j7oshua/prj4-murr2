<template>
  <div>
    <!-- TODO: Code for Story05 to be added here -->
  </div>
</template>

<script>
export default {
  name: 'DriverConfirms',
  // Prop pickupID is sent from the parent. Used in the API call.
  props: {
    pickUp: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      // Site is used to display site name within the HTML confirmation messages
      site: {
        site: 0,
        siteName: ''
      }, // Status code returned is used to display the appropriate messages
      respCode: 0
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints: {
      // TODO: Code for Story05
    },
    // User clicks the cancel button and the component is closed and returned to prev page
    cancel: {
      // TODO: Code for Story05
    },
    // Makes a call to the API to get the site name and display in the component
    getSite: {
      // TODO: Code for Story05
    }
  },
  // When component is loaded will load the site name in the confirmation message
  mounted () {
    // TODO: Code for Story05
  }
}
</script>

<style scoped>

</style>
