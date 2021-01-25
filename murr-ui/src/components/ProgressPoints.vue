<template>
  <div>
    <b-overlay :show="isDisabled">
      <h2>Points: {{ tempPoints }}</h2>
    </b-overlay>
  </div>
</template>

<script>
export default {
  name: 'ProgressPoints',
  data () {
    return {
      tempPoints: 0,
      isBusy: false
    }
  },
  props: {
    residentid: Number,
    points: Number
  },
  methods: {
    getPoints: function () {
      this.isBusy = true
      this.axios.get('http://localhost:3000/residentPoints', {
        params: { residentid: this.residentid }
      })
        .then(resp => {
          this.tempPoints = resp.data[0].points
        })
        .catch(err => {
          if (err.response.status === 404) { //  not found
            this.tempPoints = 0
          }
        }).finally(() => {
          this.isBusy = false
        })
    }
  },
  // mounted () {
  //   this.getPoints()
  // },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    }
  }
}
</script>

<style scoped>

</style>
