<template>
  <div>
<!--    adds a loading animation when the page is busy-->
    <b-overlay :show="isDisabled">
      <h2>Points: {{ tempPoints }}</h2>
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
      isBusy: false
    }
  },
  props: {
    // this will come from the login page which will be id for the resident
    // to be used in the method to get the resident's points
    residentId: Number
  },
  methods: {
    getPoints: function () {
      // disable overlay
      this.isBusy = true
      // make the call to the API
      this.axios.get(this.RESIDENT_POINTS_URL, {
        params: { residentId: 2 }
      })
        .then(resp => {
          console.log(resp)
          // set tempPoints to be the points returned by the API
          this.tempPoints = resp.data[0].points
        })
        .catch(err => {
          console.log(err)
          if (err.status === 404) { // not found
            this.tempPoints = 0
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
