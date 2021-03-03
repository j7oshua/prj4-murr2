<template>
<div>some details</div>
</template>

<script>
export default {
  name: 'DriverSiteReport',
  props: {
    SiteNum: {
      type: Number
    },
    numCollected: {
      type: Number
    },
    numObstructed: {
      type: Number
    },
    numContaminated: {
      type: Number
    },
    dateTime: {
      type: Date
    },
    pickup: {
      collected: '',
      obstructed: '',
      contaminated: '',
      date: ''
    },
    tempPickup: {},
    error: {}
  },
  validations: {
    pickup: {
      collected: {
        // some validation
      },
      obstructed: {
        // some validation
      },
      contaminated: {
        // some validation
      },
      date: {
        // some validation
      }
    }
  },
  methods: {
    submitReport () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
