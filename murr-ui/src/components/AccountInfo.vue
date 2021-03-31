<template>
  <div>

    <b-modal v-model="showModal"  @hidden="handleHidden" :header-bg-variant="headerBgVariant"
             :header-text-variant="headerTextVariant" hide-backdrop content-class="shadow" hide-footer>
      <div slot="modal-title">
        <div v-if="editMode">
          <h4>Edit Account Information</h4>
        </div>
        <div v-else>
          <h4>Account Information</h4>
        </div>
      </div>
      <div v-if="editMode">
        <div>
          <b-input-group>
            <div>
              <b-form-input placeholder="First Name" v-model="tempAccount.firstName"></b-form-input>
            </div>
            <div>
              <b-form-input placeholder="Last Name" v-model="tempAccount.lastName"></b-form-input>
            </div>
            <div>
              <b-form-file placeholder="Profile Picture" accept="image/*" v-model="tempAccount.profilePic"></b-form-file>
            </div>
          </b-input-group>
          <div>
            <b-button @click="saveAccount">Save Information</b-button>
          </div>
        </div>
      </div>
      <div v-else>
        <div>
          <span>{{tempAccount.firstName}}</span>
          <span>{{tempAccount.lastName}}</span>
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
  name: 'AccountInfo',
  mixins: [ResidentMixin],
  props: {
    showModal: {
      type: Boolean
    }
  },
  data: function () {
    return {
      tempAccount: {},
      residentID: Number,
      editMode: false
    }
  },
  validations: {
    account: {
      firstName: {},
      lastName: {},
      profilePic: {}
    }
  },
  methods: {
    getAccountInfo () {
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentID, {})
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.tempAccount = resp.data
        })
        .catch(err => {
          if (err.response.status === 404) { // not found
            const message = err.response.status
            console.log(message)
          }
        })
    },
    saveAccount () {
      this.tempAccount = {
        firstName: this.resident.email,
        lastName: this.resident.phone,
        password: this.resident.password
      }
      this.axios.put(this.RESIDENT_POINTS_URL + this.residentID, {
        tempAccount: this.tempAccount
      })
        .then(resp => {
          this.tempAccount = resp.data
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
    this.getAccountInfo()
  }
}
</script>

<style scoped>

</style>
