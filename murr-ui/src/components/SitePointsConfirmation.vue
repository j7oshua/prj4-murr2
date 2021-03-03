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
    },
    siteName: {
      type: String,
      required: true
    }
  },
  data () {
    return {
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
    }
  }
}
</script>

<style scoped>

</style>
