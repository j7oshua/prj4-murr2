const ResidentMixin = ({
  props:{

  },
  data: function (){

  },
  methods: {
    callAPI: function (method, data){
      let config ={
        method: method.toLowerCase(),
        url: this.RESIDENT_API_URL,
        params: {}
      }

      if(['post'].includes(config.method)){
        config.data = data;
      } else {
        config.params = data;
      }

      return this.axios(config);

    }
  }
});

export default ResidentMixin;
