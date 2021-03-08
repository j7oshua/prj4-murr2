<template>
  <div>
    <!-- Creating the different types of modals that will be used in the SitePointsConfirmation Component -->
    <slot name="confirm">
      <b-modal id="confirm" @hidden="handleHidden">
        <div slot="modal-title">
          <h1>Confirm Point Addition To {{siteName}}</h1>
        </div>
        <div>
          <p class="message">Do you confirm {{pickUp.numCollected}} was collected from {{siteName}}</p>
        </div>
        <div slot="modal-footer">
          <b-button @click="handleAPI">Yes</b-button>
          <b-button @click="handleHidden">Cancel</b-button>
        </div>
      </b-modal>
    </slot>
    <slot name="noPickupID">
      <b-modal id="noPickupID">
        <div slot="modal-title">
          <h1>Error</h1>
        </div>
        <div>
          <p class="errorMessage">Pickup ID: {{pickUp.pickupID}} was not found</p>
        </div>
        <div slot="modal-footer">
          <b-button @click="handleHidden">Ok</b-button>
        </div>
      </b-modal>
    </slot>
    <slot name="successPointsAdded">
      <b-modal id="successPointsAdded">
      </b-modal>
    </slot>
    <slot name="successNoPointsAdded">
      <b-modal id="successNoPointsAdded">
      </b-modal>
    </slot>
    <slot name="error">
      <b-modal id="error">
      </b-modal>
    </slot>
  </div>
</template>

<script>
export default {
  name: 'SitePointModals',
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
  methods: {
    handleHidden () {
      this.$emit('finished')
    },
    handleAPI () {
      this.$emit('callAPI')
    }
  }
}
</script>

<style scoped>

</style>
