const RESIDENT_POINTS_URL = 'http://localhost:3000/residentPoints'
const ResidentPointMixin = ({
  data: function () {
    return {
      RESIDENT_POINTS_URL
    }
  }
})
export default ResidentPointMixin
