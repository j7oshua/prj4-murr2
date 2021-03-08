<template>
  <div>
    <b-overlay :show="isDisabled">
      <site-point-modals @callAPI="confirmPoints" @finished="handleHidden" :siteName="siteName" :pickUp="pickUp">
        <template v-slot:{{modalType}}>
        </template>
      </site-point-modals>
    </b-overlay>
  </div>
</template>

<script>
import MurrMixin from '@/mixins/murr-mixin'
import SitePointMixin from '@/mixins/site-point-mixin'
import SitePointModals from '@/components/SitePointModals'
export default {
  name: 'DriverConfirms',
  mixins: [MurrMixin, SitePointMixin],
  components: {
    SitePointModals: SitePointModals
  },
  // Prop pickupID is sent from the parent. Used in the API call.
  props: {
    pickUp: {
      type: Object,
      required: true
    }, // Site name prop used to display site name in the modals
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
      modalType: 'confirm'
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
    // Calls the API to check to see if the pickupID exists
    checkPickupID () {
      this.$bvModal.show('confirm')
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
