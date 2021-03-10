<template>
<div>
<form @submit.prevent="postPickup">
  <div class="form-row">
    <!-- This will show the site id -->
    <div class="form-group col-4">
      <label for="siteId">Site ID: </label>
      <p id="siteId">{{siteObject.id}}</p>
      <div class="valid-feedback" id="properSiteID"></div>
      <div class="invalid-feedback" id="improperSiteID">Error - No site exists.</div>
    </div>
    <!-- This will show the site name-->
    <div class="form-group col-4">
      <label for="siteName">Site ID: </label>
      <p id="siteName">{{siteObject.siteName}}</p>
      <div class="valid-feedback" id="properSiteName"></div>
      <div class="invalid-feedback" id="improperSiteName">Error - No site exists.</div>
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
        <input id="collected" type="text" class="form-control" v-model.trim="$v.pickup.numCollected.$model"
               :class="{'is-invalid' :$v.pickup.numCollected.$error, 'is-invalid': $v.pickup.numCollected}">
        <div class="valid-feedback" id="properCollected">Valid bin amount </div>
        <div class="invalid-feedback" id="improperCollected">
          <!-- required error-->
          <span v-if="$v.pickup.numCollected.required">Error - Invalid. Bin number amount required.</span>
          <!-- numeric error-->
          <span v-if="!$v.pickup.numCollected.numeric">Must contain only digits</span>
          <!-- between error-->
          <span v-if="!$v.pickup.numCollected.between">Error - Invalid number of bins</span>
          <span v-if="$"></span>
          <span></span>
        </div>
      </div>
      </div>
  <!-- This will be the Obstructed section-->
  <div class="form-row">
    <div class="form-group col-6">
      <label for="obstructed">Obstructed: </label>
      <input id="obstructed" type="text" class="form-control" v-model.trim="$v.pickup.numObstructed.$model"
             :class="{'is-invalid' :$v.pickup.numObstructed.$error, 'is-invalid': $v.pickup.numObstructed}">
      <div class="valid-feedback" id="properObstucted">Valid bin amount </div>
      <div class="invalid-feedback" id="improperObstructed">
        <!-- required error-->
        <span v-if="$v.pickup.numObstructed.required">Error - Invalid. Bin number amount required.</span>
        <!-- numeric error-->
        <span v-if="!$v.pickup.numObstructed.numeric">Must contain only digits</span>
        <!-- between error-->
        <span v-if="!$v.pickup.numObstructed.between">Error - Invalid number of bins</span>
        <span v-if="$"></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- This will be the Contaminated section-->
  <div class="form-row">
    <div class="form-group col-6">
      <label for="contaminated">Contaminated: </label>
      <input id="contaminated" type="text" class="form-control" v-model.trim="$v.pickup.numContaminated.$model"
             :class="{'is-invalid' :$v.pickup.numContaminated.$error, 'is-invalid': $v.pickup.numContaminated}">
      <div class="valid-feedback" id="properContaminated">Valid bin amount </div>
      <div class="invalid-feedback" id="improperContaminated">
        <!-- required error-->
        <span v-if="$v.pickup.numContaminated.required">Error - Invalid. Bin number amount required.</span>
        <!-- numeric error-->
        <span v-if="!$v.pickup.numContaminated.numeric">Must contain only digits</span>
        <!-- between error-->
        <span v-if="!$v.pickup.numContaminated.between">Error - Invalid number of bins</span>
        <span v-if="$"></span>
        <span></span>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-submit">Submit</button>
</form>
</div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { numeric, required, between } from 'vuelidate/lib/validators'

export default {
  name: 'DriverSiteReport',
  mixins: [validationMixin],
  props: {
    siteObject: {
      type: Object
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
        dateTime: ''
      },
      error: {},
      dateStamp: '',
      numBins: 0
    }
  },
  validations: {
    pickup: {
      numCollected: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric,
        between: between(0, this.numBins)
      },
      numObstructed: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric,
        between: between(0, this.numBins)
      },
      numContaminated: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric,
        between: between(0, this.numBins)
      }
    }
  },
  created () {
    setInterval(this.getSeverDate, 1000)
    this.numBins = Number.parseInt(this.props.siteObject.numBins)// assigned a numBins property from props numBins, not sure if I need to cast
  },
  methods: {
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
    checkValidBins (value1, value2, value3) {
      // this will be a if else statement to check the values
      // and compare them to determine the right response by returning true or false
      // this check will also check against the count of the site bins
      return true
    },
    getSeverDate: function () {
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    }
  }
}
</script>

<style scoped>

</style>
