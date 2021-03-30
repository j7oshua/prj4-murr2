<template>
  <div class="Points">
    <div>
      <AccountInfo></AccountInfo>
      <b-navbar></b-navbar>
      <PointsComponent></PointsComponent>
    </div>
  </div>
</template>

<script>
import PointsComponent from '../components/ResidentPoints'
import AccountInfo from '@/components/AccountInfo';
export default {
  name: 'Points',
  components: {
    PointsComponent,
    AccountInfo
  },
  methods: {
    // Hides modal when the SitePointsConfirmation component is finished
    confirmFinished () {
      this.showModal = false
    }
  }
}
</script>

<style>
.Points {
  text-align: center;
}
</style>
