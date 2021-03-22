<template>
  <div>
    <b-form v-if="showForm" @submit.prevent="postPickup" @>
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
                 :class="{'is-invalid' :$v.pickup.numCollected.$error, 'is-valid': !$v.pickup.numCollected.$invalid}"
                 v-on:focus="focused('collected')">
          <div class="valid-feedback" id="properCollected">
            <span v-if="$v.pickup.numCollected.required && collectedFocused">Valid bin amount </span>
          </div>
          <div class="invalid-feedback" id="improperCollected">
            <!-- required error-->
            <span v-if="!$v.pickup.numCollected.required">Error - Invalid. Bin number amount required.</span>
            <!-- numeric error-->
            <span v-if="!$v.pickup.numCollected.numeric">Must contain only digits</span>
            <!-- between error-->
            <span v-if="!$v.pickup.numCollected.checkValidBins && collectedFocused">Error - Invalid number of bins</span>
            <!--          <span v-if="$"></span>-->
            <span></span>
          </div>
        </div>
      </div>
      <!-- This will be the Obstructed section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="obstructed">Obstructed: </label>
          <input id="obstructed" type="text" class="form-control" v-model.trim="$v.pickup.numObstructed.$model"
                 :class="{'is-invalid' :$v.pickup.numObstructed.$error, 'is-valid': !$v.pickup.numObstructed.$invalid}"
                 v-on:focus="focused('obstructed')">
          <div class="valid-feedback" id="properObstructed">
            <span v-if="$v.pickup.numObstructed.required && obstructedFocused">Valid bin amount </span>
          </div>
          <div class="invalid-feedback" id="improperObstructed">
            <!-- required error-->
            <span v-if="!$v.pickup.numObstructed.required">Error - Invalid. Bin number amount required.</span>
            <!-- numeric error-->
            <span v-if="!$v.pickup.numObstructed.numeric">Must contain only digits</span>
            <!-- between error-->
            <span v-if="!$v.pickup.numObstructed.checkValidBins && obstructedFocused">Error - Invalid number of bins</span>
            <!--        <span v-if="$"></span>-->
            <span></span>
          </div>
        </div>
      </div>
      <!-- This will be the Contaminated section-->
      <div class="form-row">
        <div class="form-group col-6">
          <label for="contaminated">Contaminated: </label>
          <input id="contaminated" type="text" class="form-control" v-model.trim="$v.pickup.numContaminated.$model"
                 :class="{'is-invalid':$v.pickup.numContaminated.$error, 'is-valid': !$v.pickup.numContaminated.$invalid}"
                 v-on:focus="focused('contaminated')">
          <div class="valid-feedback" id="properContaminated">
            <span v-if="$v.pickup.numContaminated.required && contaminatedFocused">Valid bin amount </span>
          </div>
          <div class="invalid-feedback" id="improperContaminated">
            <!-- required error-->
            <span v-if="!$v.pickup.numContaminated.required">Error - Invalid. Bin number amount required.</span>
            <!-- numeric error-->
            <span v-if="!$v.pickup.numContaminated.numeric">Must contain only digits</span>
            <!-- between error-->
            <span v-if="!$v.pickup.numContaminated.checkValidBins && contaminatedFocused">Error - Invalid number of bins</span>
            <!--        <span v-if="$"></span>-->
            <span></span>
          </div>
        </div>
      </div>
      <b-button type="submit" class="btn btn-submit" >Submit</b-button>
    </b-form>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { numeric, required } from 'vuelidate/lib/validators'
import MurrMixin from '@/mixins/murr-mixin'

export default {
  name: 'DriverSiteReport',
  mixins: [validationMixin, MurrMixin],
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
  validations: {
    pickup: {
      numCollected: {
        required,
        checkValidBins () {
          return this.countedBins() === this.pickup.numBins
        },
        numeric
        // between: between(0, this.numBins)
      },
      numObstructed: {
        required,
        checkValidBins () {
          return this.countedBins() === this.pickup.numBins
        },
        numeric
        // between: between(0, this.numBins)
      },
      numContaminated: {
        required,
        checkValidBins () {
          return this.countedBins() === this.pickup.numBins
        },
        numeric
        // between: between(0, this.numBins)
      }
    }
  },
  created () {
    setInterval(this.getSeverDate, 1000)
    // this.numBins = Number.parseInt(this.props.siteObject.numBins)// assigned a numBins property from props numBins, not sure if I need to cast
    this.pickup.numBins = this.siteObject.numBins
    this.pickup.siteId = this.siteObject.id
    this.pickup.siteName = this.siteObject.siteName
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
    },
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
