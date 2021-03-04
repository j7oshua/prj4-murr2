<template>
  <div>
    <b-overlay :show="isDisabled">
      <b-modal v-if="displayCode === 1"
        id="modal-scoped" header-bg-variant="primary" header-text-variant="light" :title="title"
      footer-bg-variant="primary" footer-text-variant="light">
        <b-container>
          <b-row class="mb-1">
            <b-col><b-icon icon="trash-fill" scale="3"></b-icon> </b-col>
            <b-col id="message">Do you confirm {{pickUp.numCollected}} containers were collected from {{siteName}}? </b-col>
          </b-row>
          <template v-slot:modal-footer="{ yes, cancel }">
            <b-row class="mb-1">
              <b-button @click="cancel">asdfl</b-button>
            </b-row>
          </template>
        </b-container>
      </b-modal>
    </b-overlay>
  </div>
</template>

<script>
import MurrMixin from '@/mixins/murr-mixin'
import SitePointMixin from '@/mixins/site-point-mixin';
export default {
  name: 'DriverConfirms',
  mixins: [MurrMixin, SitePointMixin],
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
      this.isBusy = true
      this.callAPI('post', this.pickUp.pickupID, this.SITE_POINT_API_URL + this.pickUp.site)
        .then(resp => {
          this.respCode = resp.status
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 400) {
            this.respCode = err.response.status
          } else if (err.response.status === 404) {
            this.respCode = err.response.status
          }
        })
        .finally(() => {
          this.isBusy = false
        })
    },
    // User clicks the cancel button and the component is closed and returned to prev page
    cancel () {
      this.$emit('finished')
      this.$bvModal.hide('modal-scoped')
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
    this.$bvModal.show('modal-scoped')
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
