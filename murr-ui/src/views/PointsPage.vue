//incomplete but close
<template>
  <h3>Points</h3>
  <div class="row">
  <!-- add component here
  <vue-ellipse-progress :progress="progress" :half="true" color="green" emptyColor="white" >
  <p slot="legend-caption">DOING GOOD</p>
  </vue-ellipse-progress> -->
  </div>
  <div class="row-success">
    <h2>To learn more about recycling, click the link below</h2>
  </div>
  <div class="row">
    <a href="#">About recycling</a>
    </div>

</template>

<script>
    export default {
        name: "PointsPage",
  data(){
      return{

        id:Number,
        PointValue: Number
      }
    },
      methods: {
        getPoints(){

          //this.callAPI('get',{id})


        },
        callAPI(method, dataToSend){
          let config={
            method: method.toLowerCase(), //post,put,get, or delete - ensure lower case
            url: , //global const to student api url
            params:{} //empty object for now
          };

          //put and post use data attribute, delete and get use params attribute
          if(['put','post'].includes(config.method)){
            config.data = dataToSend; //axis sends data attribute as JSON formatted string in the BODY of the request
          } else {
            config.params = dataToSend //axios sends params through the url. example: localhost:8002?sort=lastName&order=asc
          }

          //if debug prop is true then send the xdebug param so PHPStorm can debug the php code - line by line
          if(this.debug){
            Object.assign(config.params,{XDEBUG_SESSION_START:'phpdebug'});
          }

          //return an Axios promise object we can use .then, .catch and .finally in our component
          return this.axios(config);
        }

        }
    }

</script>

<style scoped>

</style>
