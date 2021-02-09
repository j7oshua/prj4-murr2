const ResidentMixin = ({
  props: {
  },
  data: function () {
    return{
      isBusy: false
    }
  },
  computed: {
    isDisabled() {
      return this.isBusy || this.disabled
    }
  },
  methods: {
    setBusy(state) {
      this.isBusy = state
      this.$emit('busy', state)
    },
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
