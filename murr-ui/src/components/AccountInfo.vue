<template>
  <div>
    <b-modal  @hidden="handleHidden" :header-bg-variant="headerBgVariant"
             :header-text-variant="headerTextVariant" hide-backdrop content-class="shadow" hide-footer>
      <div slot="modal-title">
        <h4>Edit Account Information</h4>
      </div>
      <b-input-group>
        <b-form-input>
          <b-form-input placeholder="First Name"></b-form-input>
          <b-form-input placeholder="Last Name"></b-form-input>
          <b-form-file placeholder="Profile Picture" accept="image/*"></b-form-file>
        </b-form-input>
      </b-input-group>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'AccountInfo',
  props: {
    account: {
      type: Object
    }
  },
  data: function () {
    return {
      tempAccount: {},
      residentID: Number,
      firstName: String,
      lastName: String,
      profilePic: File
    }
  },
  validations: {
    account: {
      firstName: {

      },
      lastName: {

      },
      profilePic: {

      }
    }
  },
  methods: {
    getAccountInfo() {

    },
    saveAccount() {

    },
    editAccount() {

    }
  }
}

</script>

<style scoped>

</style>
