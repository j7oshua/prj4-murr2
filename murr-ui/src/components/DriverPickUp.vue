
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
          <label for="siteName">Site Name: </label>
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
      <span v-if="error.length" class="text-danger p-2"> {{error}} </span>
      <div>
        <button type="submit" class="btn btn-submit btn-primary" :disabled="countedBins != siteObject.numBins">Submit</button>
      </div>
    </form>
<!--    shows the modal-->
    <confirm v-if="siteObject.siteName !== undefined" :showModal="showModal" :siteName="siteObject.siteName" :pickUp="pickUp2" @finished="confirmFinished"></confirm>
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
      error: '',
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
      this.error = ''
      // sets up the pickup object
      this.pickup = {
        numCollected: this.pickup.numCollected === '' ? 0 : parseInt(this.pickup.numCollected),
        numContaminated: this.pickup.numContaminated === '' ? 0 : parseInt(this.pickup.numContaminated),
        numObstructed: this.pickup.numObstructed === '' ? 0 : parseInt(this.pickup.numObstructed),
        siteId: this.siteObject.id
      }
      // story 05 need the numCollected
      this.pickUp2.numCollected = parseInt(this.pickup.numCollected)
      this.pickUp2.siteId = this.siteObject.id
      // Direct axios call here
      this.axios({
        method: 'POST',
        url: this.PICKUP_API_URL,
        data: this.pickup
      })
        .then(resp => {
          // returns the pickup object
          this.pickup = resp.data
          // sets the returned the pickup id
          this.pickUp2.pickupID = this.pickup.id
          // this.pickUp2.numCollected = parseInt(this.pickup.numCollected)
          this.showModal = true
        })
        .catch(err => {
          if (err.response.status === 404 || err.response.status === 400) {
            this.error = err.response.data[0]
          }
          if (err.response.status === 422) {
            for (var mesg in err.response.data) {
              this.error += mesg + '\n'
            }
          }
        })
    },
    getServerDate: function () {
      // sets the date
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    },
    confirmFinished () {
      this.showModal = false
      this.$emit('finished', this.pickup)
      this.pickup = {
        numCollected: 0,
        numContaminated: 0,
        numObstructed: 0
      }
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
