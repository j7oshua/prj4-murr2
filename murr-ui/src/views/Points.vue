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
      <ProfileInfo :profile="profile" :show-modal="showModal" :resident-id="residentID" @closed="confirmFinished"></ProfileInfo>
      <PointsComponent></PointsComponent>
    </div>
  </div>
</template>
<script>
import PointsComponent from '../components/ResidentPoints'
import ProfileInfo from '../components/ProfileInfo'
import MurrMixin from '@/mixins/murr-mixin'
export default {
  name: 'Points',
  components: {
    PointsComponent,
    ProfileInfo
  },
  mixins: [MurrMixin],
  data: function () {
    return {
      showModal: false,
      profile: {},
      residentID: 1
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
    getProfileInfo () {
      this.axios.get(this.RESIDENT_POINTS_URL + this.residentID)
        .then(resp => {
          this.profile = resp.data.profile
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
