<template>
  <div class="Points">
    <div>
      <b-navbar-nav>
        <b-nav-item>
          <b-button @click="openModal" pill variant="outline-light">
            <b-img :src="profile.profilePic" rounded="circle" width="75" height="75" alt="Profile" @error="profile.profilePic='profile_default.jpg'"></b-img>
          </b-button>
        </b-nav-item>
      </b-navbar-nav>
      <ProfileInfo :profile="profile" :show-modal="showModal" :residentID="residentID" @closed="confirmFinished"></ProfileInfo>
      <PointsComponent></PointsComponent>
    </div>
  </div>
</template>
<script>
import PointsComponent from '../components/ResidentPoints'
import ProfileInfo from '../components/ProfileInfo'

export default {
  name: 'Points',
  components: {
    PointsComponent,
    ProfileInfo
  },
  data: function () {
    return {
      // The modal will not appear until selected to
      showModal: false,
      profile: {},
      residentID: parseInt(sessionStorage.getItem('id'))
    }
  },
  methods: {
    confirmFinished () {
      this.getProfileInfo()
      this.showModal = false
    },
    openModal () {
      this.showModal = true
    },
    // Call a get to the backend with the resident url and id, and a header granting authentication
    getProfileInfo () {
      this.axios({
        method: 'GET',
        url: this.RESIDENT_API_URL + '/' + this.residentID,
        headers: {
          Authorization: 'Bearer ' + sessionStorage.getItem('token')
        }
      })
        // Receive and set the profile information
        .then(resp => {
          this.profile = resp.data.profile
          this.residentID = resp.data.id
        })
        .catch(err => {
          if (err.response.status === 404) { // not found
            const message = err.response.status
            console.log(message)
          }
        })
    }
  },
  mounted () {
    this.getProfileInfo()
  }
}
</script>
<style>
  .Points {
    text-align: center;
  }
</style>
