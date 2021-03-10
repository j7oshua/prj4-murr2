<template>
<div>
<form @submit.prevent="postPickup">
  <div class="form-row">
    <div class="form-group col-4">
      <label for="siteId">Site ID: </label>
      <p id="siteId">{{siteObject.siteid}}</p>
      <div class="valid-feedback" id="properSiteID"></div>
      <div class="invalid-feedback" id="improperSiteID">Error - No site exists.</div>
    </div>
    <div class="form-group col-4">
      <label for="siteName">Site ID: </label>
      <p id="siteName">{{siteObject.siteName}}</p>
      <div class="valid-feedback" id="properSiteName"></div>
      <div class="invalid-feedback" id="improperSiteName">Error - No site exists.</div>
    </div>
    <div class="form-group col-4">
      <label for="siteDate">Date: </label>
      <p id="siteDate">{{dateStamp}}</p>
    </div>
  </div>
    <div class="form-row">
      <div class="form-group col-6">
      <label for="collected">Collected: </label>
        <input id="collected" type="text" class="form-control" v-model.trim="$v.pickup.numCollected.$model"
               :class="{'is-invlaid' :$v.pickup.numCollected.$error, 'is-invalid': $v.pickup.numCollecte}">
        <div class="valid-feedback" id="properCollected">Valid bin amount </div>
        <div class="invalid-feedback" id="improperCollected">
          <span v-if="$v.pickup.numCollected.required">Error - Invalid. Bin number amount required.</span>
          <span v-if="$"></span>
          <span></span>
        </div>
      </div>
      </div>
  <div class="form-row">
    <div class="form-group col-6">
      <label for="obstructed">Obstructed: </label>
      <input id="obstructed" type="text" class="form-control" v-model.trim="$v.pickup.numObstructed.$model"
             :class="{'is-invlaid' :$v.pickup.numObstructed.$error, 'is-invalid': $v.pickup.numObstructed}">
      <div class="valid-feedback" id="properObstucted">Valid bin amount </div>
      <div class="invalid-feedback" id="improperObstructed">
        <span v-if="$v.pickup.numObstructed.required">Error - Invalid. Bin number amount required.</span>
        <span v-if="$"></span>
        <span></span>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-6">
      <label for="contaminated">Contaminated: </label>
      <input id="contaminated" type="text" class="form-control" v-model.trim="$v.pickup.numContaminated.$model"
             :class="{'is-invlaid' :$v.pickup.numContaminated.$error, 'is-invalid': $v.pickup.numContaminated}">
      <div class="valid-feedback" id="properContaminated">Valid bin amount </div>
      <div class="invalid-feedback" id="improperContaminated">
        <span v-if="$v.pickup.numContaminated.required">Error - Invalid. Bin number amount required.</span>
        <span v-if="$"></span>
        <span></span>
      </div>
    </div>
  </div>
</form>
</div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { numeric, required } from 'vuelidate/lib/validators'

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
        id: '',
        numCollected: '',
        numObstructed: '',
        numContaminated: '',
        dateTime: '',
        siteObject: ''
      },
      error: {},
      dateStamp: ''
    }
  },

  validations: {
    pickup: {
      numCollected: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric
      },
      numObstructed: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric
      },
      numContaminated: {
        required,
        checkValidBins (value1, value2, value3) {
          return false
        },
        numeric
      }
    }
  },
  created () {
    setInterval(this.getSeverTime, 1000)
  },
  methods: {
    postPickup: function () {
      throw new Error('Not Implemented')
    },
    checkValidBins (value1, value2, value3) {
      // this will be a if else statement to check the values
      // and compare them to determine the right response by returning true or false
      // this check will also check against the count of the site bins
      return true
    },
    getSeverTime: function () {
      const today = new Date()
      this.dateStamp = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()
    }
  }
}
</script>

<style scoped>

</style>
