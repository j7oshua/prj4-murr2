<template>
  <div>
    <b-modal v-model="showModal"  @hidden="handleHidden" hide-backdrop content-class="shadow" hide-footer>
      <div slot="modal-title">
        <div v-if="editMode">
          <h4>Edit Profile Information</h4>
        </div>
        <div v-else>
          <h4>Profile Information</h4>
        </div>
      </div>
      <div v-if="editMode">
          <form @submit.prevent="saveProfile">
            <div class="form-row">
              <!-- firstName input box -->
              <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input id="firstName" type="text" class="form-control" v-model.trim="$v.tempProfile.firstName.$model"
                       :class="{'is-invalid':$v.tempProfile.firstName.$error}">
                <!-- vuelidate  invalid feedback -->
                <div class="invalid-feedback" id="improperFirstNameLength">
                  <!-- feedback error message for improper format -->
                  <span v-if="!$v.tempProfile.firstName.firstName">First name cannot be longer than 20 characters</span>
                </div>
              </div>
            </div>
            <div class="form-row">
              <!-- lastName input box -->
              <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input id="lastName" type="text" class="form-control" v-model.trim="$v.tempProfile.lastName.$model"
                       :class="{'is-invalid':$v.tempProfile.lastName.$error}">
                <!-- vuelidate  invalid feedback -->
                <div class="invalid-feedback" id="improperLastNameLength">
                  <!-- feedback error message for improper format -->
                  <span v-if="!$v.tempProfile.lastName.lastName">Last name cannot be longer than 20 characters</span>
                </div>
              </div>
            </div>
            <div class="form-row">
              <!-- lastName input box -->
              <div class="form-group col-md-6">
                <label for="profilePic">Profile Pic</label>
                <input id="profilePic" type="image" class="form-control" v-model.trim="$v.tempProfile.profilePic.$model"
                       :class="{'is-invalid':$v.tempProfile.profilePic.$error, 'is-valid':!$v.resident.profilePic.$invalid}">
                <!-- vuelidate  valid feedback -->
                <div class="valid-feedback" id="validProfilePicSize">Your profile pic is valid!</div>
                <!-- vuelidate  invalid feedback -->
                <div class="invalid-feedback" id="valid">
                  <!-- feedback error message for improper format -->
                  <span v-if="!$v.tempProfile.profilePic.mimeType">Must be valid image (jpeg, png)</span>
                  <!-- feedback error message for improper format -->
                  <span v-if="!$v.tempProfile.profilePic.size">Image cannot be larger than 2MB</span>
                </div>
              </div>
            </div>
          </form>
      </div>
      <div v-else>
        <div>
          <span>{{tempProfile.firstName}}</span>
          <span>{{tempProfile.lastName}}</span>
        </div>
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </b-modal>
  </div>

<!--    <b-modal v-model="showModal"  @hidden="handleHidden" hide-backdrop content-class="shadow" hide-footer>-->
<!--      <div slot="modal-title">-->
<!--        <div v-if="editMode">-->
<!--          <h4>Edit Profile Information</h4>-->
<!--        </div>-->
<!--        <div v-else>-->
<!--          <h4>Profile Information</h4>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div v-if="editMode">-->
<!--        <div>-->
<!--          <b-input-group>-->
<!--            <div>-->
<!--              <b-form-input placeholder="First Name" v-model="tempProfile.firstName"></b-form-input>-->
<!--            </div>-->
<!--            <div>-->
<!--              <b-form-input placeholder="Last Name" v-model="tempProfile.lastName"></b-form-input>-->
<!--            </div>-->
<!--&lt;!&ndash;            <div>&ndash;&gt;-->
<!--&lt;!&ndash;              <b-form-file placeholder="Profile Picture" accept="image/*" v-model="tempProfile.profilePic"></b-form-file>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--          </b-input-group>-->
<!--          <div>-->
<!--            <b-button @click="saveProfile">Save Information</b-button>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div v-else>-->
<!--        <div>-->
<!--          <span>{{tempProfile.firstName}}</span>-->
<!--          <span>{{tempProfile.lastName}}</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <b-button @click="switchMode">-->
<!--        <span v-if="editMode">Cancel</span>-->
<!--        <span v-else>Edit</span>-->
<!--      </b-button>-->
<!--    </b-modal>-->
<!--  </div>-->
</template>

<script>
import MurrMixin from '@/mixins/murr-mixin'
export default {
  name: 'ProfileInfo',
  mixins: [MurrMixin],
  props: {
    showModal: {
      type: Boolean
    }
  },
  data: function () {
    return {
      tempProfile: {
        firstName: 'jon',
        lastName: 'doe'
      },
      residentID: 1,
      editMode: false
    }
  },
  validations: {
    profile: {
      firstName: {},
      lastName: {},
      profilePic: {}
    }
  },
  methods: {
    getProfileInfo () {
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentID)
        .then(resp => {
          this.tempProfile = resp.data.profile
        })
        .catch(err => {
          if (err.response.status === 404) { // not found
            const message = err.response.status
            console.log(message)
          }
        })
    },
    saveProfile () {
      this.tempProfile = {
        firstName: this.resident.firstName,
        lastName: this.resident.lastName
      }
      this.callAPI_URL('put', this.tempProfile, this.PROFILE_API_URL + this.residentID)
        .then(resp => {
          this.tempProfile = resp.data
        })
        .catch(err => {
          console.log(err)
        })
    },
    handleHidden () {
      this.$emit('closed')
    },
    switchMode () {
      this.editMode = !this.editMode
    }
  },
  mounted () {
    this.getProfileInfo()
  }
}
</script>

<style scoped>

</style>
