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
  </div>
    <div class="form-row">
      <div class="form-group col-6">
      <label for="collected">Collected</label>
        <input id="collected" type="text" class="form-control" v-model.trim="$v.pickup.numCollected.$model"
               :class="{'is-invlaid' :$v.pickup.numCollected.$error, 'is-invalid': $v.pickup.numCollected}">
        <div class="valid-feedback" id="properCollected">Valid bin amount </div>
        <div class="invalid-feedback" id="improperCollected">
          <span v-if="$v.pickup.numCollected.required">Error - Invalid. Bin number amount required.</span>
          <span v-if="$"
        </div>
      </div>
      </div>
    </div>
  </div>
</form>
</div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'

export default {
  name: 'DriverSiteReport',
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
      error: {}
    }
  },

  validations: {
    pickup: {
      siteid: { // we will need to figure this one out
      },
      numCollected: {
        required,
        checkIfValidNumBin (value) {
          return value
        },
        checkCount (value) {
          return value
        }
      },
      numObstructed: {
        // some validation
      },
      numContaminated: {
        // some validation
      }
    }
  },
  methods: {
    postPickup: function () {
      throw new Error('Not Implemented')
    }
  }
}
</script>

<style scoped>

</style>
