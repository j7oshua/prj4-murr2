<template>
  <div>
    <b-overlay :show="isDisabled">
      <b-modal @ok="confirmPoints" v-model="showMod" @hidden="handleHidden" :header-bg-variant="headerBgVariant"
      :header-text-variant="headerTextVariant" hide-backdrop content-class="shadow" hide-footer>
        <div slot="modal-title">
          <h4>Confirm Point Addition to {{siteName}}</h4>
        </div>
        <b-container>
          <b-row>
            <b-col cols="2">
              <b-icon icon="trash-fill" variant="primary" font-scale="3"></b-icon>
            </b-col>
            <b-col>
              <p class="message">Do you confirm {{pickUp.numCollected}} containers were collected from {{ siteName }}?</p>
            </b-col>
          </b-row>
          <b-row align-h="end">
            <b-col cols="2">
              <b-button id="btncancel" variant="danger" @click="handleHidden">Cancel</b-button>
            </b-col>
            <b-col cols="2">
              <b-button id="btnyes" variant="primary" @click="confirmPoints">Yes</b-button>
            </b-col>
          </b-row>
        </b-container>
      </b-modal>
    </b-overlay>
  </div>
</template>

<script>
// import required mixins
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
    showModal: { // prop to be used to hide and show modal in DriverPickUp.vue
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
      respCode: 0,
      isBusy: false,
      currentPickup: {
        pickupID: -1
      },
      message: '',
      headerBgVariant: 'primary',
      headerTextVariant: 'light'
    }
  },
  methods: {
    // Makes the call to the API. Will add points to the correct site.
    confirmPoints () {
      // set isBusy to true for the overlay
      this.isBusy = true
      this.currentPickup.pickupID = this.pickUp.pickupID
      // call the API to add points to site
      this.callAPI('post', this.currentPickup, this.SITE_POINT_API_URL + this.pickUp.siteId)
        .then(resp => {
          this.handleHidden()
          this.respCode = resp.status
          this.message = resp.data
        })
        // Handles any errors that occur during the POST. Will display a toast notification displaying the error
        .catch(err => {
          console.log(err)
          if (err.response.status === 400) {
            this.respCode = err.response.status
            this.$bvToast.toast('There was a error sending the request', {
              title: 'Error: Bad Request',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
            this.handleHidden()
          } else if (err.response.status === 422) {
            this.respCode = err.response.status
            this.$bvToast.toast('There was a error sending the request', {
              title: 'Error: Pickup ID Not Found',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
            this.handleHidden()
          } else {
            this.respCode = 500
            this.$bvToast.toast('Could not connect to the server', {
              title: 'Connection Error',
              variant: 'danger',
              toaster: 'b-toaster-top-center'
            })
            this.handleHidden()
          }
        })
        // If the POST was successful. Will display the success toast depending on the status code received
        .finally(() => {
          this.isBusy = false
          if (this.respCode === 201) {
            this.$bvToast.toast(this.message, {
              id: 'pointsCreated',
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
    // Method that will emit back to the DriverPickUp, telling it that this component is finished and will hide it
    handleHidden () {
      this.$emit('finished')
    }
  },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    },
    // Getter and Setter for the showModal prop. Don't want to mutate the prop so the setter will just emit back that
    // component is finished and will not change the prop in any way.
    showMod: {
      get: function () {
        return this.showModal
      },
      set: function () {
        this.$emit('finished')
      }
    }
  }
}
</script>

<style scoped>

</style>
