<template>
  <div>
    <h2>Points: {{ points }}</h2>
  </div>
</template>

<script>
export default {
  name: 'ProgressPoints',
  data () {
    return {
      tempPoints: null,
      tempResId: null
    }
  },
  props: {
    residentid: Number,
    points: Number
  },
  methods: {
    getPoints: function () {
      this.axios.get('http://localhost:3000/residentPoints', {
        params: { residentid: this.residentid }
      })
        .then(resp => {
          this.tempPoints = resp.data.points
        })
        .catch(err => {
          if (err.response.status === 404) { //  not found
            this.tempPoints = 0
          }
        })
    }
  },
  mounted () {
    // this.getPoints()
  }
}
</script>

<style scoped>

</style>
