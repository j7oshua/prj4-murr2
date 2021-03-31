<template>
  <div class="Points">
    <div>
      <b-navbar-nav>
        <b-nav-item>
          <b-button @click="openModal">Account</b-button>
        </b-nav-item>
      </b-navbar-nav>
      <AccountInfo :account="account" :show-modal="showModal" @closed="confirmFinished"></AccountInfo>
      <PointsComponent></PointsComponent>
    </div>
  </div>
</template>

<script>
import PointsComponent from '../components/ResidentPoints'
import AccountInfo from '../components/AccountInfo'
export default {
  name: 'Points',
  components: {
    PointsComponent,
    AccountInfo
  },
  data: function () {
    return {
      showModal: false,
      account: {
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
