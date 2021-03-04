<template>
  <div>
    <b-overlay :show="isDisabled">
      <b-modal v-if="displayCode === 1"
        id="confirm" header-bg-variant="primary" header-text-variant="light" :title="title"
      footer-bg-variant="primary" footer-text-variant="light">
        <b-container>
          <b-row class="mb-1">
            <b-col><b-icon icon="trash-fill" scale="3"></b-icon> </b-col>
            <b-col id="message">Do you confirm {{pickUp.numCollected}} containers were collected from {{siteName}}? </b-col>
          </b-row>
          <template #modal-footer>
            <b-row class="mb-1">
              <button @click="cancel">Cancel</button>
            </b-row>
          </template>
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
      displayCode: 1,
      respCode: 0,
      isBusy: false,
      title: ''
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
    },
    // Calls the API to check to see if the pickupID exists
    checkPickupID () {
      // TODO: Code for Story05
    }
  },
  mounted () {
    if (this.siteName !== null) {
      this.title = 'Confirm Points to ' + this.siteName
    }
    this.checkPickupID()
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
