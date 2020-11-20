
<template>
  <vue-ellipse-progress :progress="PointValueTemp" :half="true" color="green" emptyColor="white" >
  <p slot="legend-caption">{{tempMsg}}</p>
  </vue-ellipse-progress>
</template>

<script>
    export default {
        name: "PointsPage",
      props: {
        PointValue: Number,
        msg: string

      },
      data(){
          return{
            tempMsg:'Good Job!',
            PointValueTemp: 20
          }

      },
      methods:{
        getPoints(){ //need something when error

          this.PointValueTemp= this.PointValue;
          this.tempMsg = this.msg;
        }
      },
      computed:{

      },
      mounted() {
          this.getPoints();
      }
    }
</script>

<style scoped>

</style>
