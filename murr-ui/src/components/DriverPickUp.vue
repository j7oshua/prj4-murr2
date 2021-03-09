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
    siteObject: {
      type: Object
    }
  },
  data () {
    return {
      pickup: {
        id: '',
        numCollected: '',
        numObstructed: '',
        numContaminated: '',
        dateTime: '',
        siteObject: ''
      },
      error: {}
    }
  },

  validations: {
    pickup: {
      siteid: { // we will need to figure this one out
      },
      numCollected: {
        // some validation
      },
      numObstructed: {
        // some validation
      },
      numContaminated: {
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
