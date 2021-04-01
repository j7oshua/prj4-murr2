<template>
  <div>

    <b-modal v-model="showModal"  @hidden="handleHidden" :header-bg-variant="headerBgVariant"
             :header-text-variant="headerTextVariant" hide-backdrop content-class="shadow" hide-footer>
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
              <b-form-input placeholder="First Name" v-model="tempProfile.firstName"></b-form-input>
            </div>
            <div>
              <b-form-input placeholder="Last Name" v-model="tempProfile.lastName"></b-form-input>
            </div>
            <div>
              <b-form-file placeholder="Profile Picture" accept="image/*" v-model="tempProfile.profilePic"></b-form-file>
            </div>
          </b-input-group>
          <div>
            <b-button @click="saveProfile">Save Information</b-button>
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
import ResidentMixin from '../mixins/resident-mixin'
export default {
  name: 'ProfileInfo',
  mixins: [ResidentMixin],
  props: {
    showModal: {
      type: Boolean
    }
  },
  data: function () {
    return {
      tempProfile: {},
      residentID: Number,
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
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentID, {})
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.tempProfile = resp.data
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
        firstName: this.resident.email,
        lastName: this.resident.phone,
        password: this.resident.password
      }
      this.axios.put(this.RESIDENT_POINTS_URL + this.residentID, {
        tempProfile: this.tempProfile
      })
        .then(resp => {
          this.tempProfile = resp.data
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
