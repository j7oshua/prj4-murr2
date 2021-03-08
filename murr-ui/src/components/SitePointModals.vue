<template>
  <div>
    <!-- Creating the different types of modals that will be used in the SitePointsConfirmation Component -->
    <slot name="confirm">
      <b-modal id="confirm" @hidden="handleHidden">
        <div slot="modal-title">
          <h1>Confirm Point Addition To {{siteName}}</h1>
        </div>
        <div>
          <p class="message">Do you confirm {{pickUp.numCollected}} was collected from </p>
        </div>
        <div slot="modal-footer">
        </div>
      </b-modal>
    </slot>
    <slot name="noPickupID">
      <b-modal id="noPickupID">
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
    }
  }
}
</script>

<style scoped>

</style>
