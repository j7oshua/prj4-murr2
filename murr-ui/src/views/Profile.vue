<template>
  <div>
    <profileForm/>
  </div>
</template>

<script>
import ProfileForm from '../components/ProfileForm'
export default {
  name: 'Profile',
  components: { ProfileForm },
    data () {
      return {
          profile: {}
      }
    },
    methods: {
      handleSaveProfile (profile) {
          throw new Error("Not Implemented")
      },
      handleCancel (profile) {
          throw new Error("Not Implemented")
      }
    }
}
</script>
