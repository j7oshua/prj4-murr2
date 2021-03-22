<template>
  <div>
    <b-form @submit.prevent="postPickup">
      <div class="form-row">
        <!-- This will show the site id -->
        <div class="form-group col-4">
          <!--<label for="siteId">Site ID: </label>
           <p id="siteId">{{siteObject.id}}</p> -->
        </div>
        <!-- This will show the site name-->
        <div class="form-group col-4">
          <!--<label for="siteName">Site ID: </label>
          <p id="siteName">{{siteObject.siteName}}</p> -->
        </div>
        <!-- This will show the current date from the website-->
        <div class="form-group col-4">
          <label for="siteDate">Date: </label>
          <p id="siteDate">{{dateStamp}}</p>
        </div>
      </div>
      <!-- This will be the Collected section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="collected">Collected: </label>
          <input id="collected" type="text" class="form-control" v-model.trim="pickup.numCollected">
          </div>
        </div>
      <!-- This will be the Obstructed section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="obstructed">Obstructed: </label>
          <input id="obstructed" type="text" class="form-control" v-model.trim="pickup.numObstructed">

          </div>
        </div>
      <!-- This will be the Contaminated section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="contaminated">Contaminated: </label>
          <input id="contaminated" type="text" class="form-control" v-model.trim="pickup.numContaminated">

            <span></span>
          </div>
        </div>
     <!-- <div v-if="countedBins == siteObject.numBins" class="form-group col-6 border border-success">
       <span id="properBins" class="text-success p-2">Valid bin amount</span>
      </div>
      <div v-else class="form-group col-6 border border-danger">
        <span  id="improperBins" class="text-danger p-2">This Site is expecting {{siteObject.numBins}} bins.</span>
      </div> -->
      <div>
        <b-button type="submit" class="btn btn-submit" >Submit</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
// import { validationMixin } from 'vuelidate'
// import { numeric, required } from 'vuelidate/lib/validators'
import MurrMixin from '@/mixins/murr-mixin'

export default {
  name: 'DriverPickUp',
  mixins: [MurrMixin],
  props: {
    siteObject: {
      type: Object
    },
    showForm: {
      type: Boolean
    }
  },
  data () {
    return {
      pickup: {
        siteId: '',
        siteName: '',
        numCollected: '',
        numObstructed: '',
        numContaminated: '',
        dateTime: '',
        numBins: ''
      },
      error: {},
      dateStamp: '',
      countBins: '',
      collectedFocused: false,
      contaminatedFocused: false,
      obstructedFocused: false
    }
  },

  created () {
    setInterval(this.getSeverDate, 1000)
  },
  methods: {
    focused: function (fieldName) {
      this.collectedFocused = fieldName === 'collected'
      this.obstructedFocused = fieldName === 'obstructed'
      this.contaminatedFocused = fieldName === 'contaminated'
    },
    postPickup: function () {
      this.$v.$touch()
      this.pickup = {
        numCollected: this.pickup.numCollected,
        numContaminated: this.pickup.numContaminated,
        numObstructed: this.pickup.numObstructed,
        siteId: this.siteObject.id,
        siteName: this.siteObject.siteName,
        dateTime: this.dateStamp
      }
      this.error = {}
      // Direct axios call here
      this.axios({
        method: 'post',
        url: this.PICKUP_API_URL,
        data: this.pickup
      })
        .then(resp => {
          if (resp.status === 201) {
            // toast statement of submit
            this.$toasted.show('Submitted')
          }
        })
        .catch(err => {
          if (err.response.status === 404) {
            this.error = err && err.response ? err.response.data : {}
          }
        })
        .finally(() => { // this will emit to stop showing the form.
          this.$emit('finished')
        })
    },
    getSeverDate: function () {
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    },
    checkValidBins: function (value) {
      return value === this.siteObject.numBins
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
