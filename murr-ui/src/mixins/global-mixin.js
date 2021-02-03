const RESIDENT_API_URL = 'http://localhost:8000/api/residents'

const GlobalMixin = ({
  props: {

  },
  data: function () {
    return {
      RESIDENT_API_URL
    }
  },
  mounted() {

  },
});

export default GlobalMixin;
