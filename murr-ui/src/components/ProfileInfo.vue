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
                <b-form-input placeholder="First Name" v-model.trim="tempProfile.firstName" :state="fNameError" aria-describedby="fNameInvalid" id="firstNameInput"></b-form-input>
                <b-form-invalid-feedback id="fNameInvalid">First Name cannot be longer than 20 characters</b-form-invalid-feedback>
              </b-row>
              <b-row>
                <b-form-input placeholder="Last Name" v-model.trim="tempProfile.lastName" :state="lNameError" aria-describedby="lNameInvalid" id="lastNameInput"></b-form-input>
                <b-form-invalid-feedback id="lNameInvalid">Last Name cannot be longer than 20 characters</b-form-invalid-feedback>
              </b-row>
              <b-row>
                <b-form-file @change="encodeImage" id="profPicInput" placeholder="Profile Picture" accept="image/*" v-model="file" :state="imgSizeError" aria-describedby="imgSizeInvalid"></b-form-file>
                <b-form-invalid-feedback id="imgSizeInvalid">Profile pic cannot be larger than 2MB</b-form-invalid-feedback>
              </b-row>
            </b-container>
          </b-input-group>
        </div>
      </div>
      <div v-else>
        <b-container>
          <b-row>
            <b-col cols="4">
              <b-img :src="profile.profilePic" rounded="circle" width="100" height="100" alt="Profile Pic"></b-img>
            </b-col>
            <b-col cols="4">
              <h2>{{profile.firstName}} {{profile.lastName}}</h2>
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
        firstName: '',
        lastName: '',
        profilePic: null
      },
      editMode: false,
      file: null
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
      this.tempProfile.firstName = this.profile.firstName
      this.tempProfile.lastName = this.profile.lastName
      this.tempProfile.profilePic = null
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
