<template>
  <div>

  </div>
</template>

<script>
export default {
  name: "AccountInfo",
  props: {
    account: {
      type: Object
    }
  },
  data: function () {
    return {
      tempAccount: {},
      firstName: String,
      lastName: String,
      profilePicture: File
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
