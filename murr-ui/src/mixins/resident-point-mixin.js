const RESIDENT_POINTS_URL = 'http://127.0.0.1:8000/cusapi/points/'
const ResidentPointMixin = ({
  data: function () {
    return {
      RESIDENT_POINTS_URL
    }
  }
})
export default ResidentPointMixin
