const ResidentMixin = ({
  props: {
  },
  data: function () {
  },
  methods: {
    callAPI: function (method, data) {
      const config = {
        method: method.toLowerCase(),
        url: 'http://localhost:8000/api/residents',
        params: {}
      }
      if (['post'].includes(config.method)) {
        config.data = data
      } else {
        config.params = data
      }
      return this.axios(config)
    }
  }
})

export default ResidentMixin
