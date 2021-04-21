// This will be used by everyone so we will move everything to this global mixin file
const SITE_API_URL = 'http://localhost:8000/api/sites?order[siteName]'
const PICKUP_API_URL = 'http://127.0.0.1:8000/cusapi/pickups'
const SITE_POINT_API_URL = 'http://127.0.0.1:8000/cusapi/site/'
const ARTICLES_API_URL = 'http://127.0.0.1:8000/api/articles'
const RESIDENT_API_URL = 'http://localhost:8000/api/residents'
const RESIDENT_POINTS_URL = 'http://127.0.0.1:8000/cusapi/points/'
const PROFILE_API_URL = 'http://127.0.0.1:8000/api/profiles/'
const MurrMixin = ({
  data: function () {
    return {
      PICKUP_API_URL,
      SITE_POINT_API_URL,
      PROFILE_API_URL,
      RESIDENT_POINTS_URL,
      RESIDENT_API_URL,
      ARTICLES_API_URL,
      SITE_API_URL
    }
  },
  methods: {
    // this method will help the frontend talk with the API
    // takes in  method type and some data
    callAPI: function (method, data, url) {
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
      if (['post', 'put'].includes(config.method)) {
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
