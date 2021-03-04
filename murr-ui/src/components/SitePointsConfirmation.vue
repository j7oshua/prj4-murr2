<template>
  <div>
    <b-overlay :show="isDisabled">
      <b-modal id="confirm" header-bg-variant="primary" header-text-variant="light" title="Confirm Points" hide-footer>
        <b-container>
          <b-row class="mb-1">
          </b-row>
          <button @click="cancel">Cancel</button>
        </b-container>
      </b-modal>
    </b-overlay>
  </div>
</template>

<script>
import ResidentPointMixin from '@/mixins/resident-point-mixin'
export default {
  name: 'DriverConfirms',
  mixins: [ResidentPointMixin],
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
      displayCode: 0,
      respCode: 0,
      isBusy: false
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints () {
      // TODO: Code for Story05
    },
    // User clicks the cancel button and the component is closed and returned to prev page
    cancel () {
      this.$emit('finished')
      this.$bvModal.hide('confirm')
    }
  },
  mounted () {
    this.$bvModal.show('confirm')
  },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    }
  }
}
</script>

<style scoped>

</style>
