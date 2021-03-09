<template>
  <div>
    <b-overlay :show="isDisabled">
      <div v-if="pickupIDExists">
        <b-modal @ok="confirmPoints" v-model="showModal" @hidden="handleHidden">
          <div slot="modal-title">
            <h4>Confirm Point Addition to {{siteName}}</h4>
          </div>
          <p class="message">Do you confirm {{pickUp.numCollected}} containers were collected from {{ siteName }}?</p>
        </b-modal>
      </div>
      <div v-else>
      </div>
    </b-overlay>
  </div>
</template>

<script>
import MurrMixin from '@/mixins/murr-mixin'
import SitePointMixin from '@/mixins/site-point-mixin'

export default {
  name: 'DriverConfirms',
  mixins: [MurrMixin, SitePointMixin],
  // Prop pickupID is sent from the parent. Used in the API call.
  props: {
    pickUp: {
      type: Object,
      required: true
    },
    showModal: {
      type: Boolean,
      required: true
    }, // Site name prop used to display site name in the modals
    siteName: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      displayCode: 3,
      respCode: 0,
      isBusy: false,
      pickupIDExists: true,
      message: ''
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints () {
      this.isBusy = true
      this.callAPI('post', this.pickUp.pickupID, this.SITE_POINT_API_URL + this.pickUp.site)
        .then(resp => {
          this.respCode = resp.status
          this.message = resp.body.content
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
    // Calls the API to check to see if the pickupID exists
    checkPickupID () {

    },
    handleHidden () {
      this.$emit('finished')
    }
  },
  mounted () {
    // When component is first rendered, want to check to see if the pickupID exists.
    this.checkPickupID()
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
