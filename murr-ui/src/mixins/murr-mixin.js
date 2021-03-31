// This will be used by everyone so we will move everything to this global mixin file
const PICKUP_API_URL = 'http://127.0.0.1:8000/pickups'
const SITE_POINT_API_URL = 'http://127.0.0.1:8000/site/'
const MurrMixin = ({
  data: function () {
    return {
      PICKUP_API_URL,
      SITE_POINT_API_URL
    }
  }
})
export default MurrMixin
