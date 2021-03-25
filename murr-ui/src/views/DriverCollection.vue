<template>
  <div>
    <div>
      <h1>CollectionSite</h1>
    </div>
    <div v-if="!showForm">
      <!-- this is a hard-coded site, for route story this is where the list of sites would be displayed -->
       <h2>Site1 Wascana
        <!-- the button will redirect to the DriverPickUp.vue component -->
        <b-button size="sm" class="mb-2" @click="reDirectToDriverPickup">
              <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
        </b-button></h2>
    </div>
    <div>
      <DriverPickUp @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUp>
    </div>
  </div>
</template>

<script>

import DriverPickUp from '@/components/DriverPickUp'
export default {
  name: 'DriverCollection',
  components: { DriverPickUp },
  data () {
    return {
      siteObject: {
        id: 1,
        siteName: 'Wascana',
        numBins: 5
      },
      showForm: false
    }
  },
  methods: {
    reDirectToDriverPickup: function () {
      this.showForm = true
    },
    confirmFinish: function (event) {
      this.showForm = false
    }
  }
}
</script>

<style scoped>

</style>
