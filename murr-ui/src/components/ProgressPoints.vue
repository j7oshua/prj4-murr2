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
      tempNum: null,
      tempResId: null
    }
  },
  props: {
    residentid: Number,
    points: Number
  },
  methods: {
    getPoints: function () {
      this.axios.get(this.API_LOGIN_URL + '/post.php', {
        params: { residentid: this.residentid }
      })
        .then(resp => {
          this.tempNum = resp.data;
          this.$emit('refreshed', this.tempNum)
        })
        .catch(err => {
          if (err.response.status == 404) { //not found
            this.tempNum = 0;
          }
        })
        .finally(() => {

        });
    },
  }
}
</script>

<style scoped>

</style>
