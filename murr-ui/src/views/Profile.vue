<template>
  <div>
    <ProfileCompletion />
  </div>
</template>

<script>
import ProfileCompletion from '../components/ProfileCompletion'
export default {
  name: 'Profile',
  components: { ProfileCompletion },
  props: {
      firstname: String,
      lastname: String,
      address: String,
      city: String,
      province: String,
      postalcode: String,
  },
    data () {
      return {
        tempfirstname: null,
        templastname: null,
        tempaddress: null,
        tempcity: null,
        tempprovince: null,
        temppostalcode: null
      }
    },
    methods: {
      isValid () {
          throw new Error("Not Implemented")
      },
      callAPI () {
          throw new Error("Not Implemented")
      },
      handleSaveProfile () {
          throw new Error("Not Implemented")
      }
    }
}
</script>
