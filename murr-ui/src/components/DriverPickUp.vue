
<template>
  <div>
    <form id="form" v-if="showForm" @submit.prevent="postPickup">
      <div class="form-row">
        <!-- This will show the site id -->
        <div class="form-group col-2">
          <label for="siteId">Site ID: </label>
<!--          check to see if there is an id greater then 0 or if it is empty-->
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
<!--          check to see if the siteName is nulll-->
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
<!--      Does the validating first is all bin equal 0-->
      <div v-if="countedBins == 0" class="form-group col-6">
        <span ></span>
      </div>
<!--      checks is the counted biun match the numbins of site bins-->
      <div v-else-if="countedBins == siteObject.numBins" class="form-group col-6 border border-success">
        <span id="properBins" class="text-success p-2">Valid bin amount</span>
      </div>
<!--      if they do not match-->
      <div v-else  class="form-group col-6 border border-danger">
        <span  id="improperBins" class="text-danger p-2">This Site is expecting {{siteObject.numBins}} bins.</span>
      </div>
      <div>
        <button type="submit" class="btn btn-submit btn-primary">Submit</button>
      </div>
    </form>
<!--    shows the modal-->
    <confirm :showModal="showModal" :siteName="siteObject.siteName" :pickUp="pickUp2" @finished="confirmFinished"></confirm>
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
      dateStamp: '',
      showModal: false,
      pickUp2: {
        pickupID: -1,
        siteId: this.siteObject.id,
        numCollected: 0
      }
    }
  },

  created () {
    setInterval(this.getServerDate, 1000)
  },
  methods: {
    postPickup: function () {
      // sets up the error array
      this.error = {}
      // sets up the pickup object
      this.pickup = {
        numCollected: parseInt(this.pickup.numCollected),
        numContaminated: parseInt(this.pickup.numContaminated),
        numObstructed: parseInt(this.pickup.numObstructed),
        siteId: this.siteObject.id
      }
      // story 05 need the numCollected
      this.pickUp2.numCollected = parseInt(this.pickup.numCollected)
      // Direct axios call here
      this.axios({
        method: 'post',
        url: this.PICKUP_API_URL,
        data: this.pickup
      })
        .then(resp => {
          // returns the pickup object
          this.pickup = resp.data
          // sets the returned the pickup id
          this.pickUp2.pickupID = this.pickup.id
          // this.pickUp2.numCollected = parseInt(this.pickup.numCollected)
        })
        .catch(err => {
          if (err.response === 404) {
            this.error = err && err.response ? err.response.data : {}
          }
        })
        .finally(() => { // this will emit to stop showing the form.
          // this.$emit('finished')
          // turns the modal on
          this.showModal = true
        })
    },
    getServerDate: function () {
      // sets the date
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    },
    confirmFinished () {
      this.showModal = false
    }
  },
  computed: {
    countedBins: function () {
      // counts all the bin inputs
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
