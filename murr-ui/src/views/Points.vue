<template>
  <div class="Points">
    <div>
      <b-navbar-nav>
        <b-nav-item>
          <b-button @click="openModal">Profile</b-button>
        </b-nav-item>
      </b-navbar-nav>
      <ProfileInfo :profile="profile" :show-modal="showModal" @closed="confirmFinished"></ProfileInfo>
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
      showModal: false,
      profile: {
        firstName: 'John',
        lastName: 'Doe'
      }
    }
  },
  methods: {
    confirmFinished () {
      this.showModal = false
    },
    openModal () {
      this.showModal = true
    }
  }
}
</script>

<style>
.Points {
  text-align: center;
}
</style>
