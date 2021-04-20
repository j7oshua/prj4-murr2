<template>
  <div>
    <b-modal v-model="showMod"  @hidden="handleHidden" header-bg-variant="primary"
             header-text-variant="light" hide-backdrop content-class="shadow" hide-footer>
      <div slot="modal-title">
        <div v-if="editMode">
          <h4 id="editProfileTitle">Edit Profile Information</h4>
        </div>
        <div v-else>
          <h4>Profile Information</h4>
        </div>
      </div>
      <div v-if="editMode">
        <div>
          <b-input-group>
            <b-container>
              <b-row>
                <b-form-input placeholder="First Name" v-model.trim="tempProfile.firstName" id="firstNameInput"></b-form-input>
                <div v-if="tempProfile.firstName.length > 20">
                  <p id="invalidFirstName" class="text-danger p-2">First Name cannot be longer than 20 characters</p>
                </div>
                <div v-else>
                  <p id="validFirstName" class="text-success p-2">The first name is valid</p>
                </div>
              </b-row>
              <b-row>
                <b-form-input placeholder="Last Name" v-model.trim="tempProfile.lastName" id="lastNameInput"></b-form-input>
                <div v-if="tempProfile.lastName.length > 20">
                  <p id="invalidLastName" class="text-danger p-2">Last Name cannot be longer than 20 characters</p>
                </div>
                <div v-else>
                  <p id="validLastName" class="text-success p-2">The last name is valid</p>
                </div>
              </b-row>
              <b-row>
                <b-form-file @change="encodeImage" id="profPicInput" placeholder="Profile Picture" accept="image/*" v-model="file"></b-form-file>
                <div v-if="file.size > 2000000">
                  <p id="invalidProfPicSize" class="text-danger p-2">Profile pic cannot be larger than 2MB</p>
                </div>
                <div v-else>
                  <p id="validProfPicSize" class="text-success p-2">Profile pic is valid</p>
                </div>
              </b-row>
            </b-container>
          </b-input-group>
        </div>
      </div>
      <div v-else>
        <b-container>
          <b-row>
            <b-col cols="4">
              <b-img :src="profile.profilePic" rounded="circle" width="100" height="100" alt="Profile Pic" id="viewProfilePicture"></b-img>
            </b-col>
            <b-col cols="4">
              <h2 id="viewProfileName">{{profile.firstName}} {{profile.lastName}}</h2>
            </b-col>
          </b-row>
        </b-container>
      </div>
      <b-container>
        <b-row align-h="end">
          <b-col cols="2">
            <b-button v-if="editMode" @click="saveProfile" :disabled="disableSaveBtn">Save</b-button>
          </b-col>
          <b-col cols="2">
            <b-button id="btnEditOrSave" @click="switchMode">
              <span v-if="editMode">Cancel</span>
              <span v-else>Edit</span>
            </b-button>
          </b-col>
        </b-row>
      </b-container>
    </b-modal>
  </div>
</template>
<script>
export default {
  name: 'ProfileInfo',
  props: {
    residentID: {
      type: Number
    },
    showModal: {
      type: Boolean
    },
    profile: {
      type: Object
    }
  },
  data: function () {
    return {
      tempProfile: {
        firstName: 'First Name',
        lastName: 'Last Name',
        profilePic: null
      },
      editMode: false,
      file: [],
      fNameState: true
    }
  },
  methods: {
    saveProfile () {
      this.tempProfile = {
        firstName: this.tempProfile.firstName,
        lastName: this.tempProfile.lastName,
        profilePic: this.tempProfile.profilePic === null ? this.profile.profilePic : this.tempProfile.profilePic
      }
      this.callAPI_URL('put', this.tempProfile, this.PROFILE_API_URL + this.residentID)
        .then(resp => {
          this.tempProfile = resp.data
          this.handleHidden()
          this.editMode = false
          this.$bvToast.toast('Profile information has been updated', {
            id: 'profileUpdated',
            title: 'Profile Successfully Updated',
            variant: 'success',
            toaster: 'b-toaster-top-center'
          })
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
      if (this.editMode === true) {
        this.tempProfile.firstName = this.profile.firstName
        this.tempProfile.lastName = this.profile.lastName
        this.tempProfile.profilePic = this.profile.profilePic
        this.file = []
      } else {
        this.tempProfile.firstName = ''
        this.tempProfile.lastName = ''
        this.tempProfile.profilePic = null
        this.file = []
      }
    },
    encodeImage: function () {
      const vm = this
      const file = document
        .getElementById('profPicInput')
        .files[0]
      const reader = new FileReader()
      reader.onload = function (e) {
        vm.tempProfile.profilePic = e.target.result
      }
      reader.onerror = function (error) {
        alert(error)
      }
      reader.readAsDataURL(file)
    }
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
      return this.file === null || this.file.size <= 2000000 || !this.file.size > 0
    },
    // Getter and Setter for the showModal prop. Don't want to mutate the prop so the setter will just emit back that
    // component is finished and will not change the prop in any way.
    showMod: {
      get: function () {
        return this.showModal
      },
      set: function () {
        this.$emit('finished')
      }
    }
  }
}
</script>
<style scoped>
</style>
