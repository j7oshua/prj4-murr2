<template>
  <div>
    <b-overlay :show="isDisabled">
      <b-modal @ok="confirmPoints" v-model="showModal" @hidden="handleHidden">
        <div slot="modal-title">
          <h4>Confirm Point Addition to {{siteName}}</h4>
        </div>
        <p class="message">Do you confirm {{pickUp.numCollected}} containers were collected from {{ siteName }}?</p>
      </b-modal>
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
      message: ''
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints () {
      this.isBusy = true
      this.callAPI('post', this.pickUp.pickupID, this.SITE_POINT_API_URL + this.pickUp.site)
        .then(resp => {
          this.handleHidden()
          this.respCode = resp.status
          this.message = resp.body.content
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 400) {
            this.respCode = err.response.status
            this.$bvToast.toast('There was a error sending the request', {
              title: 'Error: Bad Request',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
          } else if (err.response.status === 404) {
            this.respCode = err.response.status
            this.$bvToast.toast('There was a error sending the request', {
              title: 'Error: Not Found',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
          } else if (err.response.status === 500) {
            this.$bvToast.toast('Could not connect to the server', {
              title: 'Connection Error',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
          }
        })
        .finally(() => {
          this.isBusy = false
          if (this.respCode === 201) {
            this.$bvToast.toast(this.message, {
              title: 'Points Added to ' + this.siteName + '!',
              variant: 'success',
              toaster: 'b-toaster-top-center'
            })
          }
          if (this.respCode === 200) {
            this.$bvToast.toast(this.message, {
              title: this.siteName + ' - No Points Added',
              variant: 'success',
              toaster: 'b-toaster-top-center'
            })
          }
        })
    },
    handleHidden () {
      this.$emit('finished')
    }
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
