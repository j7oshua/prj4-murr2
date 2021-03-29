<template>
  <div>

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
