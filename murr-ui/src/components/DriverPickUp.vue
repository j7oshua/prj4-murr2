<template>
<div>some details</div>
</template>

<script>
export default {
  name: 'DriverSiteReport',
  props: {
    SiteID: {
      type: Number
    },
    SiteName: {
      type: String
    }
  },
  data () {
    return {
      pickup: {
        siteid: '',
        collected: '',
        obstructed: '',
        contaminated: ''
      },
      error: {}
    }
  },

  validations: {
    pickup: {
      siteid: {
      },
      collected: {
        // some validation
      },
      obstructed: {
        // some validation
      },
      contaminated: {
        // some validation
      }
    }
  },
  methods: {
    postPickup: function () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
