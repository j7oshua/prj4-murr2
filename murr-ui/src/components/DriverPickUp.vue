<template>
<div>
  <b-modal v-model="showPickUpForm" >
    <form ref="form">
      //replace form group
      <form-group
        label="Site Name">
      </form-group>
      <form-group
        label="Collected"
        label-for="collectedInput"
    </form>
  </b-modal>
</div>
</template>

<script>
export default {
  name: 'DriverSiteReport',
  props: {
    siteObject: { // not sure if this is correct
    }
  },
  data () {
    return {
      pickup: {
        pickupid: '',
        siteid: '',
        collected: '',
        obstructed: '',
        contaminated: '',
        dateTime: '',
        siteObject: ''
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
