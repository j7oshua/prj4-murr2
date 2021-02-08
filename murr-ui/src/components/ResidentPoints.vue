<template>
  <div>
<!--    adds a loading animation when the page is busy-->
    <b-overlay :show="isDisabled">
      <h2 v-if="statusCode === 200">Points: {{ tempPoints }}</h2>
      <h2 v-else-if="statusCode === 404">Failed Connection</h2>
    </b-overlay>
  </div>
</template>

<script>
import ResidentPointMixin from '@/mixins/resident-point-mixin'
export default {
  name: 'ProgressPoints',
  mixins: [ResidentPointMixin],
  data () {
    return {
      // store the resident's points in this variable
      tempPoints: 0,
      isBusy: false,
      statusCode: null
    }
  },
  props: {
    // this will come from the login page which will be id for the resident
    // to be used in the method to get the resident's points
    residentId: Number
  },
  methods: {
    getPoints: function () {
      // todo
      // using for demo as we can't get id from url until it is created
      this.residentId = 200
      // disable overlay
      this.isBusy = true
      // make the call to the API
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentId, {
      })
        .then(resp => {
          console.log(resp)
          this.statusCode = resp.status
          // set tempPoints to be the points returned by the API
          this.tempPoints = resp.data.content
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 404) { // not found
            this.statusCode = err.response.status
            const message = err.status
            console.log(message)
          }
        }).finally(() => {
          // re-enable overlay
          this.isBusy = false
        })
    }
  },
  mounted () {
    // make call to the database when the page is ready
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
