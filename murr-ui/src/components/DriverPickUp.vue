
<template>
  <div>
    <form id="form" v-if="showForm" @submit.prevent="postPickup">
      <div class="form-row">
        <!-- This will show the site id -->
        <div class="form-group col-2">
          <label for="siteId">Site ID: </label>
          <div v-if="siteObject.id == 0 || siteObject.id.isEmpty">
            <span id="invalidSite">Error - No site exists.</span>
          </div>
          <div v-else>
            <p id="siteId">{{siteObject.id}}</p>
          </div>
        </div>
        <!-- This will show the site name-->
        <div class="form-group col-2">
          <label for="siteName">Site ID: </label>
          <div v-if="siteObject.siteName.length === 0">
            <span id="invalidSiteName">Error - No site exists</span>
          </div>
          <div v-else>
            <p id="siteName">{{siteObject.siteName}}</p>
          </div>
        </div>
        <!-- This will show the current date from the website-->
        <div class="form-group col-2">
          <label for="siteDate"> Date: </label>
          <p id="siteDate">{{dateStamp}}</p>
        </div>
      </div>
      <!-- This will be the Collected section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="collected">Collected: </label>
          <input id="collected" type="number" class="form-control" v-model.trim="pickup.numCollected" min="0" :max="siteObject.numBins">
        </div>
      </div>
      <!-- This will be the Obstructed section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="obstructed">Obstructed: </label>
          <input id="obstructed" type="number" class="form-control" v-model.trim="pickup.numObstructed" min="0" :max="siteObject.numBins">

        </div>
      </div>
      <!-- This will be the Contaminated section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="contaminated">Contaminated: </label>
          <input id="contaminated" type="number" class="form-control" v-model.trim="pickup.numContaminated" min="0" :max="siteObject.numBins">

          <span></span>
        </div>
      </div>
      <div v-if="countedBins == 0" class="form-group col-6 border border-success">
        <span ></span>
      </div>
      <div v-else-if="countedBins == siteObject.numBins" class="form-group col-6 border border-success">
        <span id="properBins" class="text-success p-2">Valid bin amount</span>
      </div>
      <div v-else  class="form-group col-6 border border-danger">
        <span  id="improperBins" class="text-danger p-2">This Site is expecting {{siteObject.numBins}} bins.</span>
      </div>
      <div>
        <button type="submit" class="btn btn-submit btn-primary">Submit</button>
      </div>
    </form>
    <confirm :showModal="showModal" :siteName="siteObject.siteName" :pickUp="pickup" @finished="confirmFinished"></confirm>
  </div>
</template>

<script>
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
import MurrMixin from '@/mixins/murr-mixin'

export default {
  name: 'DriverPickUp',
  mixins: [MurrMixin],
  props: {
    siteObject: {
      type: Object,
      default: () => {
        return {
          id: 1,
          siteName: 'Wascana',
          numBins: 5
        }
      }
    },
    showForm: {
      type: Boolean,
      default: true
    }
  },
  components: {
    confirm: SitePointsConfirmation
  },
  data () {
    return {
      pickup: {
        siteId: this.siteObject.id,
        numCollected: 0,
        numObstructed: 0,
        numContaminated: 0
      },
      error: {},
      dateStamp: ''
    }
  },

  created () {
    setInterval(this.getServerDate, 1000)
  },
  methods: {
    postPickup: function () {
      this.error = {}
      this.pickup = {
        numCollected: parseInt(this.pickup.numCollected),
        numContaminated: parseInt(this.pickup.numContaminated),
        numObstructed: parseInt(this.pickup.numObstructed),
        siteId: this.siteObject.id
      }
      // Direct axios call here
      this.axios({
        method: 'post',
        url: this.PICKUP_API_URL,
        data: this.pickup
      })
        .then(resp => {
          this.pickup = resp.data
        })
        .catch(err => {
          if (err.response === 404) {
            this.error = err && err.response ? err.response.data : {}
          }
        })
        .finally(() => { // this will emit to stop showing the form.
          this.$emit('finished')
          this.showModal = true
        })
    },
    getServerDate: function () {
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    },
    confirmFinished () {
      this.showModal = false
    }
  },
  computed: {
    countedBins: function () {
      const collected = this.pickup.numCollected === '' ? 0 : parseInt(this.pickup.numCollected)
      const contaminated = this.pickup.numContaminated === '' ? 0 : parseInt(this.pickup.numContaminated)
      const obstructed = this.pickup.numObstructed === '' ? 0 : parseInt(this.pickup.numObstructed)
      return (collected + contaminated + obstructed)
    }
  }
}
</script>

<style scoped>

</style>
=======
<script>

export default {
  name: 'DriverPickUp',
  components: {
    confirm: SitePointsConfirmation
  },
  data () {
    return {
      // ***PickupObject needed for Story05 - pickup Object with pickupID and siteId is needed to be passed down to confirm component
      pickup: {
        pickupID: 1,
        siteId: 1,
        numCollected: 5,
        numObstructed: 0,
        numContaminated: 0,
        dateTime: '2021-01-01'
      },
      // ********* Site name will be sent to SitePointsConfirmation component. Used to demonstrate story. Can be removed
      // as long as the siteName from the props is sent to the confirm component. ***************************
      siteName: 'Brighton',
      showModal: false
    }
  },
  methods: {
    // Hides modal when the SitePointsConfirmation component is finished
    confirmFinished () {
      this.showModal = false
    },
    // ********* This is for the API call. ***this.showModal should be called in the .finally() of the call to the API
    // After the $emit('finished') of Story3 **********************************
    postPickup () {
      this.showModal = true
    }
  }
}

</script>

<style scoped>

</style>
>>>>>>> master
