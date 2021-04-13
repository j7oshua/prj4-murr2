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
        <div>
          <b-input-group>
            <div>
              <b-form-input placeholder="First Name" v-model="tempProfile.firstName" :state="fNameError" aria-describedby="fName"></b-form-input>
              <b-form-invalid-feedback id="fName">First Name cannot be longer than 20 characters</b-form-invalid-feedback>
            </div>
            <div>
              <b-form-input placeholder="Last Name" v-model="tempProfile.lastName" :state="lNameError" aria-describedby="lName"></b-form-input>
              <b-form-invalid-feedback id="lName">Last Name cannot be longer than 20 characters</b-form-invalid-feedback>
            </div>
            <div>
              <b-form-file placeholder="Profile Picture" accept="image/*" v-model="tempProfile.profilePic" :state="imgSizeError" aria-describedby="imgSize"></b-form-file>
              <b-form-invalid-feedback id="imgSize">Profile pic cannot be larger than 2MB</b-form-invalid-feedback>
            </div>
          </b-input-group>
          <div>
            <b-button @click="saveProfile" :disabled="disableSaveBtn">Save Information</b-button>
          </div>
        </div>
      </div>
      <div v-else>
        <div>
          <span>{{tempProfile.firstName}}</span>
          <span>{{tempProfile.lastName}}</span>
        </div>
      </div>
      <b-button @click="switchMode">
        <span v-if="editMode">Cancel</span>
        <span v-else>Edit</span>
      </b-button>
    </b-modal>
  </div>
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
        firstName: '',
        lastName: ''
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
        firstName: this.tempProfile.firstName,
        lastName: this.tempProfile.lastName
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
  },
  computed: {
    fNameError () {
      return this.tempProfile.firstName.length <= 20
    },
    lNameError () {
      return this.tempProfile.lastName.length <= 20
    },
    disableSaveBtn () {
      return !this.fNameError || !this.lNameError || !this.imgSizeError
    },
    imgSizeError () {
      console.log(this.tempProfile.profilePic)
      return this.tempProfile.profilePic.size <= 2000000 || this.tempProfile.profilePic.isEmpty
    }
  }
}
</script>

<style scoped>

</style>
