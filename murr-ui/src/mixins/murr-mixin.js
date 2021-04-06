// This will be used by everyone so we will move everything to this global mixin file
const PICKUP_API_URL = 'http://127.0.0.1:8000/pickups'
const SITE_POINT_API_URL = 'http://127.0.0.1:8000/site/'
const PROFILE_API_URL = 'http://127.0.0.1:8000/profiles'
const MurrMixin = ({
  data: function () {
    return {
      PICKUP_API_URL,
      SITE_POINT_API_URL,
      PROFILE_API_URL
    }
  },
  methods: {
    callAPI_URL: function (method, data, url) {
      // set const variable
      const config = {
        // change everything to lowercase
        method: method.toLowerCase(),
        // const url
        url: url,
        // set empty params
        params: {}
      }
      // if method type equal post
      if (['post'].includes(config.method)) {
        // config data equal data
        config.data = data
      } else {
        // set the config params to equal data
        config.params = data
      }
      // returns an axios call that equal config
      return this.axios(config)
    }
  }
})
export default MurrMixin
