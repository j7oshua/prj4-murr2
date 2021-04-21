<template>
  <div>
<!--    adds a loading animation when the page is busy-->
    <b-overlay :show="isDisabled">
      <h2 v-if="statusCode === 200">Points: {{ tempPoints }}</h2>
      <h2 v-else-if="statusCode === 401">You are not logged in</h2>
      <h2 v-else>Failed Connection</h2>
    </b-overlay>
  </div>
</template>

<script>
export default {
  name: 'ProgressPoints',
  data () {
    return {
      // store the resident's points in this variable
      tempPoints: 0,
      isBusy: false,
      statusCode: null,
      residentId: sessionStorage.getItem('id'),
      token: ''
    }
  },
  // created () {
  //   this.residentId = this.$route.params.id
  // },
  methods: {
    getPoints: function () {
      // disable overlay
      this.isBusy = true
      // make the call to the API
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentId, {
        headers: {
          Authorization: 'Bearer ' + sessionStorage.getItem('token')
        }
      })
        .then(resp => {
          this.statusCode = resp.status
          // set tempPoints to be the points returned by the API
          this.tempPoints = resp.data.content
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 404) { // not found
            this.statusCode = 404
            const message = err.status
            console.log(message)
          } else {
            this.statusCode = err.response.status
          }
        }).finally(() => {
          // re-enable overlay
          this.isBusy = false
        })
    }
  },
  mounted () {
    // make call to the database when the page is ready
    this.residentId = sessionStorage.getItem('id')
    this.getPoints()
  },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    }
  }
}
</script>

<style scoped>

</style>
